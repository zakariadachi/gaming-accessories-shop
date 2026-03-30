<!DOCTYPE html>
<html class="dark" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ $produit->nom }} - GearHub</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#8a2ce2",
                        "background-light": "#f7f6f8",
                        "background-dark": "#191121",
                        "surface": "#2d1b42",
                        "surface-light": "#3d2a56",
                    },
                    fontFamily: { "display": ["Inter", "sans-serif"] },
                    borderRadius: {
                        "DEFAULT": "0.25rem", "lg": "0.5rem",
                        "xl": "0.75rem", "full": "9999px"
                    },
                },
            },
        }
    </script>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 antialiased min-h-screen">

    <!-- Navigation Bar from Home -->
    <header class="sticky top-0 z-50 w-full border-b border-primary/20 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6 lg:px-8">
            <!-- Logo -->
            <div class="flex items-center gap-2">
                <img src="/logo.png" alt="GearHub Logo" class="h-14 w-auto"/>
                <span class="hidden text-xl font-black tracking-tighter sm:block" style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); -webkit-background-clip: text; -webkit-text-fill-color: transparent; filter: drop-shadow(0 0 8px #00d4ff60);">GearHub</span>
            </div>

            <!-- Search Bar -->
            <form method="GET" action="{{ route('produits.index') }}" class="mx-4 flex flex-1 max-w-md">
                <div class="relative w-full">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 dark:text-slate-500">search</span>
                    <input name="search" class="w-full rounded-full border-none bg-slate-200 py-2 pl-10 pr-4 text-sm focus:ring-2 focus:ring-primary dark:bg-surface-light dark:text-slate-100" placeholder="Search gear..." type="text"/>
                </div>
            </form>

            <!-- Actions -->
            <div class="flex items-center gap-2 sm:gap-4">
                <nav class="hidden md:flex items-center gap-6 mr-4">
                    <a class="text-sm font-semibold hover:text-primary transition-colors" href="{{ route('produits.index') }}">Shop</a>
                    <a class="text-sm font-semibold hover:text-primary transition-colors" href="#">Community</a>
                </nav>

                @auth
                    <a href="{{ route('cart.index') }}" class="relative flex h-10 w-10 items-center justify-center rounded-lg bg-slate-200 hover:bg-slate-300 dark:bg-surface-light dark:hover:bg-primary/20 transition-all">
                        <span class="material-symbols-outlined">shopping_cart</span>
                        @php $cartCount = count(session('cart', [])); @endphp
                        @if ($cartCount > 0)
                            <span class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-primary text-[10px] font-bold text-white">{{ $cartCount }}</span>
                        @endif
                    </a>
                    <div class="hidden sm:flex items-center gap-2">
                        <a href="{{ route('profil.edit') }}" class="text-sm font-semibold hover:text-primary transition-colors">{{ Auth::user()->nom }}</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="h-10 items-center justify-center rounded-lg bg-primary px-5 text-sm font-bold text-white shadow-lg shadow-primary/30 hover:brightness-110 flex">Logout</button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('cart.index') }}" class="relative flex h-10 w-10 items-center justify-center rounded-lg bg-slate-200 hover:bg-slate-300 dark:bg-surface-light dark:hover:bg-primary/20 transition-all">
                        <span class="material-symbols-outlined">shopping_cart</span>
                    </a>
                    <a href="{{ route('login') }}" class="hidden h-10 items-center justify-center rounded-lg border border-primary/50 px-5 text-sm font-bold text-primary hover:bg-primary/10 transition-all sm:flex">Login</a>
                    <a href="{{ route('register') }}" class="hidden h-10 items-center justify-center rounded-lg bg-primary px-5 text-sm font-bold text-white shadow-lg shadow-primary/30 hover:brightness-110 transition-all sm:flex">Register</a>
                    <a href="{{ route('login') }}" class="flex h-10 w-10 items-center justify-center rounded-lg bg-slate-200 dark:bg-surface-light sm:hidden">
                        <span class="material-symbols-outlined">person</span>
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <div class="relative flex min-h-screen flex-col pt-20">
    <div class="max-w-6xl mx-auto px-6 py-10">

        {{-- Breadcrumb --}}
        <div class="flex items-center gap-2 text-sm text-slate-400 mb-8">
            <a href="{{ route('produits.index') }}" class="hover:text-primary transition">Produits</a>
            <span>/</span>
            <span class="text-primary">{{ $produit->nom }}</span>
        </div>

        {{-- Détail produit --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            {{-- Image --}}
            <div class="bg-white dark:bg-white/5 border border-slate-200 dark:border-primary/20 rounded-2xl h-96 overflow-hidden flex items-center justify-center">
                @if ($produit->image)
                    <img src="{{ $produit->image }}" alt="{{ $produit->nom }}" class="w-full h-full object-cover"/>
                @else
                    <span class="material-symbols-outlined text-9xl text-primary/30">sports_esports</span>
                @endif
            </div>

            {{-- Infos --}}
            <div class="flex flex-col justify-center space-y-6">
                <div>
                    <span class="text-sm text-primary font-semibold uppercase tracking-wider">{{ $produit->categorie->nom }}</span>
                    <h1 class="text-4xl font-black text-slate-900 dark:text-white mt-2">{{ $produit->nom }}</h1>
                </div>

                <div class="text-4xl font-black text-primary">
                    {{ number_format($produit->prix, 2) }} €
                </div>

                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg {{ $produit->stock > 0 ? 'text-green-400' : 'text-red-400' }}">
                        {{ $produit->stock > 0 ? 'check_circle' : 'cancel' }}
                    </span>
                    <span class="{{ $produit->stock > 0 ? 'text-green-400' : 'text-red-400' }} font-semibold">
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
                    <button disabled class="w-full bg-slate-300 dark:bg-white/10 text-slate-500 dark:text-slate-500 font-bold py-4 rounded-xl cursor-not-allowed">
                        Indisponible
                    </button>
                @endif
            </div>
        </div>

        {{-- Produits similaires --}}
        @if ($similaires->isNotEmpty())
            <div class="mt-16">
                <h2 class="text-2xl font-bold mb-6">Produits similaires</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach ($similaires as $similaire)
                        <a href="{{ route('produits.show', $similaire) }}" class="group bg-white dark:bg-white/5 border border-slate-200 dark:border-primary/20 rounded-2xl overflow-hidden hover:border-primary/60 transition-all">
                            <div class="h-32 bg-primary/10 relative overflow-hidden">
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
    </div>

</body>
</html>
