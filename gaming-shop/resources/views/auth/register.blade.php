<!DOCTYPE html>
<html class="dark" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Register | GamingSite</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
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
                    },
                    fontFamily: { "display": ["Inter"] },
                    borderRadius: {
                        "DEFAULT": "0.25rem", "lg": "0.5rem",
                        "xl": "0.75rem", "full": "9999px"
                    },
                },
            },
        }
    </script>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 min-h-screen overflow-x-hidden">
<div class="flex min-h-screen w-full flex-col lg:flex-row">

    <!-- Left Side: Hero Illustration -->
    <div class="relative hidden lg:flex lg:w-1/2 flex-col justify-center items-center bg-slate-900 overflow-hidden">
        <div class="absolute inset-0 z-0 opacity-60">
            <div class="w-full h-full bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuD3ukMixjBuGpiE-dRuZH0q33VAks2-7ajJRc65ImQDi3JEg_RCkMZalyKb9XXm_VhIOxBBaI0iDy2x5q48STUjz0UvUSnR0jpdOuzy9-y3XaGXCVQsVFB-LHIpbrzp1nBoTuASmJQrPTOS4NeK_pB_i9D_GmRiyYqILEjm35bciDZYrzY6yMHJ-8idpL511rpsAAWxTinz5CbNECUVr95cqoypdHq07RoDywHChWMJD6JCO34li670upDx08W1vuSAZczbcE2x5A');"></div>
            <div class="absolute inset-0 bg-gradient-to-tr from-background-dark via-background-dark/80 to-primary/30"></div>
        </div>
        <div class="relative z-10 p-12 max-w-xl">
            <div class="flex items-center gap-3 mb-8">
                <div class="text-primary">
                    <svg class="size-10" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" d="M24 18.4228L42 11.475V34.3663C42 34.7796 41.7457 35.1504 41.3601 35.2992L24 42V18.4228Z" fill="currentColor" fill-rule="evenodd"></path>
                        <path clip-rule="evenodd" d="M24 8.18819L33.4123 11.574L24 15.2071L14.5877 11.574L24 8.18819ZM9 15.8487L21 20.4805V37.6263L9 32.9945V15.8487ZM27 37.6263V20.4805L39 15.8487V32.9945L27 37.6263ZM25.354 2.29885C24.4788 1.98402 23.5212 1.98402 22.646 2.29885L4.98454 8.65208C3.7939 9.08038 3 10.2097 3 11.475V34.3663C3 36.0196 4.01719 37.5026 5.55962 38.098L22.9197 44.7987C23.6149 45.0671 24.3851 45.0671 25.0803 44.7987L42.4404 38.098C43.9828 37.5026 45 36.0196 45 34.3663V11.475C45 10.2097 44.2061 9.08038 43.0155 8.65208L25.354 2.29885Z" fill="currentColor" fill-rule="evenodd"></path>
                    </svg>
                </div>
                <span class="text-2xl font-black tracking-tight text-white uppercase">GamingSite</span>
            </div>
            <h1 class="text-white text-5xl xl:text-7xl font-black leading-tight tracking-tight mb-6">
                Join the <span class="text-primary">Elite</span>
            </h1>
            <p class="text-slate-300 text-lg xl:text-xl leading-relaxed max-w-md">
                Unlock exclusive hardware, digital assets, and high-performance gaming gear tailored for champions.
            </p>
            <div class="mt-12 flex gap-4">
                <div class="flex flex-col">
                    <span class="text-primary font-bold text-2xl">50k+</span>
                    <span class="text-slate-400 text-sm">Active Gamers</span>
                </div>
                <div class="w-px h-10 bg-slate-700"></div>
                <div class="flex flex-col">
                    <span class="text-primary font-bold text-2xl">200+</span>
                    <span class="text-slate-400 text-sm">Premium Brands</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side: Registration Form -->
    <div class="flex-1 flex items-center justify-center p-6 md:p-12 lg:p-20 bg-background-light dark:bg-background-dark">
        <div class="w-full max-w-[480px] flex flex-col">

            <!-- Mobile Header -->
            <div class="flex items-center gap-2 mb-10 lg:hidden">
                <div class="text-primary">
                    <span class="material-symbols-outlined text-4xl">deployed_code</span>
                </div>
                <span class="text-xl font-black tracking-tight dark:text-white">GamingSite</span>
            </div>

            <div class="mb-10">
                <h2 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white mb-2">Create Your Account</h2>
                <p class="text-slate-600 dark:text-slate-400">Enter your details to start your gaming journey.</p>
            </div>

            {{-- Erreurs de validation --}}
            @if ($errors->any())
                <div class="mb-6 bg-red-500/10 border border-red-500/30 rounded-lg p-4">
                    @foreach ($errors->all() as $error)
                        <p class="text-red-400 text-sm">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-5">
                @csrf

                <div class="flex flex-col gap-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300 ml-1">Full Name</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 dark:text-slate-400 text-xl">person</span>
                        <input name="nom" value="{{ old('nom') }}" class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-slate-200 dark:border-primary/20 bg-white dark:bg-primary/5 focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none transition-all dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-600" placeholder="Alex Sterling" type="text"/>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300 ml-1">Email Address</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 dark:text-slate-400 text-xl">mail</span>
                        <input name="email" value="{{ old('email') }}" class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-slate-200 dark:border-primary/20 bg-white dark:bg-primary/5 focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none transition-all dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-600" placeholder="alex@gamingsite.com" type="email"/>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-300 ml-1">Password</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 dark:text-slate-400 text-xl">lock</span>
                            <input name="password" class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-slate-200 dark:border-primary/20 bg-white dark:bg-primary/5 focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none transition-all dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-600" placeholder="••••••••" type="password"/>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-300 ml-1">Confirm Password</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 dark:text-slate-400 text-xl">lock_reset</span>
                            <input name="password_confirmation" class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-slate-200 dark:border-primary/20 bg-white dark:bg-primary/5 focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none transition-all dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-600" placeholder="••••••••" type="password"/>
                        </div>
                    </div>
                </div>

                <button class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-4 rounded-xl shadow-lg shadow-primary/20 flex items-center justify-center gap-2 transition-transform active:scale-[0.98]" type="submit">
                    <span>Create Account</span>
                    <span class="material-symbols-outlined">arrow_forward</span>
                </button>
            </form>

            <p class="mt-10 text-center text-slate-600 dark:text-slate-400">
                Already have an account?
                <a class="text-primary font-bold hover:underline" href="{{ route('login') }}">Log In</a>
            </p>
        </div>
    </div>
</div>
</body>
</html>
