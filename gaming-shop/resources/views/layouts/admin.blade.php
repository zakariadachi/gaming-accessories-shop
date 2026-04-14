<!DOCTYPE html>
<html class="dark" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Admin - GearHub')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#8a2ce2",
                        "primary-dim": "#9c42f4",
                        "surface-container": "#1a1a1a",
                        "surface-container-high": "#20201f",
                        "surface-container-highest": "#262626",
                        "on-surface-variant": "#adaaaa",
                        "outline-variant": "#484847",
                        "error": "#ff6e84",
                        "error-container": "#a70138",
                        "on-error-container": "#ffb2b9",
                        "secondary-container": "#692886",
                        "on-secondary-container": "#efc0ff",
                    },
                    fontFamily: {
                        "headline": ["Plus Jakarta Sans"],
                        "body": ["Manrope"],
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block; line-height: 1;
        }
        body { background-color: #0e0e0e; color: #ffffff; font-family: 'Manrope', sans-serif; }
        .sidebar-link { @apply flex items-center gap-3 px-4 py-3 rounded-lg text-on-surface-variant hover:bg-surface-container-high hover:text-white transition-all text-sm font-medium; }
        .sidebar-link.active { @apply bg-primary/20 text-primary border-l-4 border-primary; }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen flex">

    <!-- Sidebar -->
    <aside class="fixed left-0 top-0 h-full w-64 bg-surface-container border-r border-white/5 flex flex-col z-40">

        <!-- Logo -->
        <div class="px-6 py-5 border-b border-white/5">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <img src="/logo.png" alt="GearHub" class="h-10 w-auto"/>
                <div>
                    <p class="text-xs font-black tracking-widest uppercase" style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent;">GearHub</p>
                    <p class="text-[10px] text-on-surface-variant uppercase tracking-widest">Admin Panel</p>
                </div>
            </a>
        </div>

        <!-- Nav Links -->
        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
            <p class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant px-4 mb-2">Général</p>

            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="material-symbols-outlined text-xl">dashboard</span>
                Dashboard
            </a>

            <p class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant px-4 mt-4 mb-2">Catalogue</p>

            <a href="{{ route('admin.produits.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.produits.*') ? 'active' : '' }}">
                <span class="material-symbols-outlined text-xl">inventory_2</span>
                Produits
            </a>

            <a href="{{ route('admin.categories.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <span class="material-symbols-outlined text-xl">category</span>
                Catégories
            </a>

            <p class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant px-4 mt-4 mb-2">Ventes</p>

            <a href="{{ route('admin.commandes.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.commandes.*') ? 'active' : '' }}">
                <span class="material-symbols-outlined text-xl">receipt_long</span>
                Commandes
            </a>
        </nav>

        <!-- User Info -->
        <div class="px-4 py-4 border-t border-white/5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-8 h-8 rounded-full bg-primary/30 flex items-center justify-center text-sm font-black text-primary">
                    {{ strtoupper(substr(Auth::user()->nom, 0, 1)) }}
                </div>
                <div>
                    <p class="text-sm font-semibold">{{ Auth::user()->nom }}</p>
                    <p class="text-[10px] text-on-surface-variant uppercase tracking-widest">Administrateur</p>
                </div>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('home') }}" class="flex-1 flex items-center justify-center gap-1 py-2 rounded-lg bg-surface-container-high hover:bg-surface-container-highest text-xs text-on-surface-variant hover:text-white transition-all">
                    <span class="material-symbols-outlined text-sm">storefront</span>
                    Site
                </a>
                <form action="{{ route('logout') }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-1 py-2 rounded-lg bg-error/10 hover:bg-error/20 text-xs text-error transition-all">
                        <span class="material-symbols-outlined text-sm">logout</span>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 ml-64 flex flex-col min-h-screen">

        <!-- Top Bar -->
        <header class="sticky top-0 z-30 w-full bg-[#0e0e0e]/80 backdrop-blur-md border-b border-white/5 px-8 py-4 flex items-center justify-between">
            <h1 class="text-lg font-bold font-headline">@yield('page-title', 'Dashboard')</h1>
            <div class="flex items-center gap-2 text-xs text-on-surface-variant">
                <span class="material-symbols-outlined text-sm">admin_panel_settings</span>
                <span>Admin Panel</span>
            </div>
        </header>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="mx-8 mt-4 flex items-center gap-2 bg-green-500/10 border border-green-500/30 rounded-xl px-4 py-3">
                <span class="material-symbols-outlined text-green-400 text-lg">check_circle</span>
                <p class="text-green-400 text-sm">{{ session('success') }}</p>
            </div>
        @endif
        @if(session('error'))
            <div class="mx-8 mt-4 flex items-center gap-2 bg-error/10 border border-error/30 rounded-xl px-4 py-3">
                <span class="material-symbols-outlined text-error text-lg">error</span>
                <p class="text-error text-sm">{{ session('error') }}</p>
            </div>
        @endif

        <!-- Page Content -->
        <main class="flex-1 px-8 py-6">
            @yield('content')
        </main>

    </div>

    @stack('scripts')
</body>
</html>
