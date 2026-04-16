<!DOCTYPE html>
<html class="dark" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>404 - Page introuvable | GearHub</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        body { background-color: #050510; color: #ffffff; font-family: 'Inter', sans-serif; }
        .neon-text { background: linear-gradient(135deg, #00d4ff, #8a2ce2); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .btn-primary { background: linear-gradient(135deg, #00d4ff, #8a2ce2); box-shadow: 0 0 20px #00d4ff30; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; display: inline-block; line-height: 1; }
        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-20px); } }
        @keyframes glow { 0%, 100% { opacity: 0.3; } 50% { opacity: 0.8; } }
        .float { animation: float 3s ease-in-out infinite; }
        .glow { animation: glow 2s ease-in-out infinite; }
    </style>
</head>
<body class="min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="w-full border-b px-4 py-3" style="border-color: #1e1e3f; background: #050510/80;">
        <div class="mx-auto flex max-w-7xl items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <img src="/logo.png" alt="GearHub" class="h-14 w-auto"/>
                <span class="hidden text-xl font-black tracking-tighter sm:block neon-text">GearHub</span>
            </a>
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-sm text-[#c8c8e8] hover:text-[#00d4ff] transition-colors">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Retour à l'accueil
            </a>
        </div>
    </nav>

    <!-- Content -->
    <div class="flex-1 flex items-center justify-center px-4 py-20">
        <div class="text-center max-w-2xl mx-auto">

            {{-- Glowing orbs --}}
            <div class="relative mb-8">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-64 h-64 rounded-full glow" style="background: radial-gradient(circle, #00d4ff10, transparent 70%);"></div>
                </div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-48 h-48 rounded-full glow" style="background: radial-gradient(circle, #8a2ce210, transparent 70%); animation-delay: 1s;"></div>
                </div>

                {{-- 404 Number --}}
                <div class="relative float">
                    <span class="text-[10rem] font-black leading-none neon-text" style="filter: drop-shadow(0 0 30px #00d4ff40);">404</span>
                </div>
            </div>

            {{-- Icon --}}
            <div class="w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6"
                style="background: #00d4ff15; border: 1px solid #00d4ff30;">
                <span class="material-symbols-outlined text-4xl" style="color: #00d4ff;">search_off</span>
            </div>

            <h1 class="text-3xl font-black text-white mb-4">Page introuvable</h1>
            <p class="text-[#6b6b9a] text-lg mb-10 max-w-md mx-auto">
                La page que vous cherchez n'existe pas ou a été déplacée. Retournez à l'accueil pour continuer votre shopping.
            </p>

            {{-- Actions --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('home') }}" class="btn-primary flex items-center gap-2 px-8 py-4 rounded-xl font-bold text-white transition-all hover:scale-105">
                    <span class="material-symbols-outlined">home</span>
                    Retour à l'accueil
                </a>
                <a href="{{ route('produits.index') }}" class="flex items-center gap-2 px-8 py-4 rounded-xl font-bold transition-all hover:scale-105"
                    style="border: 1px solid #00d4ff40; color: #00d4ff;">
                    <span class="material-symbols-outlined">storefront</span>
                    Voir les produits
                </a>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <footer class="border-t py-6 text-center" style="border-color: #1e1e3f;">
        <p class="text-xs text-[#6b6b9a]">© 2024 GearHub. All rights reserved.</p>
    </footer>

</body>
</html>
