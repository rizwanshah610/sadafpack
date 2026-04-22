<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Product;
use App\Models\PackageSize;

class DashboardController extends Controller
{
    public function index()
{
    $totalCompanies = Company::count();
    $totalProducts  = Product::count();
    $totalSizes     = PackageSize::count();

    $companies = Company::withCount([
        'products',
        'products as sizes_count' => function ($query) {
            $query->join('package_sizes', 'package_sizes.product_id', '=', 'products.id');
        }
    ])->latest()->get();

    return view('admin.dashboard', compact(
        'totalCompanies',
        'totalProducts',
        'totalSizes',
        'companies'
    ));
}
}
