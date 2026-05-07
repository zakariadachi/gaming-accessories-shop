<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class CommandeController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('produits.index')->with('error', 'Votre panier est vide.');
        }

        try {
            DB::transaction(function () use ($cart) {

                $commande = Commande::create([
                    'date'    => now(),
                    'statut'  => 'en_attente',
                    'user_id' => auth()->id(),
                ]);

                foreach ($cart as $item) {
                    $produit = Produit::lockForUpdate()->find($item['id']);

                    if (!$produit || $produit->stock < $item['quantity']) {
                        throw new \Exception('Stock insuffisant pour "' . $item['nom'] . '".');
                    }

                    LigneCommande::create([
                        'commande_id'  => $commande->id,
                        'produit_id'   => $item['id'],
                        'quantity'     => $item['quantity'],
                        'prix_unitaire' => $produit->prix,
                    ]);

                    $produit->decrement('stock', $item['quantity']);
                }
            });

            session()->forget('cart');
            return redirect()->route('commandes.index')->with('success', 'Commande passée avec succès !');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function index()
    {
        $commandes = Commande::with('ligneCommandes.produit.categorie')
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

        $commande->load('ligneCommandes.produit.categorie');

        return view('commandes.show', compact('commande'));
    }
}
