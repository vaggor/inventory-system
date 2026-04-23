<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'processLogin'])->name('users.processLogin');
Route::post('/logout', [UserController::class, 'logout'])->name('users.logout');

Route::get('/register', [UserController::class, 'create'])->name('users.create');
//Route::post('/register', [UserController::class, 'store'])->name('users.store');

Route::middleware('auth')->group(function () {
    Route::resource('items', ItemController::class);
    Route::resource('users', UserController::class);
    Route::post('/logout', [UserController::class, 'logout'])->name('users.logout');
});

