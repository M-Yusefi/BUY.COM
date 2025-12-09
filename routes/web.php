<?php

use App\Http\Controllers\ProfileController;
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
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard.index');

Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function (){

    Route::get('/apply', [VendorController::class , 'apply'])->name('vendors.apply');
    Route::post('/store', [VendorController::class , 'store'])->name('vendors.store');
});

Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function (){

    Route::get('/vendors', [VendorController::class, 'vendorsOverview'])->name('admin.vendor');
    Route::put('/admin/vendor/{vendor}/status', [VendorController::class, 'venodrStatus'])->name('vendors.venodrStatus');
});

Route::middleware(['auth', RoleMiddleware::class . ':vendor'])->group(function (){

    Route::get('/create', [ProductsController::class, 'create'])->name('products.create');
    Route::post('/storeProduct', [ProductsController::class, 'store'])->name('products.store');

});



