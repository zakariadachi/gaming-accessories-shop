<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class AdminCommandeController extends Controller
{
    public function index()
    {
        $commandes = Commande::with('user', 'ligneCommandes.produit')
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.commandes.index', compact('commandes'));
    }

    public function updateStatut(Request $request, Commande $commande): RedirectResponse
    {
        $request->validate([
            'statut' => ['required', 'in:' . implode(',', Commande::STATUTS)],
        ]);

        if ($request->statut === 'annulée' && $commande->statut !== 'annulée') {

            DB::transaction(function () use ($commande) {
                foreach ($commande->ligneCommandes as $ligne) {
                    $ligne->produit->increment('stock', $ligne->quantity);
                }
                $commande->update(['statut' => 'annulée']);
            });

            return back()->with('success', 'Commande annulée et stock restauré avec succès.');
        }

        $commande->update(['statut' => $request->statut]);

        return back()->with('success', 'Statut de la commande #' . $commande->id . ' mis à jour.');
    }

    public function show(Commande $commande)
    {
        $commande->load('user', 'ligneCommandes.produit.categorie');

        return view('admin.commandes.show', compact('commande'));
    }
}
