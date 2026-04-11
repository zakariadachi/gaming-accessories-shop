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

        $similaires = Produit::where('categorie_id', $produit->categorie_id)
            ->where('id', '!=', $produit->id)
            ->limit(4)
            ->get();

        return view('produits.show', compact('produit', 'similaires'));
    }
}
