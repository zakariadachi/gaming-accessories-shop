<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private function getCart(Request $request): array
    {
        return $request->session()->get('cart', []);
    }

    private function saveCart(Request $request, array $cart): void
    {
        $request->session()->put('cart', $cart);
    }

    public function add(Request $request, Produit $produit): RedirectResponse
    {
        $request->validate([
            'quantity' => ['integer', 'min:1'],
        ]);

        $quantity = $request->input('quantity', 1);

        if ($produit->stock === 0) {
            return back()->with('error', 'Ce produit est en rupture de stock.');
        }

        $cart = $this->getCart($request);

        if (isset($cart[$produit->id])) {
            $newQuantity = $cart[$produit->id]['quantity'] + $quantity;

            if ($newQuantity > $produit->stock) {
                return back()->with('error', 'Stock insuffisant.');
            }

            $cart[$produit->id]['quantity'] = $newQuantity;
        } else {
            if ($quantity > $produit->stock) {
                return back()->with('error', 'Stock insuffisant.');
            }

            $cart[$produit->id] = [
                'id'       => $produit->id,
                'nom'      => $produit->nom,
                'prix'     => $produit->prix,
                'image'    => $produit->image,
                'quantity' => $quantity,
            ];
        }

        $this->saveCart($request, $cart);

        return back()->with('success', 'Produit ajouté au panier.');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $cart = $this->getCart($request);

        if (!isset($cart[$id])) {
            return back()->with('error', 'Produit introuvable dans le panier.');
        }

        $produit = Produit::find($id);

        if ($request->quantity > $produit->stock) {
            return back()->with('error', 'Stock insuffisant.');
        }

        $cart[$id]['quantity'] = $request->quantity;

        $this->saveCart($request, $cart);

        return back()->with('success', 'Quantité mise à jour.');
    }

    public function remove(Request $request, int $id): RedirectResponse
    {
        $cart = $this->getCart($request);

        unset($cart[$id]);

        $this->saveCart($request, $cart);

        return back()->with('success', 'Produit retiré du panier.');
    }

    public function clear(Request $request): RedirectResponse
    {
        $request->session()->forget('cart');

        return back()->with('success', 'Panier vidé.');
    }

    public function index(Request $request)
    {
        $cart  = $this->getCart($request);
        $total = array_sum(array_map(fn($item) => $item['prix'] * $item['quantity'], $cart));

        return view('cart.index', compact('cart', 'total'));
    }
}
