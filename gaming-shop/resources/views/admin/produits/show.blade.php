@extends('layouts.admin')

@section('title', $produit->nom . ' - Admin')
@section('page-title', 'Détail Produit')

@section('content')

    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.produits.index') }}" class="flex items-center gap-2 text-sm text-on-surface-variant hover:text-white transition-colors">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            Retour à la liste
        </a>
        <a href="{{ route('admin.produits.edit', $produit) }}" class="flex items-center gap-2 bg-primary hover:brightness-110 text-white text-sm font-bold px-5 py-2.5 rounded-xl transition-all">
            <span class="material-symbols-outlined text-sm">edit</span>
            Modifier
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Colonne principale --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Infos produit --}}
            <div class="bg-surface-container rounded-2xl overflow-hidden border border-white/5">
                <div class="flex flex-col sm:flex-row gap-6 p-6">
                    {{-- Image --}}
                    <div class="w-full sm:w-48 h-48 rounded-xl overflow-hidden flex-shrink-0 bg-surface-container-high flex items-center justify-center border border-white/5">
                        @if($produit->image)
                            <img src="{{ $produit->image }}" alt="{{ $produit->nom }}" class="w-full h-full object-cover"/>
                        @else
                            <span class="material-symbols-outlined text-5xl text-primary/30">sports_esports</span>
                        @endif
                    </div>
                    {{-- Détails --}}
                    <div class="flex-1 space-y-4">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-widest text-primary">{{ $produit->categorie->nom }}</span>
                            <h2 class="text-2xl font-black font-headline mt-1">{{ $produit->nom }}</h2>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-surface-container-high rounded-xl p-4">
                                <p class="text-xs text-on-surface-variant uppercase tracking-widest mb-1">Prix</p>
                                <p class="text-2xl font-black text-primary">{{ number_format($produit->prix, 2) }} €</p>
                            </div>
                            <div class="bg-surface-container-high rounded-xl p-4">
                                <p class="text-xs text-on-surface-variant uppercase tracking-widest mb-1">Stock</p>
                                <p class="text-2xl font-black {{ $produit->stock === 0 ? 'text-error' : ($produit->stock <= 5 ? 'text-yellow-400' : 'text-green-400') }}">
                                    {{ $produit->stock }}
                                </p>
                            </div>
                            <div class="bg-surface-container-high rounded-xl p-4">
                                <p class="text-xs text-on-surface-variant uppercase tracking-widest mb-1">Note moyenne</p>
                                <div class="flex items-center gap-2">
                                    <p class="text-2xl font-black text-yellow-400">{{ number_format($produit->moyenneNotes(), 1) }}</p>
                                    <span class="material-symbols-outlined text-yellow-400" style="font-variation-settings: 'FILL' 1;">star</span>
                                </div>
                            </div>
                            <div class="bg-surface-container-high rounded-xl p-4">
                                <p class="text-xs text-on-surface-variant uppercase tracking-widest mb-1">Avis</p>
                                <p class="text-2xl font-black">{{ $produit->reviews->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Avis clients --}}
            <div class="bg-surface-container rounded-2xl border border-white/5 overflow-hidden">
                <div class="px-6 py-4 border-b border-white/5 flex items-center justify-between">
                    <h3 class="font-bold font-headline">Avis clients</h3>
                    <span class="text-xs text-on-surface-variant">{{ $produit->reviews->count() }} avis</span>
                </div>

                @if($produit->reviews->isEmpty())
                    <div class="flex flex-col items-center justify-center py-12 text-on-surface-variant">
                        <span class="material-symbols-outlined text-4xl mb-2">rate_review</span>
                        <p class="text-sm">Aucun avis pour ce produit.</p>
                    </div>
                @else
                    <div class="divide-y divide-white/5">
                        @foreach($produit->reviews as $review)
                            <div class="flex items-start justify-between px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-black text-white flex-shrink-0"
                                        style="background: linear-gradient(135deg, #00d4ff, #8a2ce2);">
                                        {{ strtoupper(substr($review->user->nom, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold">{{ $review->user->nom }}</p>
                                        <p class="text-xs text-on-surface-variant">{{ $review->created_at->format('d/m/Y') }}</p>
                                        <p class="text-sm text-on-surface-variant mt-1">{{ $review->commentaire }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-1 flex-shrink-0 ml-4">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="material-symbols-outlined text-sm" style="color: {{ $i <= $review->note ? '#ffaa00' : '#484847' }}; font-variation-settings: 'FILL' 1;">star</span>
                                    @endfor
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>

        {{-- Colonne latérale --}}
        <div class="space-y-6">

            {{-- Statut stock --}}
            <div class="bg-surface-container rounded-2xl p-6 border border-white/5">
                <h3 class="font-bold font-headline mb-4">Statut</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-on-surface-variant">Statut stock</span>
                        <span class="font-bold px-3 py-1 rounded-full text-xs {{ $produit->stock === 0 ? 'bg-error/20 text-error' : ($produit->stock <= 5 ? 'bg-yellow-400/20 text-yellow-400' : 'bg-green-500/20 text-green-400') }}">
                            {{ $produit->stock === 0 ? 'Rupture' : ($produit->stock <= 5 ? 'Stock faible' : 'En stock') }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-on-surface-variant">Créé le</span>
                        <span class="font-bold">{{ $produit->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-on-surface-variant">Modifié le</span>
                        <span class="font-bold">{{ $produit->updated_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>

            {{-- Actions rapides --}}
            <div class="bg-surface-container rounded-2xl p-6 border border-white/5">
                <h3 class="font-bold font-headline mb-4">Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.produits.edit', $produit) }}" class="w-full flex items-center justify-center gap-2 py-3 rounded-xl bg-primary/10 text-primary hover:bg-primary/20 text-sm font-bold transition-all">
                        <span class="material-symbols-outlined text-sm">edit</span>
                        Modifier le produit
                    </a>
                    <form action="{{ route('admin.produits.destroy', $produit) }}" method="POST" onsubmit="return confirm('Supprimer ce produit ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full flex items-center justify-center gap-2 py-3 rounded-xl bg-error/10 text-error hover:bg-error/20 text-sm font-bold transition-all">
                            <span class="material-symbols-outlined text-sm">delete</span>
                            Supprimer le produit
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection
