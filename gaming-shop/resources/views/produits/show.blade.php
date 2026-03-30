@extends('layouts.main')

@section('title', $produit->nom . ' - GearHub')

@section('content')

    <div class="max-w-6xl mx-auto px-6 py-10">

        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-on-surface-variant mb-8">
            <a href="{{ route('produits.index') }}" class="hover:text-primary transition">Produits</a>
            <span>/</span>
            <span class="text-primary">{{ $produit->nom }}</span>
        </div>

        <!-- Product Detail -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            <!-- Image -->
            <div class="bg-surface-container border border-primary/20 rounded-2xl h-96 overflow-hidden flex items-center justify-center">
                @if ($produit->image)
                    <img src="{{ $produit->image }}" alt="{{ $produit->nom }}" class="w-full h-full object-cover"/>
                @else
                    <span class="material-symbols-outlined text-9xl text-primary/30">sports_esports</span>
                @endif
            </div>

            <!-- Info -->
            <div class="flex flex-col justify-center space-y-6">
                <div>
                    <span class="text-sm text-primary font-semibold uppercase tracking-wider">{{ $produit->categorie->nom }}</span>
                    <h1 class="text-4xl font-black font-headline mt-2">{{ $produit->nom }}</h1>
                </div>

                <div class="text-4xl font-black text-primary">
                    {{ number_format($produit->prix, 2) }} €
                </div>

                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg {{ $produit->stock > 0 ? 'text-green-400' : 'text-error' }}">
                        {{ $produit->stock > 0 ? 'check_circle' : 'cancel' }}
                    </span>
                    <span class="{{ $produit->stock > 0 ? 'text-green-400' : 'text-error' }} font-semibold">
                        {{ $produit->stock > 0 ? $produit->stock . ' en stock' : 'Rupture de stock' }}
                    </span>
                </div>

                @if ($produit->stock > 0)
                    <form action="{{ route('cart.add', $produit) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-4 rounded-xl shadow-lg shadow-primary/20 flex items-center justify-center gap-2 transition-transform active:scale-[0.98]">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            <span>Ajouter au panier</span>
                        </button>
                    </form>
                @else
                    <button disabled class="w-full bg-surface-container-highest text-on-surface-variant font-bold py-4 rounded-xl cursor-not-allowed">
                        Indisponible
                    </button>
                @endif
            </div>
        </div>

        <!-- Similar Products -->
        @if ($similaires->isNotEmpty())
            <div class="mt-16">
                <h2 class="text-2xl font-bold font-headline mb-6">Produits similaires</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach ($similaires as $similaire)
                        <a href="{{ route('produits.show', $similaire) }}" class="group bg-surface-container border border-primary/20 rounded-2xl overflow-hidden hover:border-primary/60 transition-all">
                            <div class="h-32 bg-surface-container-high relative overflow-hidden">
                                @if ($similaire->image)
                                    <img src="{{ $similaire->image }}" alt="{{ $similaire->nom }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"/>
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <span class="material-symbols-outlined text-4xl text-primary/40">sports_esports</span>
                                    </div>
                                @endif
                            </div>
                            <div class="p-3">
                                <h3 class="font-semibold text-sm group-hover:text-primary transition-colors truncate">{{ $similaire->nom }}</h3>
                                <span class="text-primary font-bold text-sm">{{ number_format($similaire->prix, 2) }} €</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>

@endsection
