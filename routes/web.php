<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PackageSizeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\SettingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root → login
Route::get('/', function () {
    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| Admin Routes (Protected)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->group(function () {

    // Admin Dashboard — accessible by all authenticated users
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    // Companies CRUD — super_admin and admin only
    Route::middleware(['role:super_admin|admin'])->group(function () {
        Route::resource('companies', CompanyController::class);
        Route::resource('products', ProductController::class);
        Route::resource('products.sizes', PackageSizeController::class);
    });

    // Staff Management — super_admin only
    Route::middleware(['role:super_admin'])->group(function () {
        Route::resource('staff', StaffController::class)->parameters([
            'staff' => 'user'
        ]);
    });


    // Setting of CMS
    Route::get('settings/general', [SettingsController::class, 'index'])->name('admin.settings.general');
    Route::post('settings/general', [SettingsController::class, 'update'])->name('admin.settings.update');

});


/*
|--------------------------------------------------------------------------
| Profile Routes (Breeze Default)
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
| Auth Routes (Login, Register, Logout)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';