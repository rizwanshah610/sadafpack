<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PackageSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackageSizeController extends Controller
{
    public function index(Product $product)
    {
        $sizes = $product->packageSizes()->latest()->paginate(10);
        return view('admin.sizes.index', compact('product', 'sizes'));
    }

    public function create(Product $product)
    {
        return view('admin.sizes.create', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'length' => 'nullable|numeric',
            'width'  => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'unit'   => 'nullable|string|max:50',
            'image'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('image');
        $data['product_id'] = $product->id;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('sizes', 'public');
        }

        PackageSize::create($data);

        return redirect()->route('products.sizes.index', $product->id)
                         ->with('success', 'Size added successfully!');
    }

    public function edit(Product $product, PackageSize $size)
    {
        return view('admin.sizes.edit', compact('product', 'size'));
    }

    public function update(Request $request, Product $product, PackageSize $size)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'length' => 'nullable|numeric',
            'width'  => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'unit'   => 'nullable|string|max:50',
            'image'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($size->image) {
                Storage::disk('public')->delete($size->image);
            }
            $data['image'] = $request->file('image')->store('sizes', 'public');
        }

        $size->update($data);

        return redirect()->route('products.sizes.index', $product->id)
                         ->with('success', 'Size updated successfully!');
    }

    public function destroy(Product $product, PackageSize $size)
    {
        if ($size->image) {
            Storage::disk('public')->delete($size->image);
        }
        $size->delete();

        return redirect()->route('products.sizes.index', $product->id)
                         ->with('success', 'Size deleted successfully!');
    }
}