<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $user = Auth::user();

        // Calculer le total du panier en euros
        $totalPanier = array_sum(array_map(fn($item) => $item['prix'] * $item['quantity'], $cart));

        // Calcul réduction points (100 points = 5€)
        $utiliserPoints = $request->boolean('utiliser_points');
        $reduction = 0;
        $pointsUtilises = 0;

        if ($utiliserPoints && $user->points >= 100) {
            // Calculer la réduction maximale possible avec les points
            $reductionMaxPossible = floor($user->points / 100) * 5;

            // Limiter la réduction au total du panier (ne peut pas être négatif)
            $reduction = min($reductionMaxPossible, $totalPanier - 0.50); // garder minimum 0.50€
            $reduction = max(0, $reduction); // sécurité : jamais négatif

            // Calculer les points réellement utilisés (inverse de la formule)
            $pointsUtilises = (int) floor($reduction / 5) * 100;

            // Stocker en session pour déduire après paiement
            session(['points_utilises' => $pointsUtilises]);
        }

        // Calculer le total final en centimes pour Stripe
        $totalFinal = $totalPanier - $reduction;
        $totalFinalCents = max(50, (int)($totalFinal * 100)); // minimum 0.50€

        // Créer l'item Stripe avec le total final
        $nomProduit = 'Commande GearHub';
        if ($reduction > 0) {
            $nomProduit .= ' (réduction -' . number_format($reduction, 2) . '€ avec ' . $pointsUtilises . ' points)';
        }

        $lineItems = [[
            'price_data' => [
                'currency'     => 'eur',
                'product_data' => ['name' => $nomProduit],
                'unit_amount'  => $totalFinalCents,
            ],
            'quantity' => 1,
        ]];

        $session = Session::create([
            'line_items'  => $lineItems,
            'mode'        => 'payment',
            'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'  => route('cart.index'),
        ]);

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::retrieve($request->session_id);

        if ($session->payment_status !== 'paid') {
            return redirect()->route('cart.index')->with('error', 'Paiement non confirmé.');
        }

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('commandes.index');
        }

        $commande = Commande::create([
            'user_id' => Auth::id(),
            'date'    => now()->toDateString(),
            'statut'  => 'confirmée',
        ]);

        foreach ($cart as $item) {
            $produit = Produit::find($item['id']);

            if ($produit && $produit->stock >= $item['quantity']) {
                LigneCommande::create([
                    'commande_id' => $commande->id,
                    'produit_id'  => $produit->id,
                    'quantity'    => $item['quantity'],
                ]);
                $produit->decrement('stock', $item['quantity']);
            }
        }

        session()->forget('cart');

        // Déduire les points utilisés
        $pointsUtilises = session('points_utilises', 0);
        if ($pointsUtilises > 0) {
            Auth::user()->decrement('points', $pointsUtilises);
            session()->forget('points_utilises');
        }

        // Ajouter les points gagnés (1€ = 1 point)
        $total = $commande->load('ligneCommandes.produit')->total();
        $pointsGagnes = (int) floor($total);
        Auth::user()->increment('points', $pointsGagnes);

        return redirect()->route('payment.confirmation', $commande)->with('success', 'Paiement réussi ! Vous avez gagné ' . $pointsGagnes . ' points de fidélité 🎉');
    }

    public function cancel()
    {
        return redirect()->route('cart.index')->with('error', 'Paiement annulé.');
    }

    public function confirmation(Commande $commande)
    {
        if ($commande->user_id !== Auth::id()) {
            abort(403);
        }

        $commande->load('ligneCommandes.produit');

        return view('payment.confirmation', compact('commande'));
    }
}
