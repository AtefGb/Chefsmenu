<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\RestaurateurAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



//Route::middleware('auth:sanctum')->group(function() {
    

    Route::get('/restaurants', [RestaurantController::class, 'index']);
    Route::post('/restaurants', [RestaurantController::class, 'store']);
    Route::get('/restaurant/{restaurant}', [RestaurantController::class, 'show']);
    Route::put('/restaurants/{restaurant}', [RestaurantController::class, 'update']);
    Route::delete('/restaurants/{restaurant}', [RestaurantController::class, 'destroy']);
    
    Route::post('/logout', [RestaurateurAuthController::class, 'logout']);

//});

Route::post('/register', [RestaurateurAuthController::class, 'store'])->name('register.store');
Route::post('/login', [RestaurateurAuthController::class, 'login'])->name('login');
Route::post('/api/login', [AuthController::class, 'login']);
//Route::post('/api/logout', [RestaurateurAuthController::class, 'logout']);



