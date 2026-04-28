<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PackageSizeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\SettingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::middleware(['role:super_admin|admin'])->group(function () {
        Route::resource('companies', CompanyController::class);
        Route::resource('products', ProductController::class);
        Route::resource('products.sizes', PackageSizeController::class);

        Route::resource('orders', OrderController::class);
        Route::get('orders/{order}/download', [OrderController::class, 'download'])
            ->name('orders.download');

            //Job card for order
        Route::get('orders/{order}/jobcard', [OrderController::class, 'jobCard'])->name('orders.jobcard');
    });



    Route::middleware(['role:super_admin'])->group(function () {
        Route::resource('staff', StaffController::class)->parameters([
            'staff' => 'user'
        ]);
    });

    Route::get('settings/general', [SettingsController::class, 'index'])
        ->name('admin.settings.general');
    Route::post('settings/general', [SettingsController::class, 'update'])
        ->name('admin.settings.update');

        // API endpoint for dynamic product loading
Route::get('api/companies/{company}/products', [CompanyController::class, 'products'])
->name('api.companies.products');
});

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])
        ->name('profile.avatar');

    Route::delete('/profile/avatar', [ProfileController::class, 'removeAvatar'])
        ->name('profile.avatar.remove');
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';