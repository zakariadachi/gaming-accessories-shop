<header class="sticky top-0 z-50 w-full border-b border-[#1e1e3f] bg-[#0e0e0e]/80 backdrop-blur-md">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6 lg:px-8">

        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center gap-2 flex-shrink-0">
            <img src="/logo.png" alt="GearHub Logo" class="h-14 w-auto"/>
            <span class="hidden text-xl font-black tracking-tighter sm:block" style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent;">GearHub</span>
        </a>

        <!-- Nav Links (desktop) -->
        <nav class="hidden md:flex items-center gap-8 mx-8">
            <a class="text-sm font-semibold transition-colors hover:text-[#00d4ff] {{ request()->routeIs('produits.*') ? 'text-[#00d4ff]' : 'text-[#c8c8e8]' }}" href="{{ route('produits.index') }}">Boutique</a>
            <a class="text-sm font-semibold transition-colors hover:text-[#00d4ff] {{ request()->routeIs('communaute.*') ? 'text-[#00d4ff]' : 'text-[#c8c8e8]' }}" href="{{ route('communaute.index') }}">Communauté</a>
        </nav>

        <!-- Search Bar (desktop) -->
        <form method="GET" action="{{ route('produits.index') }}" class="hidden md:flex flex-1 max-w-sm mx-4">
            <div class="relative w-full flex items-center">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#6b6b9a] text-lg">search</span>
                <input name="search" class="w-full rounded-l-full border-none bg-[#1a1a35] py-2 pl-10 pr-4 text-sm text-white placeholder:text-[#6b6b9a] focus:ring-2 focus:ring-[#8a2ce2] outline-none" placeholder="Rechercher..." type="text" value="{{ request('search') }}"/>
                <button type="submit" class="rounded-r-full bg-[#8a2ce2] px-4 py-2 text-sm font-bold text-white hover:brightness-110 transition-all">
                    <span class="material-symbols-outlined text-sm">search</span>
                </button>
            </div>
        </form>

        <!-- Desktop Right Actions -->
        <div class="hidden md:flex items-center gap-3">

            @auth
                {{-- Cart --}}
                <a href="{{ route('cart.index') }}" class="relative flex h-10 w-10 items-center justify-center rounded-xl border border-[#1e1e3f] bg-[#1a1a35] hover:border-[#00d4ff]/50 transition-all">
                    <span class="material-symbols-outlined text-[#00d4ff]">shopping_cart</span>
                    @php $cartCount = count(session('cart', [])); @endphp
                    @if ($cartCount > 0)
                        <span class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-[#8a2ce2] text-[10px] font-bold text-white">{{ $cartCount }}</span>
                    @endif
                </a>

                {{-- User Dropdown --}}
                <div class="relative" id="user-dropdown-wrapper">
                    <button onclick="toggleDropdown()" class="flex items-center gap-2 px-3 py-2 rounded-xl border border-[#1e1e3f] bg-[#1a1a35] hover:border-[#00d4ff]/50 transition-all">
                        <div class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-black text-white flex-shrink-0"
                            style="background: linear-gradient(135deg, #00d4ff, #8a2ce2);">
                            {{ strtoupper(substr(Auth::user()->nom, 0, 1)) }}
                        </div>
                        <span class="text-sm font-semibold text-[#c8c8e8] max-w-[100px] truncate">{{ Auth::user()->nom }}</span>
                        <span class="material-symbols-outlined text-[#6b6b9a] text-sm">expand_more</span>
                    </button>

                    {{-- Dropdown Menu --}}
                    <div id="user-dropdown" class="hidden absolute right-0 top-12 w-48 rounded-2xl overflow-hidden z-50"
                        style="background: #0f0f23; border: 1px solid #1e1e3f; box-shadow: 0 10px 40px #00000060;">
                        <div class="p-2 space-y-1">
                            <a href="{{ route('profil.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-[#c8c8e8] hover:bg-[#1a1a35] hover:text-[#00d4ff] transition-all">
                                <span class="material-symbols-outlined text-lg">person</span>
                                Mon profil
                            </a>
                            <a href="{{ route('commandes.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-[#c8c8e8] hover:bg-[#1a1a35] hover:text-[#00d4ff] transition-all">
                                <span class="material-symbols-outlined text-lg">receipt_long</span>
                                Mes commandes
                            </a>
                            <div class="h-px my-1" style="background: #1e1e3f;"></div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-[#ff3d71] hover:bg-[#ff3d71]/10 transition-all">
                                    <span class="material-symbols-outlined text-lg">logout</span>
                                    Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            @else
                <a href="{{ route('cart.index') }}" class="relative flex h-10 w-10 items-center justify-center rounded-xl border border-[#1e1e3f] bg-[#1a1a35] hover:border-[#00d4ff]/50 transition-all">
                    <span class="material-symbols-outlined text-[#00d4ff]">shopping_cart</span>
                </a>
                <a href="{{ route('login') }}" class="h-10 flex items-center justify-center rounded-xl border border-[#00d4ff]/50 px-5 text-sm font-bold text-[#00d4ff] hover:bg-[#00d4ff]/10 transition-all">Connexion</a>
                <a href="{{ route('register') }}" class="h-10 flex items-center justify-center rounded-xl px-5 text-sm font-bold text-white transition-all hover:scale-105" style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); box-shadow: 0 0 15px #00d4ff30;">Inscription</a>
            @endauth
        </div>

        <!-- Mobile Right Actions -->
        <div class="flex md:hidden items-center gap-2">
            @auth
                <a href="{{ route('cart.index') }}" class="relative flex h-9 w-9 items-center justify-center rounded-xl border border-[#1e1e3f] bg-[#1a1a35]">
                    <span class="material-symbols-outlined text-[#00d4ff] text-xl">shopping_cart</span>
                    @php $cartCount = count(session('cart', [])); @endphp
                    @if ($cartCount > 0)
                        <span class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-[#8a2ce2] text-[10px] font-bold text-white">{{ $cartCount }}</span>
                    @endif
                </a>
            @endauth
            <button id="burger-btn" class="flex h-9 w-9 items-center justify-center rounded-xl border border-[#1e1e3f] bg-[#1a1a35] transition-all">
                <span id="burger-icon" class="material-symbols-outlined text-[#00d4ff] text-xl">menu</span>
            </button>
        </div>

    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden border-t border-[#1e1e3f] bg-[#0a0a1a]">
        <div class="px-4 py-4 space-y-3">

            <form method="GET" action="{{ route('produits.index') }}" class="flex">
                <div class="relative w-full flex items-center">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#6b6b9a] text-sm">search</span>
                    <input name="search" class="w-full rounded-l-xl border-none bg-[#1a1a35] py-2.5 pl-9 pr-3 text-sm text-white placeholder:text-[#6b6b9a] outline-none" placeholder="Rechercher..." type="text" value="{{ request('search') }}"/>
                    <button type="submit" class="rounded-r-xl bg-[#8a2ce2] px-4 py-2.5 text-sm font-bold text-white">
                        <span class="material-symbols-outlined text-sm">search</span>
                    </button>
                </div>
            </form>

            <div class="space-y-1 pt-1">
                <a href="{{ route('home') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('home') ? 'text-[#00d4ff] bg-[#00d4ff]/10' : 'text-[#c8c8e8] hover:bg-[#1a1a35]' }} transition-all">
                    <span class="material-symbols-outlined text-lg">home</span>Accueil
                </a>
                <a href="{{ route('produits.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('produits.*') ? 'text-[#00d4ff] bg-[#00d4ff]/10' : 'text-[#c8c8e8] hover:bg-[#1a1a35]' }} transition-all">
                    <span class="material-symbols-outlined text-lg">storefront</span>Boutique
                </a>
                <a href="{{ route('communaute.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('communaute.*') ? 'text-[#00d4ff] bg-[#00d4ff]/10' : 'text-[#c8c8e8] hover:bg-[#1a1a35]' }} transition-all">
                    <span class="material-symbols-outlined text-lg">group</span>Communauté
                </a>
            </div>

            <div class="border-t border-[#1e1e3f] pt-3 space-y-2">
                @auth
                    <a href="{{ route('profil.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-[#c8c8e8] hover:bg-[#1a1a35] transition-all">
                        <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-black text-white" style="background: linear-gradient(135deg, #00d4ff, #8a2ce2);">
                            {{ strtoupper(substr(Auth::user()->nom, 0, 1)) }}
                        </div>
                        {{ Auth::user()->nom }}
                    </a>
                    <a href="{{ route('commandes.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-[#c8c8e8] hover:bg-[#1a1a35] transition-all">
                        <span class="material-symbols-outlined text-lg">receipt_long</span>Mes commandes
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-[#ff3d71] hover:bg-[#ff3d71]/10 transition-all">
                            <span class="material-symbols-outlined text-lg">logout</span>Déconnexion
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="flex items-center justify-center w-full py-3 rounded-xl text-sm font-bold text-[#00d4ff] border border-[#00d4ff]/50 hover:bg-[#00d4ff]/10 transition-all">Connexion</a>
                    <a href="{{ route('register') }}" class="flex items-center justify-center w-full py-3 rounded-xl text-sm font-bold text-white transition-all" style="background: linear-gradient(135deg, #00d4ff, #8a2ce2);">Inscription</a>
                @endauth
            </div>

        </div>
    </div>
</header>

<script>
    // Burger menu
    document.getElementById('burger-btn').addEventListener('click', () => {
        const menu = document.getElementById('mobile-menu');
        const icon = document.getElementById('burger-icon');
        menu.classList.toggle('hidden');
        icon.textContent = menu.classList.contains('hidden') ? 'menu' : 'close';
    });

    // User dropdown
    function toggleDropdown() {
        document.getElementById('user-dropdown').classList.toggle('hidden');
    }

    // Close dropdown on outside click
    document.addEventListener('click', (e) => {
        const wrapper = document.getElementById('user-dropdown-wrapper');
        if (wrapper && !wrapper.contains(e.target)) {
            document.getElementById('user-dropdown')?.classList.add('hidden');
        }
    });
</script>
