<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminCategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::withCount('produits')->latest()->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nom'         => ['required', 'string', 'max:255', 'unique:categories,nom'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        Categorie::create($request->only('nom', 'description'));

        return back()->with('success', 'Catégorie "' . $request->nom . '" créée avec succès.');
        
    }

    public function update(Request $request, Categorie $categorie): RedirectResponse
    {
        $request->validate([
            'nom'         => ['required', 'string', 'max:255', 'unique:categories,nom,' . $categorie->id],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        $categorie->update($request->only('nom', 'description'));

        return back()->with('success', 'Catégorie mise à jour avec succès.');
    }

    public function destroy(Categorie $categorie): RedirectResponse
    {
        if ($categorie->produits()->exists()) {
            return back()->with('error', 'Impossible de supprimer une catégorie qui contient des produits.');
        }

        $categorie->delete();

        return back()->with('success', 'Catégorie supprimée avec succès.');
    }
}
