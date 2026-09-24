<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Seller\SellerAuthController;
use App\Http\Controllers\Seller\SellerDashboardController;
use App\Http\Controllers\Seller\SellerProductController;
use App\Http\Controllers\Seller\SellerOrderController;
use App\Http\Controllers\Seller\SellerProfileController;
use App\Http\Controllers\Seller\SellerEarningController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $featuredProducts = \App\Models\Product::where('is_active', true)
        ->with(['category', 'seller'])
        ->latest()
        ->take(8)
        ->get();
    $categories = \App\Models\Category::where('is_active', true)
        ->withCount(['products' => function ($q) {
            $q->where('is_active', true);
        }])
        ->get();
    return view('home', compact('featuredProducts', 'categories'));
})->name('home');

Route::get('/products', [ProductController::class, 'index'])
    ->name('products');

Route::get('/products/{slug}', [ProductController::class, 'show'])
    ->name('products.show');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', [ContactController::class, 'show'])
    ->name('contact');

Route::post('/contact', [ContactController::class, 'submit'])
    ->name('contact.submit');

/*
|--------------------------------------------------------------------------
| Customer Authentication
|--------------------------------------------------------------------------
*/
Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.store');

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Forgot Password
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])
    ->middleware('guest')
    ->name('password.email');

// Reset Password
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])
    ->middleware('guest')
    ->name('password.update');

// Logout
Route::post('/logout', function (Illuminate\Http\Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| Module 2: Seller Central Portal Routes
|--------------------------------------------------------------------------
*/
Route::prefix('seller')->name('seller.')->group(function () {
    // Guest Seller Routes
    Route::middleware('guest')->group(function () {
        Route::get('/register', [SellerAuthController::class, 'showRegister'])->name('register');
        Route::post('/register', [SellerAuthController::class, 'register'])->name('register.store');

        Route::get('/login', [SellerAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [SellerAuthController::class, 'login'])->name('login.store');
    });

    // Authenticated Seller Routes
    Route::middleware(['auth', 'seller'])->group(function () {
        Route::post('/logout', [SellerAuthController::class, 'logout'])->name('logout');
        
        // Dashboard
        Route::get('/dashboard', [SellerDashboardController::class, 'index'])->name('dashboard');

        // Products CRUD
        Route::resource('products', SellerProductController::class);
        Route::post('/products/{product}/toggle-status', [SellerProductController::class, 'toggleStatus'])->name('products.toggle-status');
        Route::delete('/products/{product}/images/{image}', [SellerProductController::class, 'deleteImage'])->name('products.images.destroy');
        Route::delete('/products/{product}/variations/{variation}', [SellerProductController::class, 'deleteVariation'])->name('products.variations.destroy');

        // Orders
        Route::get('/orders', [SellerOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [SellerOrderController::class, 'show'])->name('orders.show');
        Route::post('/orders/{order}/status', [SellerOrderController::class, 'updateStatus'])->name('orders.update-status');

        // Profile & Store Settings
        Route::get('/profile', [SellerProfileController::class, 'show'])->name('profile');
        Route::put('/profile', [SellerProfileController::class, 'update'])->name('profile.update');

        // Earnings & Payouts
        Route::get('/earnings', [SellerEarningController::class, 'index'])->name('earnings');
    });
});