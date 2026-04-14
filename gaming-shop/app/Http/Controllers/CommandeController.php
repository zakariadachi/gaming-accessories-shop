<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CommandeController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('produits.index')->with('error', 'Votre panier est vide.');
        }

        $commande = Commande::create([
            'date'    => now(),
            'statut'  => 'en_attente',
            'user_id' => auth()->id(),
        ]);

        foreach ($cart as $item) {
            $produit = Produit::find($item['id']);

            if (!$produit || $produit->stock < $item['quantity']) {
                $commande->delete();
                return back()->with('error', 'Stock insuffisant pour "' . $item['nom'] . '".');
            }

            LigneCommande::create([
                'commande_id' => $commande->id,
                'produit_id'  => $item['id'],
                'quantity'    => $item['quantity'],
            ]);

            $produit->decrement('stock', $item['quantity']);
        }

        session()->forget('cart');

        return redirect()->route('commandes.index')->with('success', 'Commande passée avec succès !');
    }

    public function index()
    {
        $commandes = Commande::with('ligneCommandes.produit')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('commandes.index', compact('commandes'));
    }

    public function show(Commande $commande)
    {
        if ($commande->user_id !== auth()->id()) {
            abort(403);
        }

        $commande->load('ligneCommandes.produit');

        return view('commandes.show', compact('commande'));
    }
}
