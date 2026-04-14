<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ProfilController;
// use App\Http\Controllers\Admin\AdminDashboardController;
// use App\Http\Controllers\Admin\AdminProduitController;
// use App\Http\Controllers\Admin\AdminCategorieController;
// use App\Http\Controllers\Admin\AdminCommandeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
Route::get('/produits/{produit}', [ProduitController::class, 'show'])->name('produits.show');
Route::get('/communaute', fn() => view('communaute.index'))->name('communaute.index');

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

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{produit}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');

});

// // Routes Admin
// Route::prefix('admin')->name('admin.')->middleware(['auth', 'isAdmin'])->group(function () {
//     Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

//     Route::resource('produits', AdminProduitController::class);
//     Route::resource('categories', AdminCategorieController::class);

//     Route::get('/commandes', [AdminCommandeController::class, 'index'])->name('commandes.index');
//     Route::patch('/commandes/{commande}/statut', [AdminCommandeController::class, 'updateStatut'])->name('commandes.statut');
// });
