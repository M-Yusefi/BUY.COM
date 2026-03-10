<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

// Free acces
Route::get('/', function () {return view('home');})->name('home');
Route::get('/categories/all', [CategoriesController::class, 'allCategories'])->name('categories.allCategories');
Route::get('/categories/filter' , [CategoriesController::class, 'filter'])->name('categories.filter');
Route::get('/products/index', [ProductsController::class, 'index'])->name('products.index');
Route::get('/products/index_data', [ProductsController::class, 'index_data'])->name('products.index_data');
Route::get('/products/search', [ProductsController::class, 'search'])->name('products.search');
Route::get('/products/{product}', [ProductsController::class, 'show'])->name('products.show');


// Defult Route -> login required
Route::middleware(['auth', 'verified'])->group(function (){  
    // Profile RUD  
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Customer dash
    Route::get('/dashboard',[CustomerController::class, 'index'])->name('dashboard.index');
    
    // Vendor apply functions
    Route::get('/apply', [VendorController::class , 'apply'])->name('vendor.apply');
    Route::post('/store', [VendorController::class , 'store'])->name('vendor.store');

    // Adding products to the cart 
    Route::post('/cart/store', [CartItemController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{product}', [CartItemController::class, 'delete'])->name('cart.delete');
    Route::patch('/cart/update/{cartItem}', [CartItemController::class, 'update'])->name('cart.update');
    Route::get('/checkout/cart', [CartItemController::class, 'cart'])->name('checkout.cart');
   
    // Address CRUD 
    Route::get('/checkout/addresses', [AddressController::class, 'index'])->name('checkout.address');
    Route::post('/checkout/set-address', [AddressController::class, 'setAddress'])->name('checkout.setAddress');
    Route::get('/address/create', [AddressController::class, 'create'])->name('address.create');
    Route::post('/address/store', [AddressController::class, 'store'])->name('address.store');

    // Final checkout
    Route::get('/checkout/review', [CartItemController::class, 'review'])->name('checkout.review');
    Route::post('/order/store', [OrdersController::class, 'store'])->name('order.store');
    Route::get('/order/success/{order}', [OrdersController::class, 'success'])->name('order.success');

    Route::get('/orders/index', [OrdersController::class, 'index'])->name('order.index');
    Route::get('/orders/show/{order}', [OrdersController::class, 'show'])->name('order.show');
});


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
    Route::get('/data', [ProductsController::class, 'data'])->name('data');
});

require __DIR__.'/auth.php';













