<!DOCTYPE html>
<html class="dark" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
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
    <title>GameGear | Ultimate Gaming Accessories</title>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 antialiased">
<div class="relative flex min-h-screen flex-col overflow-x-hidden">

    <!-- Navigation Bar -->
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

    <main class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

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
                <div class="group flex flex-col overflow-hidden rounded-xl bg-white p-4 shadow-sm transition-all hover:shadow-xl dark:bg-surface">
                    <a href="{{ route('produits.show', $produit) }}" class="relative mb-4 aspect-square overflow-hidden rounded-lg bg-slate-100 dark:bg-background-dark block">
                        @if ($produit->image)
                            <img alt="{{ $produit->nom }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" src="{{ $produit->image }}"/>
                        @else
                            <div class="h-full w-full flex items-center justify-center">
                                <span class="material-symbols-outlined text-6xl text-primary/30">sports_esports</span>
                            </div>
                        @endif
                        @if ($produit->stock === 0)
                            <span class="absolute right-2 top-2 rounded-md bg-red-600 px-2 py-1 text-[10px] font-bold text-white">RUPTURE</span>
                        @else
                            <span class="absolute right-2 top-2 rounded-md bg-background-dark/80 px-2 py-1 text-[10px] font-bold text-primary backdrop-blur-sm">IN STOCK</span>
                        @endif
                    </a>
                    <div class="flex flex-1 flex-col">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-primary">{{ $produit->categorie->nom }}</span>
                        <h3 class="mb-1 text-lg font-bold text-slate-900 dark:text-slate-100">{{ $produit->nom }}</h3>
                        <p class="mb-4 text-xl font-black text-slate-900 dark:text-slate-100">{{ number_format($produit->prix, 2) }} €</p>
                        @if ($produit->stock > 0)
                            <form action="{{ route('cart.add', $produit->id) }}" method="POST" class="mt-auto">
                                @csrf
                                <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-lg bg-primary py-3 text-sm font-bold text-white shadow-lg shadow-primary/20 hover:brightness-110 transition-all active:scale-95">
                                    <span class="material-symbols-outlined text-sm">add_shopping_cart</span>
                                    ADD TO CART
                                </button>
                            </form>
                        @else
                            <button disabled class="mt-auto flex w-full items-center justify-center gap-2 rounded-lg bg-slate-400 py-3 text-sm font-bold text-white cursor-not-allowed">
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
    </main>

    <!-- Newsletter Section -->
    <section class="mt-12 bg-surface-light py-12">
        <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <h2 class="mb-4 text-3xl font-black text-slate-100">JOIN THE COMMAND CENTER</h2>
            <p class="mb-8 text-slate-300">Get early access to drops, exclusive discounts, and pro-tips from the community.</p>
            <form class="mx-auto flex max-w-lg flex-col gap-3 sm:flex-row">
                <input class="flex-1 rounded-lg border-none bg-background-dark px-4 py-3 text-slate-100 focus:ring-2 focus:ring-primary" placeholder="Your battle-station email" type="email"/>
                <button class="rounded-lg bg-primary px-8 py-3 font-bold text-white transition-all hover:brightness-110">ENLIST NOW</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="mt-auto border-t border-primary/10 bg-background-dark py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col items-center justify-between gap-8 md:flex-row">
                <div class="flex items-center gap-2">
                    <img src="/logo.png" alt="GameGear Logo" class="h-8 w-auto"/>
                </div>
                <div class="flex gap-8 text-sm font-medium text-slate-400">
                    <a class="hover:text-primary transition-colors" href="#">Support</a>
                    <a class="hover:text-primary transition-colors" href="#">Privacy</a>
                    <a class="hover:text-primary transition-colors" href="#">Terms</a>
                    <a class="hover:text-primary transition-colors" href="#">Affiliates</a>
                </div>
                <div class="flex gap-4">
                    <a class="flex h-10 w-10 items-center justify-center rounded-full bg-surface-light text-slate-300 hover:text-primary" href="#"><span class="material-symbols-outlined">public</span></a>
                    <a class="flex h-10 w-10 items-center justify-center rounded-full bg-surface-light text-slate-300 hover:text-primary" href="#"><span class="material-symbols-outlined">share</span></a>
                </div>
            </div>
            <div class="mt-12 border-t border-slate-800 pt-8 text-center text-xs text-slate-500">
                © 2024 GameGear Accessories. All rights reserved. Level up your setup.
            </div>
        </div>
    </footer>

</div>
</body>
</html>
