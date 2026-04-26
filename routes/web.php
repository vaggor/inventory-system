<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'processLogin'])->name('users.processLogin');
Route::post('/logout', [UserController::class, 'logout'])->name('users.logout');

Route::get('/register', [UserController::class, 'create'])->name('users.create');
Route::post('/register', [UserController::class, 'store'])->name('users.store');

Route::middleware('auth')->group(function () {
    Route::resource('items', ItemController::class);
    Route::resource('users', UserController::class);
    Route::post('/logout', [UserController::class, 'logout'])->name('users.logout');
    Route::resource('transactions', TransactionController::class);
    Route::resource('dashboard', DashboardController::class);
});

// Admin only routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('locations', LocationController::class);
    Route::resource('categories', CategoryController::class);
});
