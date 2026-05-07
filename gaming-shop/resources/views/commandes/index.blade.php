@extends('layouts.main')

@section('title', 'Mes Commandes - GearHub')

@section('content')

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-4xl font-black tracking-tight">Mes <span style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Commandes</span></h1>
            <p class="text-[#6b6b9a] mt-1">{{ $commandes->count() }} commande(s) au total</p>
        </div>
        <a href="{{ route('produits.index') }}" class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold text-white transition-all hover:scale-105"
            style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); box-shadow: 0 0 15px #00d4ff20;">
            <span class="material-symbols-outlined text-sm">storefront</span>
            Continuer mes achats
        </a>
    </div>

    @if ($commandes->isEmpty())
        <div class="flex flex-col items-center justify-center py-32 text-center">
            <div class="w-24 h-24 rounded-full flex items-center justify-center mb-6"
                style="background: #0f0f23; border: 1px solid #1e1e3f;">
                <span class="material-symbols-outlined text-5xl" style="color: #6b6b9a;">shopping_bag</span>
            </div>
            <h2 class="text-2xl font-bold text-white mb-2">Aucune commande</h2>
            <p class="text-[#6b6b9a] mb-8">Vous n'avez pas encore passé de commande.</p>
            <a href="{{ route('produits.index') }}" class="flex items-center gap-2 px-8 py-3 rounded-xl font-bold text-white transition-all hover:scale-105"
                style="background: linear-gradient(135deg, #00d4ff, #8a2ce2);">
                <span class="material-symbols-outlined">storefront</span>
                Voir les produits
            </a>
        </div>
    @else
        <div class="space-y-4">
            @foreach ($commandes as $commande)
                <a href="{{ route('commandes.show', $commande) }}"
                    class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 rounded-2xl p-6 transition-all hover:translate-y-[-2px] block"
                    style="background: #0f0f23; border: 1px solid #1e1e3f;">

                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0"
                            style="background: #00d4ff15; border: 1px solid #00d4ff30;">
                            <span class="material-symbols-outlined" style="color: #00d4ff;">receipt_long</span>
                        </div>
                        <div>
                            <p class="font-black text-white">Commande #{{ $commande->id }}</p>
                            <p class="text-xs text-[#6b6b9a]">{{ $commande->date->format('d/m/Y') }} · {{ $commande->ligneCommandes->count() }} article(s)</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-6">
                        <div class="text-right">
                            <p class="font-black text-lg" style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                                {{ number_format($commande->total, 2) }} €
                            </p>
                        </div>

                        @php
                            $statuts = [
                                'en_attente' => ['label' => 'En attente', 'color' => '#ffaa00'],
                                'confirmée'  => ['label' => 'Confirmée',  'color' => '#00d4ff'],
                                'annulée'    => ['label' => 'Annulée',    'color' => '#ff3d71'],
                            ];
                            $statut = $statuts[$commande->statut] ?? ['label' => $commande->statut, 'color' => '#6b6b9a'];
                        @endphp

                        <span class="text-xs font-bold px-3 py-1.5 rounded-full"
                            style="background: {{ $statut['color'] }}15; border: 1px solid {{ $statut['color'] }}40; color: {{ $statut['color'] }};">
                            {{ $statut['label'] }}
                        </span>

                        <span class="material-symbols-outlined text-[#6b6b9a]">chevron_right</span>
                    </div>
                </a>
            @endforeach
        </div>
    @endif

</div>

@endsection
