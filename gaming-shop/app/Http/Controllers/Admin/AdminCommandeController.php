<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class AdminCommandeController extends Controller
{
    public function index()
    {
        $commandes = Commande::with('user', 'ligneCommandes.produit')
            ->latest()
            ->paginate(15);

        return view('admin.commandes.index', compact('commandes'));
    }

    public function updateStatut(Request $request, Commande $commande): RedirectResponse
    {
        $request->validate([
            'statut' => ['required', 'in:' . implode(',', Commande::STATUTS)],
        ]);

        $commande->update(['statut' => $request->statut]);

        return back()->with('success', 'Statut de la commande #' . $commande->id . ' mis à jour.');
    }

    public function show(Commande $commande)
    {
        $commande->load('user', 'ligneCommandes.produit.categorie');

        return view('admin.commandes.show', compact('commande'));
    }
}
