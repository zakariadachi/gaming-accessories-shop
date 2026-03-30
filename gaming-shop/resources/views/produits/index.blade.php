<!DOCTYPE html>
<html class="dark" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>NEON KINETIC | Precision Gaming Gear</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Manrope:wght@400;500;600;700&family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
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
                        "secondary-fixed-dim": "#e9aeff",
                        "inverse-primary": "#8523dd",
                        "inverse-surface": "#fcf9f8",
                        "secondary-fixed": "#f0c1ff",
                        "on-surface": "#ffffff",
                        "outline-variant": "#484847",
                        "on-primary-fixed": "#000000",
                        "on-secondary": "#520c70",
                        "on-error": "#490013",
                        "outline": "#767575",
                        "surface-container-low": "#131313",
                        "error-container": "#a70138",
                        "inverse-on-surface": "#565555",
                        "surface-container": "#1a1a1a",
                        "surface-bright": "#2c2c2c",
                        "secondary": "#e097fd",
                        "on-surface-variant": "#adaaaa",
                        "error": "#ff6e84",
                        "on-secondary-container": "#efc0ff",
                        "secondary-dim": "#d18aee",
                        "surface-container-highest": "#262626",
                        "surface-container-lowest": "#000000",
                        "tertiary-fixed-dim": "#fa7c8d",
                        "primary-container": "#c185ff",
                        "on-background": "#ffffff",
                        "on-primary-fixed-variant": "#420078",
                        "on-tertiary": "#62041f",
                        "on-primary-container": "#350062",
                        "surface-tint": "#ca98ff",
                        "on-error-container": "#ffb2b9",
                        "secondary-container": "#692886",
                        "on-secondary-fixed": "#540f72",
                        "surface-variant": "#262626",
                        "on-tertiary-container": "#4d0015",
                        "surface-dim": "#0e0e0e",
                        "on-primary": "#46007d",
                        "primary-fixed-dim": "#b772ff",
                        "tertiary-container": "#f7798b",
                        "tertiary-dim": "#f47788",
                        "on-tertiary-fixed-variant": "#711229",
                        "error-dim": "#d73357",
                        "tertiary-fixed": "#ff909e",
                        "primary-dim": "#9c42f4",
                        "tertiary": "#ff8b9a",
                        "surface-container-high": "#20201f",
                        "on-secondary-fixed-variant": "#743391",
                        "primary-fixed": "#c185ff",
                        "background": "#0e0e0e"
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"],
                        "headline": ["Plus Jakarta Sans"],
                        "body": ["Manrope"],
                        "label": ["Manrope"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem", "lg": "0.5rem",
                        "xl": "0.75rem", "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block; line-height: 1; text-transform: none;
            letter-spacing: normal; word-wrap: normal; white-space: nowrap; direction: ltr;
        }
        body { background-color: #0e0e0e; color: #ffffff; font-family: 'Manrope', sans-serif; }
    </style>
</head>
<body class="selection:bg-primary selection:text-on-primary">

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
                    <input name="search" class="w-full rounded-full border-none bg-slate-200 py-2 pl-10 pr-4 text-sm focus:ring-2 focus:ring-primary dark:bg-surface-light dark:text-slate-100" placeholder="Search gear..." type="text" value="{{ request('search') }}"/>
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

    <div class="flex min-h-screen pt-24">

        <!-- SideNavBar -->
        <aside class="h-full w-64 fixed left-0 top-0 pt-24 hidden md:flex flex-col space-y-2 bg-[#0e0e0e] font-['Manrope'] font-medium text-sm">
            <div class="px-6 mb-6">
                <h3 class="text-[#ca98ff] font-bold uppercase tracking-widest text-xs">Catalog</h3>
                <p class="text-on-surface-variant text-[10px] uppercase tracking-tighter">Precision Gear</p>
            </div>
            <nav class="flex flex-col">
                <a href="{{ route('produits.index') }}"
                   class="{{ !request('categorie') ? 'bg-gradient-to-r from-[#ca98ff]/20 to-transparent text-[#ca98ff] border-l-4 border-[#ca98ff] translate-x-1' : 'text-[#adaaaa] hover:bg-[#20201f] hover:translate-x-1' }} py-3 px-6 flex items-center space-x-3 cursor-pointer active:opacity-80 transition-transform duration-200">
                    <span class="material-symbols-outlined" style="{{ !request('categorie') ? 'font-variation-settings: FILL 1;' : '' }}">grid_view</span>
                    <span>All Products</span>
                </a>
                @foreach ($categories as $categorie)
                    <a href="{{ route('produits.index', ['categorie' => $categorie->id]) }}"
                       class="{{ request('categorie') == $categorie->id ? 'bg-gradient-to-r from-[#ca98ff]/20 to-transparent text-[#ca98ff] border-l-4 border-[#ca98ff] translate-x-1' : 'text-[#adaaaa] hover:bg-[#20201f] hover:translate-x-1' }} py-3 px-6 flex items-center space-x-3 cursor-pointer active:opacity-80 transition-transform duration-200">
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
        <main class="flex-1 md:ml-64 px-8 pb-12">

            <!-- Editorial Header -->
            <header class="mb-12 flex flex-col md:flex-row justify-between items-baseline gap-4">
                <div>
                    <h1 class="font-headline text-5xl font-extrabold tracking-tighter mb-2">ULTIMATE CATALOG</h1>
                    <p class="text-on-surface-variant font-body max-w-xl">Harness the kinetic power of pro-grade peripherals. Engineered for zero-latency dominance.</p>
                </div>
                <div class="text-right">
                    <span class="text-[10px] font-bold text-primary-dim uppercase tracking-[0.2em]">Live Inventory</span>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="w-2 h-2 rounded-full bg-tertiary shadow-[0_0_8px_#ff8b9a]"></span>
                        <span class="text-xs font-headline font-bold">{{ $produits->total() }} ITEMS READY TO SHIP</span>
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
                        <div class="group relative bg-surface-container rounded-xl overflow-hidden hover:translate-y-[-4px] transition-all duration-300">
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
                                        <div class="absolute top-4 left-4 bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full text-[10px] font-bold tracking-widest uppercase">In Stock</div>
                                    @endif
                                </div>
                            </a>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-2">
                                    <a href="{{ route('produits.show', $produit) }}">
                                        <h3 class="font-headline font-bold text-lg leading-tight hover:text-primary transition-colors">{{ $produit->nom }}</h3>
                                    </a>
                                    <span class="text-primary text-xs font-bold font-headline whitespace-nowrap ml-2">{{ number_format($produit->prix, 2) }} €</span>
                                </div>
                                <p class="text-on-surface-variant text-xs mb-6 font-body">{{ $produit->categorie->nom }}</p>
                                <button class="w-full py-3 bg-gradient-to-r from-primary to-primary-dim text-on-primary font-bold text-xs uppercase tracking-widest rounded-xl hover:opacity-90 active:scale-95 transition-all {{ $produit->stock === 0 ? 'opacity-40 cursor-not-allowed' : '' }}" {{ $produit->stock === 0 ? 'disabled' : '' }}>
                                    {{ $produit->stock === 0 ? 'Indisponible' : 'Add to Cart' }}
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $produits->withQueryString()->links() }}
                </div>
            @endif
        </main>
    </div>

    <!-- Footer -->
    <footer class="w-full border-t border-[#484847]/15 mt-20 bg-[#0e0e0e] font-['Manrope'] text-xs uppercase tracking-widest">
        <div class="w-full px-8 py-12 flex flex-col md:flex-row justify-between items-center max-w-screen-2xl mx-auto">
            <div class="text-[#adaaaa] mb-6 md:mb-0 flex items-center gap-2">
                    <img src="/logo.png" alt="GearHub Logo" class="h-8 w-auto"/>
                    <span style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">GearHub</span>
                </div>
            <div class="flex space-x-8">
                <a class="text-[#adaaaa] hover:text-[#ca98ff] transition-colors" href="#">Privacy Policy</a>
                <a class="text-[#adaaaa] hover:text-[#ca98ff] transition-colors" href="#">Terms of Service</a>
                <a class="text-[#adaaaa] hover:text-[#ca98ff] transition-colors" href="#">Shipping</a>
                <a class="text-[#adaaaa] hover:text-[#ca98ff] transition-colors" href="#">Returns</a>
            </div>
        </div>
    </footer>

</body>
</html>
