<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Produit;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();

        $produits = $categories->take(4)->map(function ($categorie) {
            return Produit::with('categorie')
                ->where('categorie_id', $categorie->id)
                ->latest()
                ->first();
        })->filter();

        return view('home', compact('produits', 'categories'));
    }
}
