@extends('layouts.main')

@section('title', 'GearHub | Ultimate Gaming Gear')

@section('content')

    <div class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        {{-- ===== HERO ===== --}}
        <section class="relative mb-16 overflow-hidden rounded-2xl p-6 md:p-16"
            style="background: linear-gradient(135deg, #0a0a1a, #0f0f23, #1a1a35); border: 1px solid #00d4ff15;">
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, #00d4ff 1px, transparent 0); background-size: 28px 28px;"></div>
            <div class="relative z-10 flex flex-col-reverse items-center gap-12 lg:flex-row">
                <div class="flex flex-1 flex-col items-center text-center lg:items-start lg:text-left">
                    <span class="mb-4 inline-block rounded-full px-4 py-1 text-xs font-bold uppercase tracking-widest"
                        style="background: #00d4ff15; border: 1px solid #00d4ff30; color: #00d4ff;">Nouvelle Arrivée</span>
                    <h1 class="mb-6 text-4xl font-black leading-tight tracking-tight text-white sm:text-6xl">
                        PLONGEZ DANS <br/>
                        <span style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">LE SON</span>
                    </h1>
                    <p class="mb-8 max-w-md text-lg text-[#6b6b9a]">
                        Découvrez l'audio de qualité professionnelle avec le nouveau casque gaming ZX-700. Latence ultra-faible, 40h de batterie et RGB néon personnalisable.
                    </p>
                    <div class="flex flex-wrap justify-center gap-4 lg:justify-start">
                        <a href="{{ route('produits.index') }}"
                            class="rounded-xl px-8 py-4 text-base font-extrabold text-white hover:scale-105 transition-transform"
                            style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); box-shadow: 0 0 30px #00d4ff30;">
                            ACHETER
                        </a>
                        <a href="#"
                            class="rounded-xl border px-8 py-4 text-base font-extrabold transition-colors hover:bg-[#00d4ff]/10"
                            style="border-color: #00d4ff50; color: #00d4ff;">
                            COMMUNAUTÉ
                        </a>
                    </div>
                </div>
                <div class="flex-1 flex justify-center">
                    <div class="aspect-square w-full max-w-[420px] rounded-2xl p-4"
                        style="background: linear-gradient(135deg, #00d4ff15, #8a2ce215);">
                        <img alt="Professional RGB Gaming Headset"
                            class="h-full w-full object-contain"
                            style="filter: drop-shadow(0 20px 50px rgba(0,212,255,0.3));"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDcFhCKtOmSZhunDBUCOdwXf0K2X8NZ5EgoRrYM_NYKI1KOxQx1-h4ivQ6CLt9-5c2CVKTKH4iIy-BEFCSHJ0khpzXpBrGDvs999xpPpRK9e3JUOmdBU1mjd5FXryHZ9oIXlFcyOU1S4MRlQdSAZTjWphwT2JZmi-hLNLXs_9hwRWrF-5oHrClGaCUt3uBJtu1rqpeYcSd73nBhY_j4JogJP6NkqJljR8GwLGvozzXOR6LM2Eit1G7Pg9mLZ-cTS5KXNX48QgsdaQ"/>
                    </div>
                </div>
            </div>
        </section>

        {{-- ===== CHIFFRES CLÉS ===== --}}
        <section class="mb-16">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach ([
                    ['value' => '50K+',  'label' => 'Clients satisfaits', 'icon' => 'group',          'color' => '#00d4ff'],
                    ['value' => '200+',  'label' => 'Marques partenaires', 'icon' => 'workspace_premium','color' => '#8a2ce2'],
                    ['value' => '18',    'label' => 'Produits disponibles','icon' => 'inventory_2',    'color' => '#00e676'],
                    ['value' => '24/7',  'label' => 'Support client',      'icon' => 'support_agent',  'color' => '#ffaa00'],
                ] as $stat)
                    <div class="rounded-2xl p-6 text-center transition-all hover:translate-y-[-4px]"
                        style="background: #0f0f23; border: 1px solid #1e1e3f;">
                        <span class="material-symbols-outlined text-3xl mb-3 block" style="color: {{ $stat['color'] }};">{{ $stat['icon'] }}</span>
                        <div class="text-3xl font-black mb-1"
                            style="background: linear-gradient(135deg, {{ $stat['color'] }}, #ffffff80); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                            {{ $stat['value'] }}
                        </div>
                        <div class="text-xs text-[#6b6b9a] font-semibold uppercase tracking-wider">{{ $stat['label'] }}</div>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- ===== CATÉGORIES ===== --}}
        <section class="mb-16">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-black text-white">
                    Nos <span style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Catégories</span>
                </h2>
                <a href="{{ route('produits.index') }}" class="text-sm text-[#00d4ff] hover:underline flex items-center gap-1">
                    Voir tout <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
                @foreach ($categories as $categorie)
                    @php
                        $icons = [
                            'Claviers' => ['icon' => 'keyboard',    'color' => '#00d4ff'],
                            'Souris'   => ['icon' => 'mouse',       'color' => '#8a2ce2'],
                            'Casques'  => ['icon' => 'headset',     'color' => '#00e676'],
                            'Écrans'   => ['icon' => 'monitor',     'color' => '#ffaa00'],
                            'Chaises'  => ['icon' => 'chair',       'color' => '#ff3d71'],
                        ];
                        $info = $icons[$categorie->nom] ?? ['icon' => 'category', 'color' => '#00d4ff'];
                    @endphp
                    <a href="{{ route('produits.index', ['categorie' => $categorie->id]) }}"
                        class="group flex flex-col items-center gap-3 rounded-2xl p-6 text-center transition-all hover:translate-y-[-4px]"
                        style="background: #0f0f23; border: 1px solid #1e1e3f;">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center transition-all group-hover:scale-110"
                            style="background: {{ $info['color'] }}15; border: 1px solid {{ $info['color'] }}30;">
                            <span class="material-symbols-outlined text-2xl" style="color: {{ $info['color'] }};">{{ $info['icon'] }}</span>
                        </div>
                        <span class="text-sm font-bold text-white group-hover:text-[#00d4ff] transition-colors">{{ $categorie->nom }}</span>
                    </a>
                @endforeach
            </div>
        </section>

        {{-- ===== PRODUITS VEDETTE ===== --}}
        <section class="mb-16">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-black text-white">
                    Produits <span style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">en vedette</span>
                </h2>
                <a href="{{ route('produits.index') }}" class="text-sm text-[#00d4ff] hover:underline flex items-center gap-1">
                    Voir tout <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($produits as $produit)
                    <div class="group flex flex-col overflow-hidden rounded-2xl transition-all hover:translate-y-[-4px]"
                        style="background: #0f0f23; border: 1px solid #1e1e3f;">
                        <a href="{{ route('produits.show', $produit) }}" class="relative aspect-square overflow-hidden block"
                            style="background: #1a1a35;">
                            @if ($produit->image)
                                <img alt="{{ $produit->nom }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" src="{{ $produit->image }}"/>
                            @else
                                <div class="h-full w-full flex items-center justify-center">
                                    <span class="material-symbols-outlined text-6xl" style="color: #1e1e3f;">sports_esports</span>
                                </div>
                            @endif
                            @if ($produit->stock === 0)
                                <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-[10px] font-bold uppercase"
                                    style="background: #ff3d7120; border: 1px solid #ff3d7150; color: #ff3d71;">Rupture</span>
                            @else
                                <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-[10px] font-bold uppercase"
                                    style="background: #00e67620; border: 1px solid #00e67650; color: #00e676;">En stock</span>
                            @endif
                        </a>
                        <div class="flex flex-1 flex-col p-4">
                            <span class="text-[10px] font-bold uppercase tracking-wider mb-1" style="color: #00d4ff;">{{ $produit->categorie->nom }}</span>
                            <a href="{{ route('produits.show', $produit) }}">
                                <h3 class="font-bold text-white mb-2 hover:text-[#00d4ff] transition-colors">{{ $produit->nom }}</h3>
                            </a>
                            @php $moyenne = $produit->moyenneNotes(); @endphp
                            <div class="flex items-center gap-1 mb-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="material-symbols-outlined text-sm" style="color: {{ $i <= round($moyenne) ? '#ffaa00' : '#1e1e3f' }}; font-variation-settings: 'FILL' 1;">star</span>
                                @endfor
                                <span class="text-xs ml-1" style="color: #6b6b9a;">({{ $produit->reviews()->count() }})</span>
                            </div>
                            <span class="font-black text-lg mb-4"
                                style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                                {{ number_format($produit->prix, 2) }} €
                            </span>
                            @if ($produit->stock > 0)
                                <form action="{{ route('cart.add', $produit->id) }}" method="POST" class="mt-auto">
                                    @csrf
                                    <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl py-3 text-sm font-bold text-white transition-all active:scale-95 hover:opacity-90"
                                        style="background: linear-gradient(135deg, #00d4ff, #8a2ce2);">
                                        <span class="material-symbols-outlined text-sm">add_shopping_cart</span>
                                        AJOUTER AU PANIER
                                    </button>
                                </form>
                            @else
                                <button disabled class="mt-auto w-full rounded-xl py-3 text-sm font-bold cursor-not-allowed"
                                    style="background: #1a1a35; color: #6b6b9a;">
                                    INDISPONIBLE
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- ===== POURQUOI GEARHUB ===== --}}
        <section class="mb-16">
            <h2 class="text-2xl font-black text-center text-white mb-8">
                Pourquoi choisir <span style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">GearHub ?</span>
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ([
                    ['icon' => 'local_shipping',   'title' => 'Livraison rapide',    'desc' => 'Livraison en 24-48h. Suivi en temps réel.',              'color' => '#00d4ff'],
                    ['icon' => 'verified_user',    'title' => 'Garantie 2 ans',      'desc' => 'Tous nos produits garantis. Retour gratuit 30 jours.',   'color' => '#00e676'],
                    ['icon' => 'support_agent',    'title' => 'Support 24/7',        'desc' => 'Notre équipe disponible 7j/7 pour vous aider.',          'color' => '#8a2ce2'],
                    ['icon' => 'workspace_premium','title' => 'Produits certifiés',  'desc' => 'Uniquement des produits officiels et certifiés.',        'color' => '#ffaa00'],
                ] as $item)
                    <div class="rounded-2xl p-6 text-center transition-all hover:translate-y-[-4px]"
                        style="background: #0f0f23; border: 1px solid #1e1e3f;">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4"
                            style="background: {{ $item['color'] }}15; border: 1px solid {{ $item['color'] }}30;">
                            <span class="material-symbols-outlined text-2xl" style="color: {{ $item['color'] }};">{{ $item['icon'] }}</span>
                        </div>
                        <h3 class="font-black text-white mb-2">{{ $item['title'] }}</h3>
                        <p class="text-xs text-[#6b6b9a] leading-relaxed">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </section>

    </div>

    {{-- ===== NEWSLETTER ===== --}}
    <section class="py-16" style="background: linear-gradient(135deg, #0f0f23, #1a1a35); border-top: 1px solid #1e1e3f;">
        <div class="mx-auto max-w-2xl px-4 text-center">
            <h2 class="text-3xl font-black text-white mb-3">REJOIGNEZ LE <span style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">CENTRE DE COMMANDE</span></h2>
            <p class="text-[#6b6b9a] mb-8">Accédez en avant-première aux nouveautés, aux remises exclusives et aux conseils de la communauté.</p>
            <form class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                <input class="flex-1 rounded-xl px-4 py-3 text-sm text-white placeholder:text-[#6b6b9a] outline-none focus:ring-2"
                    style="background: #050510; border: 1px solid #1e1e3f;"
                    placeholder="Votre email" type="email"/>
                <button class="rounded-xl px-8 py-3 font-bold text-white transition-all hover:scale-105"
                    style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); box-shadow: 0 0 20px #00d4ff20;">
                    S'INSCRIRE
                </button>
            </form>
        </div>
    </section>

@endsection
