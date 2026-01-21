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


Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';

// Admin Route
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function (){
    
    // Admin dash
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Vendor functions
    Route::get('/vendors', [AdminController::class, 'vendorsOverview'])->name('vendor');
    Route::put('/vendor/{vendor}/status', [AdminController::class, 'venodrStatus'])->name('venodrStatus');
});

// Category CRUD -> Admin acces only
Route::middleware(['auth', 'role:admin'])->prefix('categories')->name('categories.')->group(function (){
    
    // Categories functions
    Route::get('/index', [CategoriesController::class, 'index'])->name('categories');
    Route::get('/create', [CategoriesController::class, 'createCatView'])->name('createCat');
    Route::post('/store', [CategoriesController::class, 'store'])->name('store');
});

// Vendor Route
Route::middleware(['auth', 'role:vendor'])->prefix('vendor')->name('vendor.')->group(function (){
    
    // Vendor dash
    Route::get('/dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
    Route::get('/index' , [VendorController::class, 'index'])->name('index');
});

// Product CRUD -> Vendor acces only
Route::middleware(['auth', 'role:vendor'])->prefix('products')->name('products.')->group(function (){
    Route::get('/create', [ProductsController::class, 'create'])->name('create');
    Route::post('/store', [ProductsController::class, 'store'])->name('store');
    Route::get('/{product}/edit', [ProductsController::class, 'edit'])->name('edit');
    Route::put('/{product}', [ProductsController::class, 'update'])->name('update');
    Route::delete('/{product}', [ProductsController::class, 'destroy'])->name('destroy');

    // AJAX/data endpoint for products JSON
    Route::get('/data', [ProductsController::class, 'data'])->name('data');
});


// Defult Route -> login required
Route::middleware(['auth', 'verified'])->group(function (){
    // Customer dash
    Route::get('/dashboard', function () { return view('dashboard.index');})->name('dashboard.index');
    
    // Vendor apply functions
    Route::get('/apply', [VendorController::class , 'apply'])->name('vendor.apply');
    Route::post('/store', [VendorController::class , 'store'])->name('vendor.store');
});

// Free acces
Route::get('/categories/all', [CategoriesController::class, 'allCategories'])->name('categories.allCategories');
Route::get('/products/index', [ProductsController::class, 'index'])->name('products.index');
Route::get('/products/index_data', [ProductsController::class, 'index_data'])->name('products.index_data');
Route::get('/products/search' , [ProductsController::class, 'search'])->name('products.search');
Route::get('/products/{product}', [ProductsController::class, 'show'])->name('products.show');









