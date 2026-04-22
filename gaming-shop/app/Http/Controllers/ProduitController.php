<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index(Request $request)
    {
        $query = Produit::with('categorie');

        if ($request->filled('categorie')) {
            $query->where('categorie_id', $request->categorie);
        }

        if ($request->filled('search')) {
            $query->where('nom', 'like', '%' . $request->search . '%');
        }

        match($request->input('tri')) {
            'prix_asc'  => $query->orderBy('prix', 'asc'),
            'prix_desc' => $query->orderBy('prix', 'desc'),
            'nom_asc'   => $query->orderBy('nom', 'asc'),
            default     => $query->latest(),
        };

        $produits   = $query->paginate(12);
        $categories = Categorie::all();

        return view('produits.index', compact('produits', 'categories'));
    }

    public function show(Produit $produit)
    {
        $produit->load('categorie');

        $reviews = $produit->reviews()->with('user')->latest()->paginate(5);

        $similaires = Produit::where('categorie_id', $produit->categorie_id)
            ->where('id', '!=', $produit->id)
            ->limit(4)
            ->get();

        $aAchete = auth()->check() && auth()->user()->commandes()
            ->whereHas('ligneCommandes', fn($q) => $q->where('produit_id', $produit->id))
            ->exists();

        $aDejaAvis = auth()->check() && $produit->reviews()->where('user_id', auth()->id())->exists();

        return view('produits.show', compact('produit', 'reviews', 'similaires', 'aAchete', 'aDejaAvis'));
    }
}
