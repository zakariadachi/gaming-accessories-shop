<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\Produit;
use App\Models\Transaction;
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

        // Calcul réduction points (1 point = 0.10€, max 20% du total)
        $utiliserPoints = $request->boolean('utiliser_points');
        $reduction = 0;
        $pointsUtilises = 0;

        if ($utiliserPoints && $user->points > 0) {
            // 1 point = 0.10€
            $reductionMaxPoints = $user->points * 0.10;

            // Max 20% du total panier
            $reductionMax20 = $totalPanier * 0.20;

            // Prendre le minimum des deux
            $reduction = min($reductionMaxPoints, $reductionMax20);

            // Garder minimum 0.50€ pour Stripe
            $reduction = min($reduction, $totalPanier - 0.50);
            $reduction = max(0, round($reduction, 2));

            // Points utilisés = réduction / 0.10
            $pointsUtilises = (int) ceil($reduction / 0.10);

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
        $reduction = $pointsUtilises * 0.10;
        if ($pointsUtilises > 0) {
            Auth::user()->decrement('points', $pointsUtilises);
            session()->forget('points_utilises');
        }

        // Ajouter les points gagnés (1€ = 1 point)
        $total = $commande->load('ligneCommandes.produit')->total();
        $pointsGagnes = (int) floor($total);
        Auth::user()->increment('points', $pointsGagnes);

        // Sauvegarder la transaction
        Transaction::create([
            'user_id'          => Auth::id(),
            'commande_id'      => $commande->id,
            'amount'           => $total - $reduction,
            'status'           => 'paid',
            'stripe_session_id'=> $request->session_id,
        ]);

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
