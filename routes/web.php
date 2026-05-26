<?php

use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\LeaseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MaintenanceRequestController;
use App\Http\Controllers\Admin\PropertyController as AdminPropertyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', fn () => view('welcome'));

Route::get('/properties', [PropertyController::class, 'index'])
    ->name('properties.index');

Route::get('/properties/{property}', [PropertyController::class, 'show'])
    ->name('properties.show');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', fn () => view('dashboard'))
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | ADMIN ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware(\App\Http\Middleware\AdminMiddleware::class)
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

            Route::get('/', function () {
                $propertyCount = \App\Models\Property::count();
                $availableCount = \App\Models\Property::where('status', 'available')->count();
                $soldCount = \App\Models\Property::where('status', 'sold')->count();
                $pendingCount = \App\Models\Property::where('status', 'pending')->count();

                return view('admin.dashboard', compact('propertyCount', 'availableCount', 'soldCount', 'pendingCount'));
            })->name('dashboard');

            Route::resource('properties', AdminPropertyController::class);

            // Admin payments management
            Route::get('payments', [\App\Http\Controllers\PaymentController::class, 'index'])
                ->name('payments.index');

            Route::get('payments/export', [\App\Http\Controllers\PaymentController::class, 'export'])
                ->name('payments.export');

        Route::delete('/properties/image/{image}', [AdminPropertyController::class, 'deleteImage'])
            ->name('properties.image.delete');
    });

    /*
    |--------------------------------------------------------------------------
    | CORE SYSTEM
    |--------------------------------------------------------------------------
    */

    Route::resource('tenants', TenantController::class);
    Route::resource('leases', LeaseController::class);
    Route::resource('maintenance', MaintenanceRequestController::class);

    /*
    |--------------------------------------------------------------------------
    | PAYMENTS
    |--------------------------------------------------------------------------
    */
    Route::post('/leases/{lease}/payments', [PaymentController::class, 'store'])
        ->name('payments.store');

    Route::delete('/payments/{payment}', [PaymentController::class, 'destroy'])
        ->name('payments.destroy');

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';