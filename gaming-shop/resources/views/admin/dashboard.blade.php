@extends('layouts.admin')

@section('title', 'Dashboard - Admin GearHub')
@section('page-title', 'Dashboard')

@section('content')

    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-8">

        <div class="bg-surface-container rounded-xl p-5 flex flex-col gap-2">
            <span class="material-symbols-outlined text-primary text-2xl">inventory_2</span>
            <p class="text-2xl font-black font-headline">{{ $stats['produits'] }}</p>
            <p class="text-xs text-on-surface-variant uppercase tracking-widest">Produits</p>
        </div>

        <div class="bg-surface-container rounded-xl p-5 flex flex-col gap-2">
            <span class="material-symbols-outlined text-primary text-2xl">category</span>
            <p class="text-2xl font-black font-headline">{{ $stats['categories'] }}</p>
            <p class="text-xs text-on-surface-variant uppercase tracking-widest">Catégories</p>
        </div>

        <div class="bg-surface-container rounded-xl p-5 flex flex-col gap-2">
            <span class="material-symbols-outlined text-primary text-2xl">receipt_long</span>
            <p class="text-2xl font-black font-headline">{{ $stats['commandes'] }}</p>
            <p class="text-xs text-on-surface-variant uppercase tracking-widest">Commandes</p>
        </div>

        <div class="bg-surface-container rounded-xl p-5 flex flex-col gap-2">
            <span class="material-symbols-outlined text-primary text-2xl">group</span>
            <p class="text-2xl font-black font-headline">{{ $stats['utilisateurs'] }}</p>
            <p class="text-xs text-on-surface-variant uppercase tracking-widest">Clients</p>
        </div>

        <div class="bg-surface-container rounded-xl p-5 flex flex-col gap-2">
            <span class="material-symbols-outlined text-yellow-400 text-2xl">warning</span>
            <p class="text-2xl font-black font-headline text-yellow-400">{{ $stats['stock_faible'] }}</p>
            <p class="text-xs text-on-surface-variant uppercase tracking-widest">Stock faible</p>
        </div>

        <div class="bg-surface-container rounded-xl p-5 flex flex-col gap-2">
            <span class="material-symbols-outlined text-error text-2xl">cancel</span>
            <p class="text-2xl font-black font-headline text-error">{{ $stats['rupture'] }}</p>
            <p class="text-xs text-on-surface-variant uppercase tracking-widest">Rupture</p>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Dernières commandes --}}
        <div class="bg-surface-container rounded-xl p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold font-headline text-lg">Dernières commandes</h2>
                <a href="{{ route('admin.commandes.index') }}" class="text-xs text-primary hover:underline">Voir tout</a>
            </div>

            @if($dernieres_commandes->isEmpty())
                <p class="text-on-surface-variant text-sm">Aucune commande.</p>
            @else
                <div class="space-y-3">
                    @foreach($dernieres_commandes as $commande)
                        <div class="flex items-center justify-between py-2 border-b border-white/5 last:border-0">
                            <div>
                                <p class="text-sm font-semibold">{{ $commande->user->nom }}</p>
                                <p class="text-xs text-on-surface-variant">{{ $commande->created_at->format('d/m/Y') }}</p>
                            </div>
                            <span class="text-xs bg-primary/20 text-primary px-3 py-1 rounded-full font-bold">#{{ $commande->id }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Produits stock faible --}}
        <div class="bg-surface-container rounded-xl p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold font-headline text-lg">Stock faible</h2>
                <a href="{{ route('admin.produits.index') }}" class="text-xs text-primary hover:underline">Voir tout</a>
            </div>

            @if($produits_stock_faible->isEmpty())
                <p class="text-on-surface-variant text-sm">Tous les stocks sont OK.</p>
            @else
                <div class="space-y-3">
                    @foreach($produits_stock_faible as $produit)
                        <div class="flex items-center justify-between py-2 border-b border-white/5 last:border-0">
                            <div>
                                <p class="text-sm font-semibold">{{ $produit->nom }}</p>
                                <p class="text-xs text-on-surface-variant">{{ $produit->categorie->nom }}</p>
                            </div>
                            <span class="text-xs font-bold px-3 py-1 rounded-full {{ $produit->stock === 0 ? 'bg-error/20 text-error' : 'bg-yellow-400/20 text-yellow-400' }}">
                                {{ $produit->stock === 0 ? 'Rupture' : $produit->stock . ' restants' }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>

@endsection
