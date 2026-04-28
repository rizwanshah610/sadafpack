<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the companies.
     */
    public function index()
{
    $companies = Company::withCount([
        'products',
        'products as sizes_count' => function ($query) {
            $query->join('package_sizes', 'package_sizes.product_id', '=', 'products.id');
        }
    ])->latest()->paginate(15);

    return view('admin.companies.index', compact('companies'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'nullable|email|max:255',
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'website' => 'nullable|url|max:255',
            'logo'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Company::create($data);

        return redirect()->route('companies.index')
                         ->with('success', 'Company created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return view('admin.companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('admin.companies.edit', compact('company'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'nullable|email|max:255',
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'website' => 'nullable|url|max:255',
            'logo'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $company->update($data);

        return redirect()->route('companies.index')
                         ->with('success', 'Company updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        if ($company->logo) {
            Storage::disk('public')->delete($company->logo);
        }
        $company->delete();

        return redirect()->route('companies.index')
                         ->with('success', 'Company deleted successfully!');
    }


    //API endpoint for dynamic product loading

    public function products(Company $company)
{
    $products = $company->products()->with('packageSizes')->get();

    return response()->json(
        $products->map(fn($p) => [
            'id'            => $p->id,
            'name'          => $p->name,
            'price'         => $p->price,
            'package_sizes' => $p->packageSizes->map(fn($ps) => [
                'id'              => $ps->id,
                'name'            => $ps->name,
                'effective_price' => !is_null($ps->price) ? (float) $ps->price : (float) $p->price,
                'has_own_price'   => !is_null($ps->price),
            ]),
        ])
    );
}
}
