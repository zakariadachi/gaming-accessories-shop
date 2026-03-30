@extends('layouts.main')

@section('title', 'Mon Profil - GearHub')

@section('content')

    <div class="max-w-3xl mx-auto px-6 py-12">

        <!-- Header -->
        <div class="mb-10 flex items-center gap-4">
            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-primary to-primary-dim flex items-center justify-center text-2xl font-black text-white font-headline">
                {{ strtoupper(substr(Auth::user()->nom, 0, 1)) }}
            </div>
            <div>
                <h1 class="text-3xl font-black font-headline tracking-tight">{{ Auth::user()->nom }}</h1>
                <p class="text-on-surface-variant text-sm">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <div class="space-y-6">

            <!-- Personal Info Form -->
            <div class="bg-surface-container rounded-2xl p-8">
                <div class="flex items-center gap-3 mb-6">
                    <span class="material-symbols-outlined text-primary">person</span>
                    <h2 class="text-xl font-bold font-headline">Informations personnelles</h2>
                </div>

                @if (session('success_infos'))
                    <div class="mb-6 flex items-center gap-2 bg-green-500/10 border border-green-500/30 rounded-xl px-4 py-3">
                        <span class="material-symbols-outlined text-green-400 text-lg">check_circle</span>
                        <p class="text-green-400 text-sm">{{ session('success_infos') }}</p>
                    </div>
                @endif

                @if ($errors->has('nom') || $errors->has('email'))
                    <div class="mb-6 bg-red-500/10 border border-red-500/30 rounded-xl px-4 py-3">
                        @foreach (['nom', 'email'] as $field)
                            @error($field)
                                <p class="text-error text-sm">{{ $message }}</p>
                            @enderror
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('profil.infos') }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-on-surface-variant">Nom complet</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-xl">badge</span>
                            <input name="nom" value="{{ old('nom', Auth::user()->nom) }}" type="text"
                                class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-outline-variant bg-surface-container-high focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none transition-all text-white placeholder:text-on-surface-variant"/>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-on-surface-variant">Adresse email</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-xl">mail</span>
                            <input name="email" value="{{ old('email', Auth::user()->email) }}" type="email"
                                class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-outline-variant bg-surface-container-high focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none transition-all text-white placeholder:text-on-surface-variant"/>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-primary to-primary-dim text-on-primary font-bold rounded-xl hover:opacity-90 active:scale-[0.98] transition-all">
                        Sauvegarder les modifications
                    </button>
                </form>
            </div>

            <!-- Password Form -->
            <div class="bg-surface-container rounded-2xl p-8">
                <div class="flex items-center gap-3 mb-6">
                    <span class="material-symbols-outlined text-primary">lock</span>
                    <h2 class="text-xl font-bold font-headline">Changer le mot de passe</h2>
                </div>

                @if (session('success_password'))
                    <div class="mb-6 flex items-center gap-2 bg-green-500/10 border border-green-500/30 rounded-xl px-4 py-3">
                        <span class="material-symbols-outlined text-green-400 text-lg">check_circle</span>
                        <p class="text-green-400 text-sm">{{ session('success_password') }}</p>
                    </div>
                @endif

                @if ($errors->has('current_password') || $errors->has('password'))
                    <div class="mb-6 bg-red-500/10 border border-red-500/30 rounded-xl px-4 py-3">
                        @foreach (['current_password', 'password'] as $field)
                            @error($field)
                                <p class="text-error text-sm">{{ $message }}</p>
                            @enderror
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('profil.password') }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-on-surface-variant">Mot de passe actuel</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-xl">lock</span>
                            <input name="current_password" type="password" placeholder="••••••••"
                                class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-outline-variant bg-surface-container-high focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none transition-all text-white placeholder:text-on-surface-variant"/>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-on-surface-variant">Nouveau mot de passe</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-xl">lock_reset</span>
                            <input name="password" type="password" placeholder="••••••••"
                                class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-outline-variant bg-surface-container-high focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none transition-all text-white placeholder:text-on-surface-variant"/>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-on-surface-variant">Confirmer le nouveau mot de passe</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-xl">lock_reset</span>
                            <input name="password_confirmation" type="password" placeholder="••••••••"
                                class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-outline-variant bg-surface-container-high focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none transition-all text-white placeholder:text-on-surface-variant"/>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-primary to-primary-dim text-on-primary font-bold rounded-xl hover:opacity-90 active:scale-[0.98] transition-all">
                        Mettre à jour le mot de passe
                    </button>
                </form>
            </div>

        </div>
    </div>

@endsection
