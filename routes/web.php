<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\RentalRequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ApartmentController as AdminApartmentController;
use App\Http\Controllers\Admin\TenantController;
use App\Http\Controllers\Admin\RentalAgreementController;
use App\Http\Controllers\Admin\RentalRequestController as AdminRentalRequestController;

// HOMEPAGE (listing)
Route::get('/', [ApartmentController::class, 'index'])
    ->name('apartments.index');

//AUTH
Route::middleware('auth')->group(function () {

    //MY
    Route::get('/my-properties', [ApartmentController::class, 'my'])
        ->name('apartments.my');
    Route::resource('apartments', ApartmentController::class)
        ->except(['destroy', 'show', 'index']);
    //DELETE APARTMENT
    Route::delete(
        '/apartments/{apartment}/delete',
        [ApartmentController::class, 'destroy']
    )->name('apartments.destroy');

    Route::delete(
        '/apartments/{apartment}/images/{image}',
        [ApartmentController::class, 'deleteImage']
    )->name('apartments.images.destroy');

    //RENTAL REQUESTS
    Route::post(
        '/apartments/{apartment}/rental-request',
        [RentalRequestController::class, 'store']
    )->name('rental-requests.store');

    //PROFILE
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/avatar', [ProfileController::class, 'uploadAvatar'])->name('profile.avatar');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

//APARTMENTS SHOW
Route::get('/apartments/{apartment}', [ApartmentController::class, 'show'])
    ->name('apartments.show');

//ADMIN ROUTES
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        //DASHBOARD
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('apartments', AdminApartmentController::class);
        Route::resource('tenants', TenantController::class);
        Route::resource('rentals', RentalAgreementController::class);

        //TOGGLE ADMIN ROLE IN USER EDIT
        Route::patch(
            'tenants/{tenant}/role',
            [TenantController::class, 'toggleRole']
        )->name('tenants.toggle-role');

        //RENTAL REQUESTS
        Route::get(
            '/rental-requests',
            [AdminRentalRequestController::class, 'index']
        )->name('rental-requests.index');

        Route::post(
            '/rental-requests/{rentalRequest}/approve',
            [AdminRentalRequestController::class, 'approve']
        )->name('rental-requests.approve');

        Route::post(
            '/rental-requests/{rentalRequest}/reject',
            [AdminRentalRequestController::class, 'reject']
        )->name('rental-requests.reject');

        Route::delete(
            '/rental-requests/{rentalRequest}',
            [AdminRentalRequestController::class, 'destroy']
        )->name('rental-requests.destroy');
    });

require __DIR__.'/auth.php';

