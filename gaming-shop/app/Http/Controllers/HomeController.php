<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Produit;

class HomeController extends Controller
{
    public function index()
    {
        $produits   = Produit::with('categorie')->latest()->take(4)->get();
        $categories = Categorie::all();

        return view('home', compact('produits', 'categories'));
    }
}
