<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('welcome');
})->name('dashboard');

// Registration Route
Route::get('/register', [AuthController::class, 'registerPage'])->name('register.page');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

// Login Routes
Route::get('/', [AuthController::class, 'loginPage'])->name('login.page');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::middleware(['web'])->group(function () {
    // Category
    Route::resource('categories', CategoryController::class);
    // Product
    Route::resource('products', ProductController::class);

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});
