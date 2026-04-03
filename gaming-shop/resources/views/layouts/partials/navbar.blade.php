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
