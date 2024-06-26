<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormuleController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\DetailCommandeController;


// Route CRUD RESTAURANTS
Route::get('/restaurants', [RestaurantController::class, 'index']);
Route::middleware('auth:sanctum')->post('/restaurants', [RestaurantController::class, 'store']);
Route::get('/restaurant/{restaurant}', [RestaurantController::class, 'show']);
Route::middleware('auth:sanctum')->put('/restaurant/{restaurant}', [RestaurantController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/restaurants/{restaurant}', [RestaurantController::class, 'destroy']);

// Route CRUD PRODUITS
Route::get('/produits', [ProduitController::class, 'index']);
Route::middleware('auth:sanctum')->post('/produits', [ProduitController::class, 'store']);
Route::get('/produits/{produit}', [ProduitController::class, 'show']);
Route::middleware('auth:sanctum')->put('/produits/{produit}', [ProduitController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/produits/{produit}', [ProduitController::class, 'destroy']);

// Route CRUD FORMULES
Route::get('/formules', [FormuleController::class, 'index']);
Route::middleware('auth:sanctum')->post('/formules', [FormuleController::class, 'store']);
Route::get('/formules/{formule}', [FormuleController::class, 'show']);
Route::middleware('auth:sanctum')->put('/formules/{formule}', [FormuleController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/formules/{formule}', [FormuleController::class, 'destroy']);

// Route CRUD TABLES
Route::get('/tables', [TableController::class, 'index']);
Route::middleware('auth:sanctum')->post('/tables', [TableController::class, 'store']);
Route::get('/tables/{table}', [TableController::class, 'show']);
Route::middleware('auth:sanctum')->put('/tables/{table}', [TableController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/tables/{table}', [TableController::class, 'destroy']);

// Route CRUD COMMANDES
Route::get('/commandes', [CommandeController::class, 'index']);
Route::middleware('auth:sanctum')->post('/commandes', [CommandeController::class, 'store']);
Route::get('/commandes/{commande}', [CommandeController::class, 'show']);
Route::middleware('auth:sanctum')->put('/commandes/{commande}', [CommandeController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/commandes/{commande}', [CommandeController::class, 'destroy']);

// Route CRUD DETAILS COMMANDES
Route::get('/detailCommandes', [DetailCommandeController::class, 'index']);
Route::middleware('auth:sanctum')->post('/detailCommandes', [DetailCommandeController::class, 'store']);
Route::get('/detailCommandes/{detailCommande}', [DetailCommandeController::class, 'show']);
Route::middleware('auth:sanctum')->put('/detailCommandes/{detailCommande}', [DetailCommandeController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/detailCommandes/{detailCommande}', [DetailCommandeController::class, 'destroy']);


// Route CONNEXION
Route::post('/register', [AuthController::class, 'store'])->name('register.store');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Route DECONNEXION
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
