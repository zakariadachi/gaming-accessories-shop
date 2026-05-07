@extends('layouts.main')

@section('title', 'Boutique - GearHub')

@section('content')

    <div class="flex min-h-screen pt-6">

        <!-- Sidebar -->
        <aside class="h-full w-64 fixed left-0 top-[73px] hidden md:flex flex-col space-y-2 bg-[#0e0e0e] font-body font-medium text-sm border-r border-primary/10 pb-12 overflow-y-auto">
            <div class="px-6 mb-6 pt-6">
                <h3 class="text-primary font-bold uppercase tracking-widest text-xs">Catalogue</h3>
                <p class="text-on-surface-variant text-[10px] uppercase tracking-tighter">Matériel Gaming</p>
            </div>
            <nav class="flex flex-col">
                <a href="{{ route('produits.index') }}"
                   class="{{ !request('categorie') ? 'bg-gradient-to-r from-primary/20 to-transparent text-primary border-l-4 border-primary translate-x-1' : 'text-on-surface-variant hover:bg-surface-container-high hover:translate-x-1' }} py-3 px-6 flex items-center space-x-3 cursor-pointer transition-transform duration-200">
                    <span class="material-symbols-outlined">grid_view</span>
                    <span>Tous les produits</span>
                </a>
                @foreach ($categories as $categorie)
                    <a href="{{ route('produits.index', ['categorie' => $categorie->id]) }}"
                       class="{{ request('categorie') == $categorie->id ? 'bg-gradient-to-r from-primary/20 to-transparent text-primary border-l-4 border-primary translate-x-1' : 'text-on-surface-variant hover:bg-surface-container-high hover:translate-x-1' }} py-3 px-6 flex items-center space-x-3 cursor-pointer transition-transform duration-200">
                        <span class="material-symbols-outlined">
                            @if($categorie->nom === 'Claviers') keyboard
                            @elseif($categorie->nom === 'Souris') mouse
                            @elseif($categorie->nom === 'Casques') headset
                            @elseif($categorie->nom === 'Écrans') monitor
                            @else chair @endif
                        </span>
                        <span>{{ $categorie->nom }}</span>
                    </a>
                @endforeach
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 md:ml-64 px-4 md:px-8 pb-12">

            <header class="mb-8 flex flex-col md:flex-row justify-between items-baseline gap-4">
                <div>
                    <h1 class="font-headline text-3xl md:text-5xl font-extrabold tracking-tighter mb-2">CATALOGUE</h1>
                    <p class="text-on-surface-variant font-body max-w-xl text-sm md:text-base">Découvrez notre sélection de matériel gaming haut de gamme.</p>
                </div>
                <div class="text-right">
                    <span class="text-[10px] font-bold text-primary-dim uppercase tracking-[0.2em]">Stock en direct</span>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="w-2 h-2 rounded-full bg-tertiary shadow-[0_0_8px_#ff8b9a]"></span>
                        <span class="text-xs font-headline font-bold">{{ $produits->total() }} ARTICLES DISPONIBLES</span>
                    </div>
                </div>
            </header>

            <!-- Product Grid -->
            @if ($produits->isEmpty())
                <div class="flex flex-col items-center justify-center py-32 text-on-surface-variant">
                    <span class="material-symbols-outlined text-6xl mb-4">inventory_2</span>
                    <p class="text-lg font-headline">Aucun produit trouvé.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach ($produits as $produit)
                        <div class="group relative bg-surface-container rounded-xl overflow-hidden hover:translate-y-[-4px] transition-all duration-300 flex flex-col">
                            <a href="{{ route('produits.show', $produit) }}">
                                <div class="aspect-square bg-surface-container-high relative overflow-hidden">
                                    @if ($produit->image)
                                        <img src="{{ $produit->image }}" alt="{{ $produit->nom }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"/>
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <span class="material-symbols-outlined text-8xl text-primary/20">sports_esports</span>
                                        </div>
                                    @endif
                                    @if ($produit->stock === 0)
                                        <div class="absolute top-4 left-4 bg-error-container text-on-error-container px-3 py-1 rounded-full text-[10px] font-bold tracking-widest uppercase">Rupture</div>
                                    @else
                                        <div class="absolute top-4 left-4 bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full text-[10px] font-bold tracking-widest uppercase">En stock</div>
                                    @endif
                                </div>
                            </a>
                            <div class="p-6 flex flex-col flex-1">
                                <span class="text-on-surface-variant text-xs font-body mb-1">{{ $produit->categorie->nom }}</span>
                                <a href="{{ route('produits.show', $produit) }}">
                                    <h3 class="font-headline font-bold text-lg leading-tight hover:text-primary transition-colors mb-2">{{ $produit->nom }}</h3>
                                </a>
                                @php $moyenne = $produit->moyenneNotes(); @endphp
                                <div class="flex items-center gap-1 mb-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="material-symbols-outlined text-sm" style="color: {{ $i <= round($moyenne) ? '#ffaa00' : '#484847' }}; font-variation-settings: 'FILL' 1;">star</span>
                                    @endfor
                                    <span class="text-xs text-on-surface-variant ml-1">({{ $produit->reviews()->count() }})</span>
                                </div>
                                <span class="text-primary font-bold font-headline text-lg mb-4">{{ number_format($produit->prix, 2) }} €</span>
                                @if ($produit->stock > 0)
                                    <form action="{{ route('cart.add', $produit) }}" method="POST" class="mt-auto">
                                        @csrf
                                        <button type="submit" class="w-full py-3 bg-gradient-to-r from-primary to-primary-dim text-white font-bold text-xs uppercase tracking-widest rounded-xl hover:opacity-90 active:scale-95 transition-all">
                                            Ajouter au panier
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="mt-auto w-full py-3 bg-surface-container-highest text-on-surface-variant font-bold text-xs uppercase tracking-widest rounded-xl opacity-40 cursor-not-allowed">
                                        Indisponible
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $produits->links() }}
                </div>
            @endif
        </main>
    </div>

@endsection
