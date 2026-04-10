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
    $companies = Company::withCount('products')->latest()->get();

    return view('admin.dashboard', compact(
        'totalCompanies',
        'totalProducts',
        'totalSizes',
        'companies'
    ));
}
}
