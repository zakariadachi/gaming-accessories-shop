@extends('layouts.main')

@section('title', 'Commande confirmée - GearHub')

@section('content')

<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">

    {{-- Animation succès --}}
    <div class="relative mb-8">
        <div class="w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6"
            style="background: linear-gradient(135deg, #00d4ff20, #00e67620); border: 2px solid #00e676; box-shadow: 0 0 40px #00e67630;">
            <span class="material-symbols-outlined text-5xl" style="color: #00e676; font-variation-settings: 'FILL' 1;">check_circle</span>
        </div>
    </div>

    {{-- Message principal --}}
    <h1 class="text-4xl font-black text-white mb-3">
        Paiement <span style="background: linear-gradient(135deg, #00e676, #00d4ff); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">réussi !</span>
    </h1>
    <p class="text-[#6b6b9a] text-lg mb-2">Merci pour votre commande.</p>
    <p class="text-[#6b6b9a] mb-10">
        Votre commande <span class="text-white font-bold">#{{ $commande->id }}</span> a été confirmée.
    </p>

    {{-- Récapitulatif --}}
    <div class="rounded-2xl overflow-hidden mb-8 text-left" style="background: #0f0f23; border: 1px solid #1e1e3f;">

        <div class="px-6 py-4 border-b flex items-center justify-between" style="border-color: #1e1e3f;">
            <h2 class="font-black text-white">Récapitulatif</h2>
            <span class="text-xs font-bold px-3 py-1 rounded-full" style="background: #00d4ff15; border: 1px solid #00d4ff30; color: #00d4ff;">
                Confirmée
            </span>
        </div>

        <div class="divide-y" style="divide-color: #1e1e3f;">
            @foreach ($commande->ligneCommandes as $ligne)
                <div class="flex items-center gap-4 p-4">
                    <div class="w-12 h-12 rounded-xl overflow-hidden flex-shrink-0" style="background: #1a1a35;">
                        @if ($ligne->produit->image)
                            <img src="{{ $ligne->produit->image }}" alt="{{ $ligne->produit->nom }}" class="w-full h-full object-cover"/>
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <span class="material-symbols-outlined text-xl" style="color: #6b6b9a;">sports_esports</span>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-bold text-white text-sm truncate">{{ $ligne->produit->nom }}</p>
                        <p class="text-xs text-[#6b6b9a]">Quantité : {{ $ligne->quantity }}</p>
                    </div>
                    <span class="font-black text-sm" style="color: #00d4ff;">
                        {{ number_format($ligne->produit->prix * $ligne->quantity, 2) }} €
                    </span>
                </div>
            @endforeach
        </div>

        <div class="px-6 py-4 flex justify-between items-center border-t" style="border-color: #1e1e3f; background: #1a1a35;">
            <span class="font-black text-white">Total payé</span>
            <span class="text-xl font-black" style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                {{ number_format($commande->total(), 2) }} €
            </span>
        </div>
    </div>

    {{-- Actions --}}
    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
        <a href="{{ route('commandes.show', $commande) }}"
            class="flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-white transition-all hover:scale-105"
            style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); box-shadow: 0 0 20px #00d4ff20;">
            <span class="material-symbols-outlined text-sm">receipt_long</span>
            Voir ma commande
        </a>
        <a href="{{ route('produits.index') }}"
            class="flex items-center gap-2 px-6 py-3 rounded-xl font-bold transition-all hover:scale-105"
            style="border: 1px solid #1e1e3f; color: #c8c8e8;">
            <span class="material-symbols-outlined text-sm">storefront</span>
            Continuer mes achats
        </a>
    </div>

</div>

@endsection
