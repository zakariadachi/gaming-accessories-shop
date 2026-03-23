<!DOCTYPE html>
<html class="dark" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ $produit->nom }} - GamingSite</title>
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
                    <button class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-4 rounded-xl shadow-lg shadow-primary/20 flex items-center justify-center gap-2 transition-transform active:scale-[0.98]">
                        <span class="material-symbols-outlined">shopping_cart</span>
                        <span>Ajouter au panier</span>
                    </button>
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

</body>
</html>
