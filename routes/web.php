<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\TransactionsController;
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

Route::middleware(['auth', 'verified'])->group(function () {
    //Admin route
    Route::get('/vendors', [VendorController::class, 'vendorsOverview'])->name('admin.vendor');
    Route::put('/admin/vendor/{vendor}/status', [VendorController::class, 'venodrStatus'])->name('vendors.venodrStatus');

    //Vendors route
    Route::get('/apply', [VendorController::class , 'apply'])->name('vendors.apply');
    Route::post('/store', [VendorController::class , 'store'])->name('vendors.store');
});



