<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'produits'    => Produit::count(),
            'categories'  => Categorie::count(),
            'commandes'   => Commande::count(),
            'utilisateurs' => User::where('role', 'client')->count(),
            'stock_faible' => Produit::where('stock', '<=', 5)->count(),
            'rupture'     => Produit::where('stock', 0)->count(),
        ];

        $dernieres_commandes = Commande::with('user')
            ->latest()
            ->take(5)
            ->get();

        $produits_stock_faible = Produit::with('categorie')
            ->where('stock', '<=', 5)
            ->orderBy('stock')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'dernieres_commandes', 'produits_stock_faible'));
    }
}
