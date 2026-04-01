<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PackageSizeController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function () {
    return redirect()->route('companies.index');
});

Route::resource('companies', CompanyController::class);
Route::resource('products', ProductController::class);
Route::resource('sizes', PackageSizeController::class);