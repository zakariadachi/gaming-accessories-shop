@extends('layouts.main')

@section('title', 'Communauté - GearHub')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- Hero --}}
    <section class="relative mb-16 overflow-hidden rounded-2xl p-10 md:p-16 text-center"
        style="background: linear-gradient(135deg, #050510, #0f0f23, #1a1a35); border: 1px solid #00d4ff20;">
        <div class="absolute inset-0 opacity-10"
            style="background-image: radial-gradient(circle at 2px 2px, #00d4ff 1px, transparent 0); background-size: 24px 24px;"></div>
        <div class="relative z-10">
            <span class="inline-block rounded-full px-4 py-1 text-xs font-bold uppercase tracking-widest mb-4"
                style="background: #00d4ff15; border: 1px solid #00d4ff30; color: #00d4ff;">
                GearHub Communauté
            </span>
            <h1 class="text-5xl font-black tracking-tight text-white mb-4">
                LA COMMUNAUTÉ <span style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">GEARHUB</span>
            </h1>
            <p class="text-[#c8c8e8] text-lg max-w-xl mx-auto">
                Des milliers de gamers nous font confiance pour leur matériel. Découvrez pourquoi.
            </p>
        </div>
    </section>

    {{-- Pourquoi GearHub --}}
    <section class="mb-16">
        <h2 class="text-3xl font-black text-center mb-10">
            Pourquoi choisir <span style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">GearHub ?</span>
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ([
                ['icon' => 'local_shipping',  'title' => 'Livraison rapide',    'desc' => 'Livraison en 24-48h partout en France. Suivi en temps réel.',          'color' => '#00d4ff'],
                ['icon' => 'verified_user',   'title' => 'Garantie 2 ans',      'desc' => 'Tous nos produits sont garantis 2 ans. Retour gratuit sous 30 jours.',  'color' => '#00e676'],
                ['icon' => 'support_agent',   'title' => 'Support 24/7',        'desc' => 'Notre équipe est disponible 7j/7 pour répondre à vos questions.',       'color' => '#8a2ce2'],
                ['icon' => 'workspace_premium','title' => 'Produits certifiés', 'desc' => 'Uniquement des produits officiels et certifiés par les marques.',       'color' => '#ffaa00'],
            ] as $item)
                <div class="rounded-2xl p-6 text-center transition-all hover:translate-y-[-4px]"
                    style="background: #0f0f23; border: 1px solid #1e1e3f;">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4"
                        style="background: {{ $item['color'] }}15; border: 1px solid {{ $item['color'] }}30;">
                        <span class="material-symbols-outlined text-2xl" style="color: {{ $item['color'] }};">{{ $item['icon'] }}</span>
                    </div>
                    <h3 class="font-black text-white mb-2">{{ $item['title'] }}</h3>
                    <p class="text-xs text-[#6b6b9a] leading-relaxed">{{ $item['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Témoignages --}}
    <section class="mb-16">
        <h2 class="text-3xl font-black text-center mb-10">
            Ce que disent nos <span style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">clients</span>
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ([
                ['pseudo' => 'Alex_Gaming',    'produit' => 'Razer BlackWidow V4',       'note' => 5, 'commentaire' => 'Clavier incroyable, les switchs mécaniques sont parfaits. Livraison ultra rapide !'],
                ['pseudo' => 'ProSetup_FR',    'produit' => 'Logitech G Pro X Superlight','note' => 5, 'commentaire' => 'La meilleure souris que j\'ai jamais utilisée. Légère et précise. Je recommande GearHub !'],
                ['pseudo' => 'NeonGamer',      'produit' => 'HyperX Cloud Alpha',         'note' => 4, 'commentaire' => 'Son excellent, très confortable pour les longues sessions. Rapport qualité/prix imbattable.'],
                ['pseudo' => 'TechMaster_99',  'produit' => 'ASUS ROG Swift 360Hz',       'note' => 5, 'commentaire' => 'Écran magnifique, 360Hz c\'est une autre dimension. Service client GearHub au top !'],
                ['pseudo' => 'StreamerPro',    'produit' => 'Secretlab Titan Evo',        'note' => 5, 'commentaire' => 'Chaise ultra confortable, parfaite pour les longues sessions de stream. Qualité premium.'],
                ['pseudo' => 'FPSLegend',      'produit' => 'SteelSeries Apex Pro',       'note' => 4, 'commentaire' => 'Clavier réactif et personnalisable. Expérience d\'achat sur GearHub très fluide.'],
            ] as $avis)
                <div class="rounded-2xl p-6 transition-all hover:translate-y-[-4px]"
                    style="background: #0f0f23; border: 1px solid #1e1e3f;">
                    {{-- Étoiles --}}
                    <div class="flex gap-1 mb-4">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="material-symbols-outlined text-sm" style="color: {{ $i <= $avis['note'] ? '#ffaa00' : '#1e1e3f' }}; font-variation-settings: 'FILL' 1;">star</span>
                        @endfor
                    </div>
                    {{-- Commentaire --}}
                    <p class="text-[#c8c8e8] text-sm leading-relaxed mb-6 italic">"{{ $avis['commentaire'] }}"</p>
                    {{-- Auteur --}}
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-black text-sm text-white flex-shrink-0"
                            style="background: linear-gradient(135deg, #00d4ff, #8a2ce2);">
                            {{ strtoupper(substr($avis['pseudo'], 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-bold text-white text-sm">{{ $avis['pseudo'] }}</p>
                            <p class="text-xs text-[#6b6b9a]">A acheté : {{ $avis['produit'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Marques partenaires --}}
    <section class="mb-16">
        <h2 class="text-3xl font-black text-center mb-10">
            Nos marques <span style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">partenaires</span>
        </h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">
            @foreach ([
                ['nom' => 'Razer',       'icon' => 'sports_esports', 'color' => '#00e676'],
                ['nom' => 'Corsair',     'icon' => 'memory',         'color' => '#00d4ff'],
                ['nom' => 'Logitech',    'icon' => 'mouse',          'color' => '#8a2ce2'],
                ['nom' => 'SteelSeries', 'icon' => 'keyboard',       'color' => '#ff3d71'],
                ['nom' => 'ASUS ROG',    'icon' => 'monitor',        'color' => '#ffaa00'],
                ['nom' => 'HyperX',      'icon' => 'headset',        'color' => '#00d4ff'],
            ] as $marque)
                <div class="rounded-2xl p-5 flex flex-col items-center gap-2 transition-all hover:translate-y-[-4px]"
                    style="background: #0f0f23; border: 1px solid #1e1e3f;">
                    <span class="material-symbols-outlined text-3xl" style="color: {{ $marque['color'] }};">{{ $marque['icon'] }}</span>
                    <span class="text-sm font-bold text-white">{{ $marque['nom'] }}</span>
                </div>
            @endforeach
        </div>
    </section>

</div>

@endsection
