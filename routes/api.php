<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestaurateurAuthController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\GlobalState\Restorer;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/register', [RestaurateurAuthController::class, 'store'])->name('register.store');
//Route::get('/register', [RestaurateurAuthController::class, 'register'])->name('register.register');

Route::post('/login', [RestaurateurAuthController::class, 'login'])->name('login');
Route::post ('/logout',[RestaurateurAuthController::class,'logout']);

Route::post('/api/login', [AuthController::class, 'login']);


//Route::post('/register', [RestaurateurAuthController::class, 'store']);
// Route::post('/login', [RestaurateurAuthController::class, 'authenticate']);
