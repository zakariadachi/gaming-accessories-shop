<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Produit $produit): RedirectResponse
    {
        $request->validate([
            'note'        => ['required', 'integer', 'min:1', 'max:5'],
            'commentaire' => ['required', 'string', 'min:10', 'max:500'],
        ]);

        $aAchete = Auth::user()->commandes()
            ->whereHas('ligneCommandes', fn($q) => $q->where('produit_id', (int) $produit->id))
            ->exists();

        if (!$aAchete) {
            return back()->with('error', 'Vous devez acheter ce produit avant de laisser un avis.');
        }

        $dejaAvis = Review::where('user_id', (int) Auth::id())
            ->where('produit_id', (int) $produit->id)
            ->exists();

        if ($dejaAvis) {
            return back()->with('error', 'Vous avez déjà laissé un avis pour ce produit.');
        }

        Review::create([
            'user_id'     => Auth::id(),
            'produit_id'  => $produit->id,
            'note'        => $request->note,
            'commentaire' => $request->commentaire,
        ]);

        return back()->with('success', 'Votre avis a été publié avec succès.');
    }

    public function update(Request $request, Review $review): RedirectResponse
    {
        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'note'        => ['required', 'integer', 'min:1', 'max:5'],
            'commentaire' => ['required', 'string', 'min:10', 'max:500'],
        ]);

        $review->update([
            'note'        => $request->note,
            'commentaire' => $request->commentaire,
        ]);

        return back()->with('success', 'Votre avis a été modifié avec succès.');
    }

    public function destroy(Review $review): RedirectResponse
    {
        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        $review->delete();

        return back()->with('success', 'Votre avis a été supprimé.');
    }
}
