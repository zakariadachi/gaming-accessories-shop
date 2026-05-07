<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'search'    => 'nullable|string|max:255',
            'categorie' => 'nullable|exists:categories,id',
            'tri'       => 'nullable|in:prix_asc,prix_desc,nom_asc'
        ]);

        $query = Produit::with('categorie');

        if ($request->filled('categorie')) {
            $query->where('categorie_id', (int) $request->categorie);
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

        $produits   = $query->paginate(12)->withQueryString(); 
        $categories = Categorie::all();

        return view('produits.index', compact('produits', 'categories'));
    }

    public function show(Produit $produit)
    {
        $produit->load('categorie');

        $reviews = $produit->reviews()->with('user')->latest()->paginate(5);

        $similaires = Produit::where('categorie_id', $produit->categorie_id)
            ->where('id', '!=', $produit->id)
            ->inRandomOrder() 
            ->limit(4)
            ->get();

        $user = auth()->user();
        $aAchete = false;
        $aDejaAvis = false;

        if ($user) {
            $aAchete = $user->commandes()
                ->where('statut', 'confirmée')
                ->whereHas('ligneCommandes', fn($q) => $q->where('produit_id', $produit->id))
                ->exists();

            $aDejaAvis = $produit->reviews()->where('user_id', $user->id)->exists();
        }

        return view('produits.show', compact('produit', 'reviews', 'similaires', 'aAchete', 'aDejaAvis'));
    }
}