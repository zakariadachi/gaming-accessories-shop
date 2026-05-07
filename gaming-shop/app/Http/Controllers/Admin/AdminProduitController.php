<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class AdminProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::with('categorie')->latest()->paginate(15);
        return view('admin.produits.index', compact('produits'));
    }

    public function create()
    {
        $categories = Categorie::all();
        return view('admin.produits.create', compact('categories'));
    }

    public function show(Produit $produit)
    {
        $produit->load('categorie', 'reviews.user');
        return view('admin.produits.show', compact('produit'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nom'          => ['required', 'string', 'max:255'],
            'prix'         => ['required', 'numeric', 'min:0'],
            'stock'        => ['required', 'integer', 'min:0'],
            'image'        => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
            'categorie_id' => ['required', 'exists:categories,id'],
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('produits', 'public');
        }

        Produit::create($data);

        return redirect()->route('admin.produits.index')->with('success', 'Produit créé avec succès.');
    }

    public function edit(Produit $produit)
    {
        $categories = Categorie::all();
        return view('admin.produits.edit', compact('produit', 'categories'));
    }

    public function update(Request $request, Produit $produit): RedirectResponse
    {
        $data = $request->validate([
            'nom'          => ['required', 'string', 'max:255'],
            'prix'         => ['required', 'numeric', 'min:0'],
            'stock'        => ['required', 'integer', 'min:0'],
            'image'        => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
            'categorie_id' => ['required', 'exists:categories,id'],
        ]);

        if ($request->hasFile('image')) {
            if ($produit->image) {
                Storage::disk('public')->delete($produit->image);
            }
            $data['image'] = $request->file('image')->store('produits', 'public');
        } else {
            unset($data['image']);
        }

        $produit->update($data);

        return redirect()->route('admin.produits.index')->with('success', 'Produit mis à jour avec succès.');
    }

    public function destroy(Produit $produit): RedirectResponse
    {
        if ($produit->ligneCommandes()->exists()) {
            return back()->with('error', 'Impossible de supprimer ce produit car il est lié à des commandes existantes. Veuillez modifier son stock à 0 au lieu de le supprimer.');
        }

        if ($produit->image) {
            Storage::disk('public')->delete($produit->image);
        }

        $produit->delete();
        return redirect()->route('admin.produits.index')->with('success', 'Produit supprimé avec succès.');
    }
}
