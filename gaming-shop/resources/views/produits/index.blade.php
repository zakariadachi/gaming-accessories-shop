<!DOCTYPE html>
<html class="dark" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Produits - GamingSite</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#8a2ce2",
                        "background-dark": "#191121",
                    },
                },
            },
        }
    </script>
</head>
<body class="dark:bg-background-dark bg-gray-50 font-sans text-slate-900 dark:text-slate-100 min-h-screen">

    <nav class="bg-white dark:bg-white/5 border-b border-slate-200 dark:border-primary/20 px-6 py-4 flex items-center justify-between">
        <a href="{{ url('/') }}" class="text-xl font-black text-primary uppercase tracking-tight">GamingSite</a>
        <div class="flex items-center gap-4">
            @auth
                <span class="text-sm text-slate-400">{{ Auth::user()->nom }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="text-sm text-red-400 hover:underline">Déconnexion</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-sm text-primary font-semibold hover:underline">Connexion</a>
            @endauth
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 py-10">

        <h1 class="text-3xl font-bold mb-8">Nos Produits</h1>

        {{-- Filtres --}}
        <form method="GET" action="{{ route('produits.index') }}" class="flex flex-wrap gap-4 mb-8">
            <input name="search" value="{{ request('search') }}" type="text" placeholder="Rechercher un produit..."
                class="pl-4 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-primary/20 bg-white dark:bg-primary/5 dark:text-white outline-none focus:ring-2 focus:ring-primary/50 w-64"/>

            <select name="categorie" class="px-4 py-2.5 rounded-xl border border-slate-200 dark:border-primary/20 bg-white dark:bg-primary/5 dark:text-white outline-none focus:ring-2 focus:ring-primary/50">
                <option value="">Toutes les catégories</option>
                @foreach ($categories as $categorie)
                    <option value="{{ $categorie->id }}" {{ request('categorie') == $categorie->id ? 'selected' : '' }}>
                        {{ $categorie->nom }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-xl font-semibold hover:bg-primary/90 transition">
                Filtrer
            </button>
        </form>

        {{-- Grille produits --}}
        @if ($produits->isEmpty())
            <p class="text-slate-400 text-center py-20">Aucun produit trouvé.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($produits as $produit)
                    <a href="{{ route('produits.show', $produit) }}" class="group bg-white dark:bg-white/5 border border-slate-200 dark:border-primary/20 rounded-2xl overflow-hidden hover:border-primary/60 transition-all hover:shadow-lg hover:shadow-primary/10">
                        <div class="h-48 bg-primary/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-6xl text-primary/40">sports_esports</span>
                        </div>
                        <div class="p-4">
                            <span class="text-xs text-primary font-semibold uppercase tracking-wider">{{ $produit->categorie->nom }}</span>
                            <h3 class="font-bold text-slate-900 dark:text-white mt-1 group-hover:text-primary transition-colors">{{ $produit->nom }}</h3>
                            <div class="flex items-center justify-between mt-3">
                                <span class="text-lg font-black text-primary">{{ number_format($produit->prix, 2) }} €</span>
                                <span class="text-xs {{ $produit->stock > 0 ? 'text-green-400' : 'text-red-400' }}">
                                    {{ $produit->stock > 0 ? 'En stock' : 'Rupture' }}
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $produits->withQueryString()->links() }}
            </div>
        @endif
    </div>

</body>
</html>
