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
        .sidebar-link { display: flex; align-items: center; gap: 0.75rem; padding: 0.6rem 0.75rem; border-radius: 0.75rem; color: rgba(255,255,255,0.45); font-size: 0.875rem; font-weight: 500; transition: all 0.2s; text-decoration: none; }
        .sidebar-link:hover { background: rgba(138,44,226,0.1); color: rgba(255,255,255,0.9); transform: translateX(2px); }
        .sidebar-link.active { background: rgba(138,44,226,0.2); color: #ca98ff; border-left: 3px solid #8a2ce2; padding-left: calc(0.75rem - 3px); font-weight: 600; }
        .sidebar-link.active .material-symbols-outlined { font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen flex">

    <!-- Sidebar -->
    <aside class="fixed left-0 top-0 h-full w-64 flex flex-col z-40" style="background: linear-gradient(180deg, #0e0e0e 0%, #130d1a 100%); border-right: 1px solid rgba(138,44,226,0.15);">

        <!-- Logo -->
        <div class="px-6 py-6" style="border-bottom: 1px solid rgba(138,44,226,0.15);">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #8a2ce2, #00d4ff);">
                    <span class="material-symbols-outlined text-white text-lg">sports_esports</span>
                </div>
                <div>
                    <p class="text-sm font-black tracking-widest uppercase" style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent;">GearHub</p>
                    <p class="text-[10px] uppercase tracking-widest" style="color: rgba(138,44,226,0.7);">Admin Panel</p>
                </div>
            </a>
        </div>

        <!-- Nav Links -->
        <nav class="flex-1 px-3 py-5 space-y-1 overflow-y-auto">

            <!-- Général -->
            <p class="text-[9px] font-black uppercase tracking-[0.2em] px-3 mb-3" style="color: rgba(255,255,255,0.25);">Général</p>

            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="material-symbols-outlined text-lg">dashboard</span>
                <span>Dashboard</span>
            </a>

            <!-- Catalogue -->
            <p class="text-[9px] font-black uppercase tracking-[0.2em] px-3 mt-5 mb-3" style="color: rgba(255,255,255,0.25);">Catalogue</p>

            <a href="{{ route('admin.produits.index') }}" class="sidebar-link {{ request()->routeIs('admin.produits.*') ? 'active' : '' }}">
                <span class="material-symbols-outlined text-lg">inventory_2</span>
                <span>Produits</span>
            </a>

            <a href="{{ route('admin.categories.index') }}" class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <span class="material-symbols-outlined text-lg">category</span>
                <span>Catégories</span>
            </a>

            <!-- Ventes -->
            <p class="text-[9px] font-black uppercase tracking-[0.2em] px-3 mt-5 mb-3" style="color: rgba(255,255,255,0.25);">Ventes</p>

            <a href="{{ route('admin.commandes.index') }}" class="sidebar-link {{ request()->routeIs('admin.commandes.*') ? 'active' : '' }}">
                <span class="material-symbols-outlined text-lg">receipt_long</span>
                <span>Commandes</span>
            </a>

        </nav>

        <!-- User Info -->
        <div class="px-4 py-4 mx-3 mb-4 rounded-2xl" style="background: rgba(138,44,226,0.08); border: 1px solid rgba(138,44,226,0.2);">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center text-sm font-black" style="background: linear-gradient(135deg, #8a2ce2, #00d4ff); color: white;">
                    {{ strtoupper(substr(Auth::user()->nom, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold truncate">{{ Auth::user()->nom }}</p>
                    <p class="text-[10px] uppercase tracking-widest" style="color: rgba(138,44,226,0.8);">Administrateur</p>
                </div>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('profil.edit') }}" class="flex-1 flex items-center justify-center gap-1 py-2 rounded-xl text-xs font-semibold transition-all" style="background: rgba(255,255,255,0.05); color: #adaaaa;" onmouseover="this.style.background='rgba(255,255,255,0.1)'" onmouseout="this.style.background='rgba(255,255,255,0.05)'">
                    <span class="material-symbols-outlined text-sm">person</span>
                    Profil
                </a>
                <form action="{{ route('logout') }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-1 py-2 rounded-xl text-xs font-semibold transition-all" style="background: rgba(255,110,132,0.1); color: #ff6e84;" onmouseover="this.style.background='rgba(255,110,132,0.2)'" onmouseout="this.style.background='rgba(255,110,132,0.1)'">
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
