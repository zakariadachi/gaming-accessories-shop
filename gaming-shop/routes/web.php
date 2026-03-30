<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
Route::get('/produits/{produit}', [ProduitController::class, 'show'])->name('produits.show');

Route::middleware('guest')->group(function () {
    Route::get('/register', fn() => view('auth.register'))->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', fn() => view('auth.login'))->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/profil', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil/infos', [ProfilController::class, 'updateInfos'])->name('profil.infos');
    Route::put('/profil/password', [ProfilController::class, 'updatePassword'])->name('profil.password');

    Route::get('/cart', fn() => redirect()->route('produits.index'))->name('cart.index');
    Route::post('/cart/{produit}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');
});
