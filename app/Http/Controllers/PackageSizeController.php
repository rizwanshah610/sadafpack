<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PackageSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackageSizeController extends Controller
{
    // -------------------------------------------------------
    // Nested under Product (existing routes: products.sizes.*)
    // -------------------------------------------------------

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
            'name'       => 'required|string|max:255',
            'price'      => 'nullable|numeric|min:0',
            'length'     => 'nullable|numeric',
            'width'      => 'nullable|numeric',
            'height'     => 'nullable|numeric',
            'sheet_size' => 'nullable|string|max:255',
            'color'      => 'nullable|string|max:100',
            'ply'        => 'nullable|string|max:50',
            'paper'      => 'nullable|string|max:100',
            'nali'       => 'nullable|string|max:50',
            'unit'       => 'nullable|string|max:50',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('image');
        $data['product_id'] = $product->id;

        // null means "use product price"
        $data['price'] = $request->filled('price') ? $request->price : null;



        // By defualt sent cm for unit field
        $data['unit'] = $request->filled('unit') ? $request->unit : 'cm';

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
            'name'         => 'required|string|max:255',
            'price'        => 'nullable|numeric|min:0',
            'length'       => 'nullable|numeric',
            'width'        => 'nullable|numeric',
            'height'       => 'nullable|numeric',
            'sheet_size'   => 'nullable|string|max:255',
            'color'        => 'nullable|string|max:100',
            'ply'          => 'nullable|string|max:50',
            'paper'        => 'nullable|string|max:100',
            'nali'         => 'nullable|string|max:50',
            'unit'         => 'nullable|string|max:50',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'remove_image' => 'nullable|string',
        ]);

        $data = $request->except(['image', 'remove_image']);

        // null means "use product price"
        $data['price'] = $request->filled('price') ? $request->price : null;


        //By defualt sent cm if unit select sent empty
        $data['unit'] = $request->filled('unit') ? $request->unit : 'cm';

        if ($request->remove_image == '1') {
            if ($size->image) {
                Storage::disk('public')->delete($size->image);
            }
            $data['image'] = null;
        }

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

    // -------------------------------------------------------
    // Standalone (package-sizes.* routes)
    // -------------------------------------------------------

    public function allSizes()
    {
        $sizes = PackageSize::with('product.company')->latest()->paginate(20);
        return view('admin.package_sizes.index', compact('sizes'));
    }

    public function createSize()
    {
        $companies = \App\Models\Company::with('products')->get();
        return view('admin.package_sizes.create', compact('companies'));
    }

    public function storeSize(Request $request)
    {
        $request->validate([
            'product_id'        => 'required|exists:products,id',
            'sizes'             => 'required|array|min:1',
            'sizes.*.name'      => 'required|string|max:255',
            'sizes.*.price'     => 'nullable|numeric|min:0',
        ]);

        foreach ($request->sizes as $sizeData) {
            if (!empty($sizeData['name'])) {
                PackageSize::create([
                    'product_id' => $request->product_id,
                    'name'       => $sizeData['name'],
                    // null = use product price as fallback
                    'price'      => isset($sizeData['price']) && $sizeData['price'] !== '' ? $sizeData['price'] : null,
                ]);
            }
        }

        return redirect()->route('package-sizes.index')
                         ->with('success', 'Package sizes added successfully!');
    }

    public function editSize(PackageSize $size)
    {
        $size->load('product.company');
        return view('admin.package_sizes.edit', compact('size'));
    }

    public function updateSize(Request $request, PackageSize $size)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
        ]);

        $size->update([
            'name'  => $request->name,
            // null = use product price as fallback
            'price' => $request->filled('price') ? $request->price : null,
        ]);

        return redirect()->route('package-sizes.index')
                         ->with('success', 'Package size updated successfully!');
    }

    public function destroySize(PackageSize $size)
    {
        if ($size->image) {
            Storage::disk('public')->delete($size->image);
        }
        $size->delete();

        return redirect()->route('package-sizes.index')
                         ->with('success', 'Package size deleted.');
    }
}