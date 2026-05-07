<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\Produit;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        session()->forget('points_utilises'); 
        
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        Stripe::setApiKey(config('services.stripe.secret', env('STRIPE_SECRET')));

        $ids      = array_keys($cart);
        $produits = Produit::whereIn('id', $ids)->get()->keyBy('id');
        
        $total = collect($cart)->map(fn($item, $id) => ($produits[$id]->prix ?? 0) * $item['quantity'])->sum();

        $reduction      = 0;
        $pointsUtilises = 0;

        if ($request->boolean('utiliser_points') && Auth::user()->points > 0) {
            $reduction      = round(min(Auth::user()->points * 0.10, $total * 0.20, $total - 0.50), 2);
            $pointsUtilises = (int) ceil($reduction / 0.10);
            session(['points_utilises' => $pointsUtilises]);
        }

        try {
            $session = Session::create([
                'line_items'  => [[
                    'price_data' => [
                        'currency'     => 'eur',
                        'product_data' => ['name' => 'Commande GearHub' . ($reduction > 0 ? " (-{$reduction}€)" : '')],
                        'unit_amount'  => max(50, (int)(($total - $reduction) * 100)),
                    ],
                    'quantity' => 1,
                ]],
                'mode'        => 'payment',
                'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url'  => route('cart.index'),
            ]);

            return redirect($session->url);
        } catch (\Exception $e) {
            return redirect()->route('cart.index')->with('error', 'Erreur de connexion avec Stripe.');
        }
    }

    public function success(Request $request)
    {
        $sessionId = $request->validate([
            'session_id' => ['required', 'string', 'max:255', 'regex:/^cs_(test|live)_[a-zA-Z0-9]+$/'],
        ])['session_id'];

        // Vérifier si ce paiement a déjà été traité (Idempotency)
        if (Transaction::where('stripe_session_id', $sessionId)->exists()) {
            $commande = Commande::where('user_
            id', Auth::id())->latest()->first();
            return redirect()->route('payment.confirmation', $commande);
        }

        Stripe::setApiKey(config('services.stripe.secret', env('STRIPE_SECRET')));

        try {
            $stripeSession = Session::retrieve($sessionId);
            if ($stripeSession->payment_status !== 'paid') {
                return redirect()->route('cart.index')->with('error', 'Paiement non confirmé.');
            }
        } catch (\Exception $e) {
            return redirect()->route('cart.index')->with('error', 'Session Stripe invalide.');
        }

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('commandes.index');
        }

        // si une erreur survient, tout est annule
        DB::beginTransaction();
        try {
            $commande = Commande::create([
                'user_id' => Auth::id(),
                'date'    => now()->toDateString(),
                'statut'  => 'confirmée',
            ]);

            foreach ($cart as $id => $item) {
                $produit = Produit::lockForUpdate()->find($id); // Lock pour éviter les race conditions
                
                if ($produit && $produit->stock >= $item['quantity']) {
                    LigneCommande::create([
                        'commande_id'  => $commande->id,
                        'produit_id'   => $produit->id,
                        'quantity'     => $item['quantity'],
                        'prix_unitaire' => $produit->prix,
                    ]);
                    $produit->decrement('stock', $item['quantity']);
                }
            }

            $pointsUtilises = session('points_utilises', 0);
            $reduction      = round($pointsUtilises * 0.10, 2);

            $total        = $commande->load('ligneCommandes')->total;
            $pointsGagnes = (int) floor($total);
            Auth::user()->increment('points', $pointsGagnes);

            Transaction::create([
                'user_id'           => Auth::id(),
                'commande_id'       => $commande->id,
                'amount'            => round($total - $reduction, 2),
                'status'            => 'paid',
                'stripe_session_id' => $sessionId,
            ]);

            DB::commit();
            
            session()->forget(['cart', 'points_utilises']);

            return redirect()->route('payment.confirmation', $commande)
                ->with('success', 'Paiement réussi ! Vous avez gagné ' . $pointsGagnes . ' points 🎉');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.index')->with('error', 'Une erreur est survenue lors de la création de votre commande.');
        }
    }

    public function cancel()
    {
        return redirect()->route('cart.index')->with('error', 'Paiement annulé.');
    }

    public function confirmation(Commande $commande)
    {
        abort_if($commande->user_id !== Auth::id(), 403);
        return view('payment.confirmation', ['commande' => $commande->load('ligneCommandes.produit')]);
    }
}