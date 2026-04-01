<?php

namespace App\Http\Controllers;

use App\Models\PackageSize;
use App\Models\Product;
use Illuminate\Http\Request;

class PackageSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
    return view('sizes.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $image = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('packages', 'public');
        }
    
        PackageSize::create([
            'product_id' => $request->product_id,
            'length' => $request->length,
            'width' => $request->width,
            'height' => $request->height,
            'image' => $image,
        ]);
    
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(PackageSize $packageSize)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PackageSize $packageSize)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PackageSize $packageSize)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PackageSize $packageSize)
    {
        //
    }
}
