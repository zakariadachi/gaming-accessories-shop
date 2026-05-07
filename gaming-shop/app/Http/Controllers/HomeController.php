<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Produit;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();

        $produits = Produit::with('categorie')
            ->latest()
            ->take(4)
            ->get();

        return view('home', compact('produits', 'categories'));
    }
}
