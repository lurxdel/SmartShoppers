<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Support\Facades\Auth;

// =============================
// Public Welcome Page
// =============================
Route::get('/', function () {
    return view('welcome');
});

// =============================
// Auth Routes (Login/Register)
// =============================
require __DIR__ . '/auth.php';

// =============================
// Authenticated Routes Group
// =============================
Route::middleware(['auth'])->group(function () {
    
    // =============================
    // Profile Settings
    // =============================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // =============================
    // Redirect User Based on Role
    // =============================
    Route::get('/redirect-based-on-role', function () {
        $role = Auth::user()->role;

        return match ($role) {
            'admin' => redirect()->route('products.index'),
            'staff' => redirect()->route('purchases.index'),
            'user' => redirect()->route('products.index'),
            default => abort(403),
        };
    });

    // =============================
    // Dashboard
    // =============================
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // =============================
    // Admin Role Routes
    // =============================
    
    Route::group(['middleware' => ['auth', 'role:admin']], function () {
        Route::resource('products', ProductController::class)->only(['create', 'edit', 'index']);
        Route::resource('customers', CustomerController::class);
        Route::resource('purchases', PurchaseController::class)->only(['index']);
        Route::get('purchases/pdf', [PurchaseController::class, 'generatePdf'])->name('purchases.pdf');
        Route::get('customers/pdf', [CustomerController::class, 'generatePdf'])->name('customers.pdf');
        Route::get('products/pdf', [ProductsController::class, 'generatePdf'])->name('products.pdf');
    });

    // =============================
    // Staff Role Routes
    // =============================
    Route::group(['middleware' => ['auth', 'role:admin,staff']], function () {
        Route::resource('purchases', PurchaseController::class)->only(['index']);
        Route::get('purchases/pdf', [PurchaseController::class, 'generatePdf'])->name('purchases.pdf');
    });

    // =============================
    // User Role Routes
    // =============================
    Route::group(['middleware' => ['auth', 'role:admin,user']], function () {
        Route::resource('products', ProductController::class)->only(['index']);
        Route::get('products/pdf', [ProductController::class, 'generatePdf'])->name('products.pdf');
    });

});