@extends('layouts.main')

@section('title', 'Commande #' . $commande->id . ' - GearHub')

@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-sm text-[#6b6b9a] mb-8">
        <a href="{{ route('commandes.index') }}" class="hover:text-[#00d4ff] transition-colors">Mes commandes</a>
        <span>/</span>
        <span style="color: #00d4ff;">Commande #{{ $commande->id }}</span>
    </div>

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-black text-white">Commande <span style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">#{{ $commande->id }}</span></h1>
            <p class="text-[#6b6b9a] mt-1">Passée le {{ $commande->date->format('d/m/Y') }}</p>
        </div>

        @php
            $statuts = [
                'en_attente' => ['label' => 'En attente', 'color' => '#ffaa00', 'icon' => 'schedule'],
                'confirmée'  => ['label' => 'Confirmée',  'color' => '#00d4ff', 'icon' => 'check_circle'],
                'annulée'    => ['label' => 'Annulée',    'color' => '#ff3d71', 'icon' => 'cancel'],
            ];
            $statut = $statuts[$commande->statut] ?? ['label' => $commande->statut, 'color' => '#6b6b9a', 'icon' => 'info'];
        @endphp

        <div class="flex items-center gap-2 px-4 py-2 rounded-xl"
            style="background: {{ $statut['color'] }}15; border: 1px solid {{ $statut['color'] }}40;">
            <span class="material-symbols-outlined text-sm" style="color: {{ $statut['color'] }};">{{ $statut['icon'] }}</span>
            <span class="font-bold text-sm" style="color: {{ $statut['color'] }};">{{ $statut['label'] }}</span>
        </div>
    </div>

    {{-- Produits --}}
    <div class="rounded-2xl overflow-hidden mb-6" style="background: #0f0f23; border: 1px solid #1e1e3f;">
        <div class="px-6 py-4 border-b" style="border-color: #1e1e3f;">
            <h2 class="font-black text-white">Articles commandés</h2>
        </div>

        <div class="divide-y" style="divide-color: #1e1e3f;">
            @foreach ($commande->ligneCommandes as $ligne)
                <div class="flex items-center gap-4 p-4">
                    <a href="{{ route('produits.show', $ligne->produit) }}" class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0"
                        style="background: #1a1a35; border: 1px solid #1e1e3f;">
                        @if ($ligne->produit->image)
                            <img src="{{ $ligne->produit->image }}" alt="{{ $ligne->produit->nom }}" class="w-full h-full object-cover"/>
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <span class="material-symbols-outlined text-2xl" style="color: #6b6b9a;">sports_esports</span>
                            </div>
                        @endif
                    </a>
                    <div class="flex-1 min-w-0">
                        <a href="{{ route('produits.show', $ligne->produit) }}" class="font-bold text-white hover:text-[#00d4ff] transition-colors truncate block">
                            {{ $ligne->produit->nom }}
                        </a>
                        <p class="text-xs text-[#6b6b9a]">{{ $ligne->produit->categorie->nom }}</p>
                    </div>
                    <div class="text-right flex-shrink-0">
                        <p class="text-xs text-[#6b6b9a]">{{ $ligne->quantity }} × {{ number_format($ligne->produit->prix, 2) }} €</p>
                        <p class="font-black" style="color: #00d4ff;">{{ number_format($ligne->produit->prix * $ligne->quantity, 2) }} €</p>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Total --}}
        <div class="px-6 py-4 flex justify-between items-center border-t" style="border-color: #1e1e3f; background: #1a1a35;">
            <span class="font-black text-white">Total</span>
            <span class="text-2xl font-black" style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                {{ number_format($commande->total(), 2) }} €
            </span>
        </div>
    </div>

    <a href="{{ route('commandes.index') }}" class="flex items-center gap-2 text-sm text-[#6b6b9a] hover:text-[#00d4ff] transition-colors">
        <span class="material-symbols-outlined text-sm">arrow_back</span>
        Retour à mes commandes
    </a>

</div>

@endsection
