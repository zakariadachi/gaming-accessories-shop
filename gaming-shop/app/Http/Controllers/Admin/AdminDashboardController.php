<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\User;
use App\Models\Transaction;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $revenu_total = Transaction::where('status', 'paid')->sum('amount');

        $stats = [
            'produits'     => Produit::count(),
            'categories'   => Categorie::count(),
            'commandes'    => Commande::count(),
            'en_attente'   => Commande::where('statut', 'en_attente')->count(),
            'revenu_total' => $revenu_total,
            'utilisateurs' => User::where('role', 'client')->count(),
            'stock_faible' => Produit::where('stock', '<=', 5)->where('stock', '>', 0)->count(),
            'rupture'      => Produit::where('stock', 0)->count(),
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
