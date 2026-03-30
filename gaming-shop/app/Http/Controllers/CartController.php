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

    private function calculateTotal(array $cart): float
    {
        return array_sum(array_map(fn($item) => $item['prix'] * $item['quantity'], $cart));
    }

    public function index(Request $request)
    {
        $cart  = $this->getCart($request);
        $total = $this->calculateTotal($cart);

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'quantity' => ['integer', 'min:1', 'max:99'],
        ]);

        $produit = Produit::find($id);

        if (!$produit) {
            return back()->with('error', 'Ce produit n\'existe pas.');
        }

        if ($produit->stock === 0) {
            return back()->with('error', '"' . $produit->nom . '" est en rupture de stock.');
        }

        $quantity = $request->input('quantity', 1);

        if ($quantity > $produit->stock) {
            return back()->with('error', 'Quantité demandée indisponible. Seulement ' . $produit->stock . ' disponible(s).');
        }

        $cart = $this->getCart($request);

        if (isset($cart[$id])) {
            $newQuantity = $cart[$id]['quantity'] + $quantity;

            if ($newQuantity > $produit->stock) {
                return back()->with('error', 'Stock insuffisant. Vous avez déjà ' . $cart[$id]['quantity'] . ' dans le panier, seulement ' . $produit->stock . ' disponible(s).');
            }

            $cart[$id]['quantity'] = $newQuantity;
        } else {
            $cart[$id] = [
                'id'       => $produit->id,
                'nom'      => $produit->nom,
                'prix'     => $produit->prix,
                'image'    => $produit->image,
                'quantity' => $quantity,
            ];
        }

        $this->saveCart($request, $cart);

        return back()->with('success', '"' . $produit->nom . '" ajouté au panier.');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        $cart = $this->getCart($request);

        if (!isset($cart[$id])) {
            return back()->with('error', 'Ce produit n\'existe pas dans le panier.');
        }

        $produit = Produit::find($id);

        if (!$produit) {
            unset($cart[$id]);
            $this->saveCart($request, $cart);
            return back()->with('error', 'Ce produit n\'existe plus et a été retiré du panier.');
        }

        if ($request->quantity > $produit->stock) {
            return back()->with('error', 'Stock insuffisant. Seulement ' . $produit->stock . ' disponible(s).');
        }

        $cart[$id]['quantity'] = $request->quantity;
        $cart[$id]['prix']     = $produit->prix;

        $this->saveCart($request, $cart);

        return back()->with('success', 'Quantité mise à jour pour "' . $produit->nom . '".');
    }

    public function remove(Request $request, int $id): RedirectResponse
    {
        $cart = $this->getCart($request);

        if (!isset($cart[$id])) {
            return back()->with('error', 'Ce produit n\'existe pas dans le panier.');
        }

        $nom = $cart[$id]['nom'];

        unset($cart[$id]);

        $this->saveCart($request, $cart);

        return back()->with('success', '"' . $nom . '" retiré du panier.');
    }

    public function clear(Request $request): RedirectResponse
    {
        $cart = $this->getCart($request);

        if (empty($cart)) {
            return back()->with('error', 'Le panier est déjà vide.');
        }

        $request->session()->forget('cart');

        return back()->with('success', 'Panier vidé avec succès.');
    }
}
