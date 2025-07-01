<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public Routes
Route::get('/', function () {
    return redirect()->route('foods.index');
});
Route::get('/foods', [FoodController::class, 'index'])->name('foods.index');
Route::post('/foods/{id}/add-to-cart', [FoodController::class, 'addToCart'])->name('foods.addToCart');
Route::get('/cart', [FoodController::class, 'cart'])->name('cart.index');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::post('/cart/{id}/update', [FoodController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/{id}/remove', [FoodController::class, 'removeFromCart'])->name('cart.remove');

// User Routes (Protected)
Route::middleware(['user'])->group(function () {
    Route::get('/user/dashboard', [AuthController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/{id}/confirm-payment', [OrderController::class, 'confirmPayment'])->name('orders.confirmPayment');
    Route::get('/checkout/pay', [CheckoutController::class, 'payWithMidtrans'])->name('checkout.pay');
    Route::get('/checkout/simulasi', [CheckoutController::class, 'simulasiPembayaran'])->name('checkout.simulasi');
    Route::post('/checkout/simulasi/proses', [CheckoutController::class, 'prosesSimulasi'])->name('checkout.simulasi.proses');
    Route::post('/orders/{id}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/auto-update-status', [OrderController::class, 'autoUpdateStatus'])->name('orders.autoUpdateStatus');
});

// Admin Routes (Protected)
Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

    // Admin Food CRUD
    Route::get('/admin/foods', [FoodController::class, 'adminIndex'])->name('admin.foods.index');
    Route::get('/admin/foods/create', [FoodController::class, 'create'])->name('admin.foods.create');
    Route::post('/admin/foods', [FoodController::class, 'store'])->name('admin.foods.store');
    Route::get('/admin/foods/{id}/edit', [FoodController::class, 'edit'])->name('admin.foods.edit');
    Route::put('/admin/foods/{id}', [FoodController::class, 'update'])->name('admin.foods.update');
    Route::delete('/admin/foods/{id}', [FoodController::class, 'destroy'])->name('admin.foods.destroy');

    // Admin Order CRUD
    Route::resource('orders', OrderController::class)->only(['edit', 'update', 'destroy']);
});
