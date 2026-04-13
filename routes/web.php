<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PackageSizeController;
use App\Http\Controllers\Admin\DashboardController;

// Redirect root to dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Companies CRUD
    Route::resource('companies', CompanyController::class);

    // Products CRUD
    Route::resource('products', ProductController::class);

    // Sizes CRUD (nested under products)
    Route::resource('products.sizes', PackageSizeController::class);

});