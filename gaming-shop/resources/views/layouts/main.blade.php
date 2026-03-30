<!DOCTYPE html>
<html class="dark" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'GearHub | Ultimate Gaming Gear')</title>
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
                        "primary-dim": "#9c42f4",
                        "primary-fixed": "#c185ff",
                        "primary-fixed-dim": "#b772ff",
                        "primary-container": "#c185ff",
                        "on-primary": "#46007d",
                        "on-primary-fixed": "#000000",
                        "on-primary-fixed-variant": "#420078",
                        "on-primary-container": "#350062",
                        "background": "#0e0e0e",
                        "background-light": "#f7f6f8",
                        "background-dark": "#191121",
                        "on-background": "#ffffff",
                        "surface": "#2d1b42",
                        "surface-light": "#3d2a56",
                        "surface-dim": "#0e0e0e",
                        "surface-bright": "#2c2c2c",
                        "surface-variant": "#262626",
                        "surface-tint": "#ca98ff",
                        "surface-container": "#1a1a1a",
                        "surface-container-low": "#131313",
                        "surface-container-high": "#20201f",
                        "surface-container-highest": "#262626",
                        "surface-container-lowest": "#000000",
                        "on-surface": "#ffffff",
                        "on-surface-variant": "#adaaaa",
                        "secondary": "#e097fd",
                        "secondary-dim": "#d18aee",
                        "secondary-fixed": "#f0c1ff",
                        "secondary-fixed-dim": "#e9aeff",
                        "secondary-container": "#692886",
                        "on-secondary": "#520c70",
                        "on-secondary-fixed": "#540f72",
                        "on-secondary-fixed-variant": "#743391",
                        "on-secondary-container": "#efc0ff",
                        "tertiary": "#ff8b9a",
                        "tertiary-dim": "#f47788",
                        "tertiary-fixed": "#ff909e",
                        "tertiary-fixed-dim": "#fa7c8d",
                        "tertiary-container": "#f7798b",
                        "on-tertiary": "#62041f",
                        "on-tertiary-fixed-variant": "#711229",
                        "on-tertiary-container": "#4d0015",
                        "outline": "#767575",
                        "outline-variant": "#484847",
                        "error": "#ff6e84",
                        "error-dim": "#d73357",
                        "error-container": "#a70138",
                        "on-error": "#490013",
                        "on-error-container": "#ffb2b9",
                        "inverse-primary": "#8523dd",
                        "inverse-surface": "#fcf9f8",
                        "inverse-on-surface": "#565555",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"],
                        "headline": ["Plus Jakarta Sans"],
                        "body": ["Manrope"],
                        "label": ["Manrope"],
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
    @stack('styles')
</head>
<body class="selection:bg-primary selection:text-on-primary min-h-screen flex flex-col">

    <!-- Navbar -->
    <header class="sticky top-0 z-50 w-full border-b border-primary/20 bg-[#0e0e0e]/80 backdrop-blur-md">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6 lg:px-8">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <img src="/logo.png" alt="GearHub Logo" class="h-14 w-auto"/>
                <span class="hidden text-xl font-black tracking-tighter sm:block" style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; filter: drop-shadow(0 0 8px #00d4ff60);">GearHub</span>
            </a>

            <!-- Search Bar -->
            <form method="GET" action="{{ route('produits.index') }}" class="mx-4 flex flex-1 max-w-md">
                <div class="relative w-full">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                    <input name="search" class="w-full rounded-full border-none bg-surface-light py-2 pl-10 pr-4 text-sm text-slate-100 focus:ring-2 focus:ring-primary" placeholder="Search gear..." type="text" value="{{ request('search') }}"/>
                </div>
            </form>

            <!-- Actions -->
            <div class="flex items-center gap-2 sm:gap-4">
                <nav class="hidden md:flex items-center gap-6 mr-4">
                    <a class="text-sm font-semibold hover:text-primary transition-colors {{ request()->routeIs('produits.*') ? 'text-primary' : '' }}" href="{{ route('produits.index') }}">Shop</a>
                    <a class="text-sm font-semibold hover:text-primary transition-colors" href="#">Community</a>
                </nav>

                @auth
                    <a href="{{ route('cart.index') }}" class="relative flex h-10 w-10 items-center justify-center rounded-lg bg-surface-light hover:bg-primary/20 transition-all">
                        <span class="material-symbols-outlined">shopping_cart</span>
                        @php $cartCount = count(session('cart', [])); @endphp
                        @if ($cartCount > 0)
                            <span class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-primary text-[10px] font-bold text-white">{{ $cartCount }}</span>
                        @endif
                    </a>
                    <div class="hidden sm:flex items-center gap-2">
                        <a href="{{ route('profil.edit') }}" class="text-sm font-semibold hover:text-primary transition-colors {{ request()->routeIs('profil.*') ? 'text-primary' : '' }}">{{ Auth::user()->nom }}</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="h-10 flex items-center justify-center rounded-lg bg-primary px-5 text-sm font-bold text-white shadow-lg shadow-primary/30 hover:brightness-110">Logout</button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('cart.index') }}" class="relative flex h-10 w-10 items-center justify-center rounded-lg bg-surface-light hover:bg-primary/20 transition-all">
                        <span class="material-symbols-outlined">shopping_cart</span>
                    </a>
                    <a href="{{ route('login') }}" class="hidden h-10 items-center justify-center rounded-lg border border-primary/50 px-5 text-sm font-bold text-primary hover:bg-primary/10 transition-all sm:flex">Login</a>
                    <a href="{{ route('register') }}" class="hidden h-10 items-center justify-center rounded-lg bg-primary px-5 text-sm font-bold text-white shadow-lg shadow-primary/30 hover:brightness-110 transition-all sm:flex">Register</a>
                    <a href="{{ route('login') }}" class="flex h-10 w-10 items-center justify-center rounded-lg bg-surface-light sm:hidden">
                        <span class="material-symbols-outlined">person</span>
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="w-full border-t border-primary/10 bg-[#0e0e0e] font-body text-xs uppercase tracking-widest">
        <div class="mx-auto max-w-7xl px-8 py-12 flex flex-col md:flex-row justify-between items-center gap-6">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <img src="/logo.png" alt="GearHub Logo" class="h-8 w-auto"/>
                <span class="font-black text-sm" style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent;">GearHub</span>
            </a>
            <div class="flex gap-8">
                <a class="text-on-surface-variant hover:text-primary transition-colors" href="#">Privacy Policy</a>
                <a class="text-on-surface-variant hover:text-primary transition-colors" href="#">Terms of Service</a>
                <a class="text-on-surface-variant hover:text-primary transition-colors" href="#">Shipping</a>
                <a class="text-on-surface-variant hover:text-primary transition-colors" href="#">Returns</a>
            </div>
            <p class="text-on-surface-variant normal-case tracking-normal text-[11px]">&copy; {{ date('Y') }} GearHub. All rights reserved.</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
