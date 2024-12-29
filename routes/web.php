<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PackageBankController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\PackageBookingController;
use App\Http\Controllers\PackageTourController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard/user-stats', [DashboardController::class, 'getUserStatistics']);
Route::get('admin/package_bookings/complete/{id}', [PackageBookingController::class, 'complete']);


// Route untuk Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Route untuk halaman depan
Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/category/{category:slug}', [FrontController::class, 'category'])->name('front.category');
Route::get('/details/{slug}', [FrontController::class, 'details'])->name('front.details');

// Middleware untuk otentikasi
Route::middleware('auth')->group(function () {
    // Profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routing untuk pemesanan
    Route::middleware('can:checkout package')->group(function () {
        Route::get('/book/{packageTour:slug}', [FrontController::class, 'book'])->name('front.book');
        Route::post('/book/save/{packageTour:slug}', [FrontController::class, 'book_store'])->name('front.book.store');
        Route::get('/book/choose-bank/{packageBooking}/', [FrontController::class, 'choose_bank'])->name('front.choose.bank');
        Route::patch('/book/choose-bank/{packageBooking}/save', [FrontController::class, 'choose_bank_store'])->name('front.choose_bank_store');
        Route::get('/book/payment/{packageBooking}/', [FrontController::class, 'book_payment'])->name('front.book_payment');
        Route::patch('/book/payment/{packageBooking}/save', [FrontController::class, 'book_payment_store'])->name('front.book_payment_store');
        Route::get('/book-finish', [FrontController::class, 'book_finish'])->name('front.book_finish');
        Route::get('/midtrans/payment/{packageBooking}', [FrontController::class, 'redirectMidtrans'])->name('front.midtrans_payment');
    });

    // Routing untuk dashboard
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::middleware('can:view orders')->group(function () {
            Route::get('/my-bookings', [DashboardController::class, 'my_bookings'])->name('bookings');
            Route::get('/my-bookings/details/{packageBooking}', [DashboardController::class, 'booking_details'])->name('booking.details');
        });
    });

    // Routing untuk admin
    Route::prefix('admin')->name('admin.')->group(function() {
        Route::middleware('can:manage categories')->group(function () {
            Route::resource('categories', CategoryController::class);
        });

        Route::middleware('can:manage packages')->group(function () {
            Route::resource('package_tours', PackageTourController::class);
        });

        Route::middleware('can:manage package banks')->group(function () {
            Route::resource('package_banks', PackageBankController::class);
        });

        Route::middleware('can:manage transactions')->group(function () {
            Route::resource('package_bookings', PackageBookingController::class);
        });
    });
});

require __DIR__.'/auth.php';
