<?php
namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
{
    $company_id = request('company_id');

    $products = Product::with('company', 'packageSizes')
        ->when($company_id, function ($query) use ($company_id) {
            $query->where('company_id', $company_id);
        })
        ->latest()
        ->paginate(10);

    $companies = Company::all();
    $selectedCompany = $company_id ? Company::find($company_id) : null;

    return view('admin.products.index', compact('products', 'companies', 'selectedCompany'));
}

    public function create()
    {
        $companies = Company::all();
        return view('admin.products.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id'  => 'required|exists:companies,id',
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'nullable|numeric',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('products.index')
                         ->with('success', 'Product created successfully!');
    }

    public function show(Product $product)
    {
        $product->load('company', 'packageSizes');
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $companies = Company::all();
        return view('admin.products.edit', compact('product', 'companies'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'company_id'  => 'required|exists:companies,id',
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'nullable|numeric',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')
                         ->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('products.index')
                         ->with('success', 'Product deleted successfully!');
    }
}