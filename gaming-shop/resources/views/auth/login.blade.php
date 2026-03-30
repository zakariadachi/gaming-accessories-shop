<!DOCTYPE html>
<html class="dark" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Login - GamingSite</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
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
                    fontFamily: { "display": ["Inter", "sans-serif"] },
                    borderRadius: {
                        "DEFAULT": "0.25rem", "lg": "0.5rem",
                        "xl": "0.75rem", "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .neon-glow { box-shadow: 0 0 15px rgba(138, 44, 226, 0.4); }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display">
<div class="flex min-h-screen w-full flex-col lg:flex-row overflow-hidden">

    <!-- Left: Illustration Side -->
    <div class="hidden lg:flex lg:w-1/2 relative bg-primary/10 items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0 bg-cover bg-center opacity-80" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAuR8g-XmV--t6MFEfCAnLq8CgiuT7FeHOqaYH97wy9e7ZnlFoGh-TPgBk8i7QTnbo-8W8KeCE76bEINsyi0fbROUka_k4gvI2CRTTsZ-ZVC0MLdBtNxIHd-eHdNalDP56MXQZOMzpK9n8_MhAoxHJ9AljNgo1_FX87AipbHbYq7L6EpRxLMsQRpw63KmDfsM7GOB2sX8aIrFAskODaHEAMJ3_Z3rAQ5gVqJwkUjhARpwgawiuHJaYIA4n29rsDdVcMexTDMC3TEw');"></div>
        <div class="absolute inset-0 z-10 bg-gradient-to-tr from-background-dark via-background-dark/40 to-transparent"></div>
        <div class="relative z-20 p-12 max-w-lg">
            <div class="flex items-center gap-3 mb-8">
                <div class="size-10 text-primary">
                    <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                        <path d="M36.7273 44C33.9891 44 31.6043 39.8386 30.3636 33.69C29.123 39.8386 26.7382 44 24 44C21.2618 44 18.877 39.8386 17.6364 33.69C16.3957 39.8386 14.0109 44 11.2727 44C7.25611 44 4 35.0457 4 24C4 12.9543 7.25611 4 11.2727 4C14.0109 4 16.3957 8.16144 17.6364 14.31C18.877 8.16144 21.2618 4 24 4C26.7382 4 29.123 8.16144 30.3636 14.31C31.6043 8.16144 33.9891 4 36.7273 4C40.7439 4 44 12.9543 44 24C44 35.0457 40.7439 44 36.7273 44Z" fill="currentColor"></path>
                    </svg>
                </div>
                <h2 class="text-slate-100 text-3xl font-bold tracking-tight">GamingSite</h2>
            </div>
            <h1 class="text-5xl font-extrabold text-white leading-tight mb-6">Level up your <span class="text-primary">experience</span>.</h1>
            <p class="text-slate-300 text-lg leading-relaxed">Join millions of players in the ultimate competitive ecosystem. Compete, connect, and climb the leaderboards.</p>
        </div>
    </div>

    <!-- Right: Login Form Side -->
    <div class="flex flex-1 flex-col items-center justify-center px-6 py-12 lg:px-24 bg-background-light dark:bg-background-dark">
        <div class="w-full max-w-md space-y-8">
            <header class="text-center lg:text-left">
                <div class="lg:hidden flex justify-center mb-8">
                    <div class="size-10 text-primary">
                        <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <path d="M36.7273 44C33.9891 44 31.6043 39.8386 30.3636 33.69C29.123 39.8386 26.7382 44 24 44C21.2618 44 18.877 39.8386 17.6364 33.69C16.3957 39.8386 14.0109 44 11.2727 44C7.25611 44 4 35.0457 4 24C4 12.9543 7.25611 4 11.2727 4C14.0109 4 16.3957 8.16144 17.6364 14.31C18.877 8.16144 21.2618 4 24 4C26.7382 4 29.123 8.16144 30.3636 14.31C31.6043 8.16144 33.9891 4 36.7273 4C40.7439 4 44 12.9543 44 24C44 35.0457 40.7439 44 36.7273 44Z" fill="currentColor"></path>
                        </svg>
                    </div>
                </div>
                <h1 class="text-slate-900 dark:text-slate-100 text-3xl font-bold tracking-tight mb-2">Sign In</h1>
                <p class="text-slate-600 dark:text-slate-400">Welcome back! Please enter your details.</p>
            </header>

            {{-- Success message after register --}}
            @if (session('success'))
                <div class="bg-green-500/10 border border-green-500/30 rounded-lg p-4">
                    <p class="text-green-400 text-sm">{{ session('success') }}</p>
                </div>
            @endif

            {{-- Erreurs de validation --}}
            @if ($errors->any())
                <div class="bg-red-500/10 border border-red-500/30 rounded-lg p-4">
                    @foreach ($errors->all() as $error)
                        <p class="text-red-400 text-sm">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                            <span class="material-symbols-outlined text-lg">mail</span>
                        </div>
                        <input name="email" value="{{ old('email') }}" class="block w-full pl-10 pr-3 py-3 bg-slate-100 dark:bg-primary/5 border border-slate-200 dark:border-primary/20 rounded-lg text-slate-900 dark:text-white placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-primary/50 transition-all" placeholder="Enter your email" type="email"/>
                    </div>
                </div>

                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Password</label>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                            <span class="material-symbols-outlined text-lg">lock</span>
                        </div>
                        <input name="password" class="block w-full pl-10 pr-10 py-3 bg-slate-100 dark:bg-primary/5 border border-slate-200 dark:border-primary/20 rounded-lg text-slate-900 dark:text-white placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-primary/50 transition-all" placeholder="••••••••" type="password"/>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer text-slate-400 hover:text-primary transition-colors">
                            <span class="material-symbols-outlined text-lg">visibility</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center">
                    <input name="remember" class="size-4 rounded border-slate-300 dark:border-primary/30 text-primary focus:ring-primary bg-transparent" id="remember" type="checkbox"/>
                    <label class="ml-2 block text-sm text-slate-600 dark:text-slate-400" for="remember">Keep me logged in</label>
                </div>

                <button type="submit" class="w-full neon-glow bg-primary hover:bg-primary/90 text-white font-bold py-3.5 rounded-lg transition-all transform active:scale-[0.98]">
                    Login
                </button>
            </form>

            <footer class="text-center pt-4">
                <p class="text-slate-600 dark:text-slate-400 text-sm">
                    Don't have an account?
                    <a class="text-primary font-bold hover:underline transition-all" href="{{ route('register') }}">Register</a>
                </p>
            </footer>
        </div>
    </div>
</div>
</body>
</html>
