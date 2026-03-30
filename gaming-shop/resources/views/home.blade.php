@extends('layouts.main')

@section('title', 'GearHub | Ultimate Gaming Gear')

@section('content')

    <div class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        <!-- Hero Section -->
        <section class="relative mb-12 overflow-hidden rounded-xl bg-gradient-to-br from-surface to-background-dark p-8 md:p-16">
            <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, #8a2ce2 1px, transparent 0); background-size: 24px 24px;"></div>
            <div class="relative z-10 flex flex-col-reverse items-center gap-12 lg:flex-row">
                <div class="flex flex-1 flex-col items-center text-center lg:items-start lg:text-left">
                    <span class="mb-4 inline-block rounded-full bg-primary/20 px-4 py-1 text-xs font-bold uppercase tracking-widest text-primary">New Arrival</span>
                    <h1 class="mb-6 text-4xl font-black leading-tight tracking-tight text-slate-100 sm:text-6xl">
                        IMMERSE IN <br/><span class="text-primary">THE SOUND</span>
                    </h1>
                    <p class="mb-8 max-w-md text-lg text-slate-400">
                        Experience professional-grade audio with the new ZX-700 Wireless Gaming Headset. Ultra-low latency, 40h battery, and customizable neon RGB.
                    </p>
                    <div class="flex flex-wrap justify-center gap-4 lg:justify-start">
                        <a href="{{ route('produits.index') }}" class="rounded-lg bg-primary px-8 py-4 text-base font-extrabold text-white shadow-xl shadow-primary/40 hover:scale-105 transition-transform">
                            SHOP NOW
                        </a>
                        <a href="{{ route('produits.index', ['categorie' => 3]) }}" class="rounded-lg border border-primary/50 bg-transparent px-8 py-4 text-base font-extrabold text-primary hover:bg-primary/10 transition-colors">
                            VIEW SPECS
                        </a>
                    </div>
                </div>
                <div class="flex-1">
                    <div class="aspect-square w-full max-w-[500px] rounded-2xl bg-gradient-to-tr from-primary/30 to-transparent p-4">
                        <img alt="Professional RGB Gaming Headset" class="h-full w-full object-contain drop-shadow-[0_20px_50px_rgba(138,44,226,0.5)]" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDcFhCKtOmSZhunDBUCOdwXf0K2X8NZ5EgoRrYM_NYKI1KOxQx1-h4ivQ6CLt9-5c2CVKTKH4iIy-BEFCSHJ0khpzXpBrGDvs999xpPpRK9e3JUOmdBU1mjd5FXryHZ9oIXlFcyOU1S4MRlQdSAZTjWphwT2JZmi-hLNLXs_9hwRWrF-5oHrClGaCUt3uBJtu1rqpeYcSd73nBhY_j4JogJP6NkqJljR8GwLGvozzXOR6LM2Eit1G7Pg9mLZ-cTS5KXNX48QgsdaQ"/>
                    </div>
                </div>
            </div>
        </section>

        <!-- Product Grid -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($produits as $produit)
                <div class="group flex flex-col overflow-hidden rounded-xl bg-surface-container p-4 transition-all hover:translate-y-[-4px] hover:shadow-xl">
                    <a href="{{ route('produits.show', $produit) }}" class="relative mb-4 aspect-square overflow-hidden rounded-lg bg-surface-container-high block">
                        @if ($produit->image)
                            <img alt="{{ $produit->nom }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" src="{{ $produit->image }}"/>
                        @else
                            <div class="h-full w-full flex items-center justify-center">
                                <span class="material-symbols-outlined text-6xl text-primary/30">sports_esports</span>
                            </div>
                        @endif
                        @if ($produit->stock === 0)
                            <span class="absolute top-2 left-2 bg-error-container text-on-error-container px-3 py-1 rounded-full text-[10px] font-bold tracking-widest uppercase">Rupture</span>
                        @else
                            <span class="absolute top-2 left-2 bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full text-[10px] font-bold tracking-widest uppercase">In Stock</span>
                        @endif
                    </a>
                    <div class="flex flex-1 flex-col">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-primary">{{ $produit->categorie->nom }}</span>
                        <h3 class="mb-1 text-lg font-bold">{{ $produit->nom }}</h3>
                        <p class="mb-4 text-xl font-black text-primary">{{ number_format($produit->prix, 2) }} €</p>
                        @if ($produit->stock > 0)
                            <form action="{{ route('cart.add', $produit->id) }}" method="POST" class="mt-auto">
                                @csrf
                                <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-lg bg-primary py-3 text-sm font-bold text-white shadow-lg shadow-primary/20 hover:brightness-110 transition-all active:scale-95">
                                    <span class="material-symbols-outlined text-sm">add_shopping_cart</span>
                                    ADD TO CART
                                </button>
                            </form>
                        @else
                            <button disabled class="mt-auto flex w-full items-center justify-center gap-2 rounded-lg bg-surface-container-highest py-3 text-sm font-bold text-on-surface-variant cursor-not-allowed">
                                INDISPONIBLE
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('produits.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-primary/50 px-8 py-3 text-sm font-bold text-primary hover:bg-primary hover:text-white transition-all">
                <span>Voir tous les produits</span>
                <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>
    </div>

    <!-- Newsletter Section -->
    <section class="mt-12 bg-surface py-12">
        <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <h2 class="mb-4 text-3xl font-black">JOIN THE COMMAND CENTER</h2>
            <p class="mb-8 text-on-surface-variant">Get early access to drops, exclusive discounts, and pro-tips from the community.</p>
            <form class="mx-auto flex max-w-lg flex-col gap-3 sm:flex-row">
                <input class="flex-1 rounded-lg border-none bg-surface-container px-4 py-3 text-slate-100 focus:ring-2 focus:ring-primary" placeholder="Your battle-station email" type="email"/>
                <button class="rounded-lg bg-primary px-8 py-3 font-bold text-white transition-all hover:brightness-110">ENLIST NOW</button>
            </form>
        </div>
    </section>

@endsection
