<?php

use App\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; 

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route de connection et inscription
Route::post('/register', [AuthController::class, 'store'])->name('register.store');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/api/login', [AuthController::class, 'login']);

// Route de déconnection
Route::post('/logout', [AuthController::class, 'logout']);

// Route CRUD restaurants
Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
Route::post('/restaurants', [RestaurantController::class, 'store'])->name('restaurants.store');
Route::get('/restaurant/{restaurant}', [RestaurantController::class, 'show'])->name('restaurants.show');
Route::put('/restaurants/{restaurant}', [RestaurantController::class, 'update'])->name('restaurants.update');
Route::delete('/restaurants/{restaurant}', [RestaurantController::class, 'destroy'])->name('restaurants.destroy');







Route::delete('/restaurants/{restaurant}', [RestaurantController::class, 'destroy']);