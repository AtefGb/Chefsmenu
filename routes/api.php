<?php

use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// Route CRUD RESTAURANTS
Route::get('/restaurants', [RestaurantController::class, 'index']);
Route::post('/restaurants', [RestaurantController::class, 'store']);
Route::get('/restaurant/{restaurant}', [RestaurantController::class, 'show']);
Route::put('/restaurants/{restaurant}', [RestaurantController::class, 'update']);
Route::delete('/restaurants/{restaurant}', [RestaurantController::class, 'destroy']);

// Route CRUD PRODUITS
Route::get('/produits', [ProduitController::class, 'index']);
Route::post('/produits', [ProduitController::class, 'store']);
Route::get('/produits/{produit}', [ProduitController::class, 'show']);
Route::put('/produits/{produit}', [ProduitController::class, 'update']);
Route::delete('/produits/{produit}', [ProduitController::class, 'destroy']);

// Route CONNEXION
Route::get('/register', [AuthController::class, 'register'])->name('register.register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'store']);
// Route::post('/register', [AuthController::class, 'store'])->name('register.store');
