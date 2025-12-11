<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\TransactionsController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard.index');

Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';

// Default
Route::middleware(['auth', 'verified'])->group(function (){

    // Customer dash
    Route::get('/dashboard', function () { return view('dashboard.index');})->name('dashboard.index');
    
    // Vendor apply functions
    Route::get('/apply', [VendorController::class , 'apply'])->name('vendor.apply');
    Route::post('/store', [VendorController::class , 'store'])->name('vendor.store');
});


// Admin Route
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function (){
    
    // Admin dash
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Vendor functions
    Route::get('/vendors', [AdminController::class, 'vendorsOverview'])->name('vendor');
    Route::put('/vendor/{vendor}/status', [AdminController::class, 'venodrStatus'])->name('venodrStatus');
});


Route::middleware(['auth', 'role:admin'])->prefix('categories')->name('categories.')->group(function (){
    
    // Categories functions
    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
    Route::get('/categories/create', [CategoriesController::class, 'createCatView'])->name('createCat');
    Route::get('/categories/all', [CategoriesController::class, 'allCategories'])->name('allCategories');
    Route::post('/categories/store', [CategoriesController::class, 'store'])->name('store');
});

// Vendor Route
Route::middleware(['auth', 'role:vendor'])->prefix('vendor')->name('vendor.')->group(function (){
    
    // Vendor dash
    Route::get('/dashboard', [VendorController::class, 'dashboard'])->name('dashboard');

    // Product functions 
    Route::get('/create', [ProductsController::class, 'create'])->name('products.create');
    Route::post('/storeProduct', [ProductsController::class, 'store'])->name('products.store');
});







