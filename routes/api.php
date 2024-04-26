<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\RestaurateurAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/restaurants', [RestaurantController::class, 'index']);
Route::post('/restaurants', [RestaurantController::class, 'store']);
Route::get('/restaurant/{restaurant}', [RestaurantController::class, 'show']);
Route::put('/restaurants/{restaurant}', [RestaurantController::class, 'update']);
Route::delete('/restaurants/{restaurant}', [RestaurantController::class, 'destroy']);

Route::post('/logout', [RestaurateurAuthController::class, 'logout']);

Route::post('/register', [RestaurateurAuthController::class, 'store'])->name('register.store');
Route::post('/login', [RestaurateurAuthController::class, 'login'])->name('login');
Route::post('/api/login', [AuthController::class, 'login']);
//Route::post('/api/logout', [RestaurateurAuthController::class, 'logout']);


// Route per gestire la reimpostazione della password
Route::post('/api/reset-password-request', [ResetPasswordController::class, 'sendResetLink']);
Route::post('/api/reset-password', [ResetPasswordController::class, 'reset']);




Route::get('/forgot-password', [ResetPasswordController::class, 'forgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');
