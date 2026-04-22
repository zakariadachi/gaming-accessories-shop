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

        $lineItems = [];

        foreach ($cart as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency'     => 'eur',
                    'product_data' => ['name' => $item['nom']],
                    'unit_amount'  => (int) ($item['prix'] * 100),
                ],
                'quantity' => $item['quantity'],
            ];
        }

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items'           => $lineItems,
            'mode'                 => 'payment',
            'success_url'          => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'           => route('cart.index'),
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

        return redirect()->route('payment.confirmation', $commande)->with('success', 'Paiement réussi ! Votre commande a été confirmée.');
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
