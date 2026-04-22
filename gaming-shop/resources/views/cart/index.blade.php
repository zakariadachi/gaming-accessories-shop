<!DOCTYPE html>
<html class="dark" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Mon Panier - GearHub</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "neon-blue":      "#00d4ff",
                        "neon-purple":    "#8a2ce2",
                        "bg-base":        "#050510",
                        "bg-card":        "#0f0f23",
                        "bg-surface":     "#1a1a35",
                        "bg-elevated":    "#252545",
                        "success":        "#00e676",
                        "error":          "#ff3d71",
                        "warning":        "#ffaa00",
                        "text-secondary": "#c8c8e8",
                        "text-muted":     "#6b6b9a",
                        "border-default": "#1e1e3f",
                    },
                    fontFamily: { "display": ["Inter", "sans-serif"] },
                },
            },
        }
    </script>
    <style>
        body { background-color: #050510; color: #ffffff; font-family: 'Inter', sans-serif; }
        .btn-primary { background: linear-gradient(135deg, #00d4ff, #8a2ce2); box-shadow: 0 0 20px #00d4ff30; }
        .btn-primary:hover { box-shadow: 0 0 35px #00d4ff50; }
        .neon-text { background: linear-gradient(135deg, #00d4ff, #8a2ce2); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; display: inline-block; line-height: 1; }
    </style>
</head>
<body>

    <!-- Navbar -->
    @include('layouts.partials.navbar')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- Flash messages --}}
        @if (session('success'))
            <div class="mb-6 flex items-center gap-2 bg-[#00e676]/10 border border-[#00e676]/30 rounded-xl px-4 py-3">
                <span class="material-symbols-outlined text-[#00e676]">check_circle</span>
                <p class="text-[#00e676] text-sm font-semibold">{{ session('success') }}</p>
            </div>
        @endif
        @if (session('error'))
            <div class="mb-6 flex items-center gap-2 bg-[#ff3d71]/10 border border-[#ff3d71]/30 rounded-xl px-4 py-3">
                <span class="material-symbols-outlined text-[#ff3d71]">error</span>
                <p class="text-[#ff3d71] text-sm font-semibold">{{ session('error') }}</p>
            </div>
        @endif

        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-4xl font-black tracking-tight">Mon <span class="neon-text">Panier</span></h1>
                <p class="text-[#6b6b9a] mt-1">{{ count($cart) }} article(s)</p>
            </div>
            @if (!empty($cart))
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="flex items-center gap-2 text-sm text-[#ff3d71] border border-[#ff3d71]/30 px-4 py-2 rounded-xl hover:bg-[#ff3d71]/10 transition-all">
                        <span class="material-symbols-outlined text-sm">delete_sweep</span>
                        Vider le panier
                    </button>
                </form>
            @endif
        </div>

        @if (empty($cart))
            {{-- Panier vide --}}
            <div class="flex flex-col items-center justify-center py-32 text-center">
                <div class="w-24 h-24 rounded-full bg-[#0f0f23] border border-[#1e1e3f] flex items-center justify-center mb-6">
                    <span class="material-symbols-outlined text-5xl text-[#6b6b9a]">shopping_cart</span>
                </div>
                <h2 class="text-2xl font-bold text-white mb-2">Votre panier est vide</h2>
                <p class="text-[#6b6b9a] mb-8">Découvrez nos produits et ajoutez-les à votre panier.</p>
                <a href="{{ route('produits.index') }}" class="btn-primary flex items-center gap-2 px-8 py-3 rounded-xl font-bold text-white transition-all hover:scale-105">
                    <span class="material-symbols-outlined">storefront</span>
                    Voir les produits
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Liste des articles --}}
                <div class="lg:col-span-2 space-y-4">
                    @foreach ($cart as $item)
                        <div class="flex gap-3 bg-[#0f0f23] border border-[#1e1e3f] rounded-2xl p-3 md:p-4 hover:border-[#00d4ff]/30 transition-all">

                            {{-- Image --}}
                            <a href="{{ route('produits.show', $item['id']) }}" class="w-16 h-16 md:w-24 md:h-24 rounded-xl overflow-hidden bg-[#1a1a35] flex-shrink-0">
                                @if ($item['image'])
                                    <img src="{{ $item['image'] }}" alt="{{ $item['nom'] }}" class="w-full h-full object-cover"/>
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <span class="material-symbols-outlined text-3xl text-[#6b6b9a]">sports_esports</span>
                                    </div>
                                @endif
                            </a>

                            {{-- Infos --}}
                            <div class="flex-1 flex flex-col justify-between">
                                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-1">
                                    <a href="{{ route('produits.show', $item['id']) }}" class="font-bold text-white hover:text-[#00d4ff] transition-colors text-sm md:text-base">{{ $item['nom'] }}</a>
                                    <span class="neon-text font-black text-base md:text-lg">{{ number_format($item['prix'] * $item['quantity'], 2) }} €</span>
                                </div>
                                <span class="text-xs text-[#6b6b9a]">{{ number_format($item['prix'], 2) }} € / unité</span>

                                <div class="flex items-center justify-between mt-3">
                                    {{-- Quantité --}}
                                    <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" name="quantity" value="{{ max(1, $item['quantity'] - 1) }}"
                                            class="w-8 h-8 rounded-lg bg-[#1a1a35] border border-[#1e1e3f] flex items-center justify-center hover:border-[#00d4ff]/50 transition-all font-bold text-lg">−</button>
                                        <span class="w-10 text-center font-bold text-white">{{ $item['quantity'] }}</span>
                                        <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}"
                                            class="w-8 h-8 rounded-lg bg-[#1a1a35] border border-[#1e1e3f] flex items-center justify-center hover:border-[#00d4ff]/50 transition-all font-bold text-lg">+</button>
                                    </form>

                                    {{-- Supprimer --}}
                                    <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center gap-1 text-xs text-[#ff3d71] hover:bg-[#ff3d71]/10 px-3 py-1.5 rounded-lg transition-all">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Résumé commande --}}
                <div class="lg:col-span-1">
                    <div class="bg-[#0f0f23] border border-[#1e1e3f] rounded-2xl p-6 sticky top-24">
                        <h2 class="text-xl font-black mb-6">Résumé</h2>

                        <div class="space-y-3 mb-6">
                            @foreach ($cart as $item)
                                <div class="flex justify-between text-sm text-[#c8c8e8]">
                                    <span class="truncate mr-2">{{ $item['nom'] }} × {{ $item['quantity'] }}</span>
                                    <span class="font-semibold whitespace-nowrap">{{ number_format($item['prix'] * $item['quantity'], 2) }} €</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="h-px bg-[#1e1e3f] mb-4"></div>

                        <div class="flex justify-between items-center mb-6">
                            <span class="text-[#6b6b9a]">Livraison</span>
                            <span class="text-[#00e676] font-semibold">Gratuite</span>
                        </div>

                        <div class="flex justify-between items-center mb-8">
                            <span class="text-lg font-black">Total</span>
                            <span class="text-2xl font-black neon-text">{{ number_format($total, 2) }} €</span>
                        </div>

                        <form action="{{ route('payment.checkout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full btn-primary flex items-center justify-center gap-2 rounded-xl py-4 font-bold text-white transition-all active:scale-95 hover:scale-105">
                                <span class="material-symbols-outlined">credit_card</span>
                                Payer maintenant
                            </button>
                        </form>

                        <a href="{{ route('produits.index') }}" class="mt-4 flex items-center justify-center gap-2 text-sm text-[#6b6b9a] hover:text-[#00d4ff] transition-colors">
                            <span class="material-symbols-outlined text-sm">arrow_back</span>
                            Continuer mes achats
                        </a>
                    </div>
                </div>

            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="border-t border-[#1e1e3f] bg-[#050510] py-10 mt-16">
        <div class="mx-auto max-w-7xl px-4 text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 mb-4">
                <img src="/logo.png" alt="GearHub" class="h-8 w-auto"/>
                <span class="neon-text font-black text-lg">GearHub</span>
            </a>
            <p class="text-xs text-[#6b6b9a]">© 2024 GearHub. Tous droits réservés.</p>
        </div>
    </footer>

</body>
</html>
