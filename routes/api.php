<?php

use App\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestaurateurAuthController;

// Routes d'authentification
Route::post('/register', [AuthController::class, 'store'])->name('register.store');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes CRUD pour les restaurants
Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
Route::post('/restaurants', [RestaurantController::class, 'store'])->name('restaurants.store');
Route::get('/restaurants/{restaurant}', [RestaurantController::class, 'show'])->name('restaurants.show');
Route::put('/restaurants/{restaurant}', [RestaurantController::class, 'update'])->name('restaurants.update');
Route::delete('/restaurants/{restaurant}', [RestaurantController::class, 'destroy'])->name('restaurants.destroy');
Route::middleware('auth:api')->post('/restaurants', [RestaurantController::class, 'store'])->name('restaurants.store');

