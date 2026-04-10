<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PackageSizeController;
use App\Http\Controllers\Admin\DashboardController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function () {
    return redirect()->route('companies.index');
});

Route::resource('/admin/companies', CompanyController::class);
Route::resource('/admin/companies/products', ProductController::class);
Route::resource('/admin/companies/sizes', PackageSizeController::class);


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});