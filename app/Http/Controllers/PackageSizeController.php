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

            // NEW FIELDS
            'sheet_size' => 'nullable|string|max:255',
            'color'      => 'nullable|string|max:100',
            'ply'        => 'nullable|string|max:50',
            'paper'      => 'nullable|string|max:100',
            'nali'       => 'nullable|string|max:50',

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

        // NEW FIELDS
        'sheet_size' => 'nullable|string|max:255',
        'color'      => 'nullable|string|max:100',
        'ply'        => 'nullable|string|max:50',
        'paper'      => 'nullable|string|max:100',
        'nali'       => 'nullable|string|max:50',

        'unit'   => 'nullable|string|max:50',
        'image'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'remove_image' => 'nullable|string', // Hidden field from our JS
    ]);

    $data = $request->except(['image', 'remove_image']);

    // 1. Handle Explicit Removal (The Dustbin Logic)
    if ($request->remove_image == '1') {
        if ($size->image) {
            Storage::disk('public')->delete($size->image);
            $size->image = null; // Clear the path in the model
            $data['image'] = null; // Ensure the update() call clears it in DB
        }
    }

    // 2. Handle New File Upload
    if ($request->hasFile('image')) {
        // If there was an old image, delete it first
        if ($size->image) {
            Storage::disk('public')->delete($size->image);
        }
        // Store new image and update the data array
        $data['image'] = $request->file('image')->store('sizes', 'public');
    }

    // 3. Update everything in the database
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