@extends('layouts.admin')

@section('title', 'Commande #' . $commande->id . ' - Admin GearHub')
@section('page-title', 'Détail Commande #' . $commande->id)

@section('content')

@php
    $statuts = [
        'en_attente' => ['label' => 'En attente', 'color' => '#ffaa00', 'icon' => 'schedule'],
        'confirmée'  => ['label' => 'Confirmée',  'color' => '#00d4ff', 'icon' => 'check_circle'],
        'annulée'    => ['label' => 'Annulée',    'color' => '#ff3d71', 'icon' => 'cancel'],
    ];
    $statut = $statuts[$commande->statut] ?? ['label' => $commande->statut, 'color' => '#6b6b9a', 'icon' => 'info'];
@endphp

<div class="mb-6">
    <a href="{{ route('admin.commandes.index') }}" class="flex items-center gap-2 text-sm text-[#6b6b9a] hover:text-[#00d4ff] transition-colors w-fit">
        <span class="material-symbols-outlined text-sm">arrow_back</span>
        Retour aux commandes
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Colonne principale --}}
    <div class="lg:col-span-2 space-y-6">

        {{-- Articles --}}
        <div class="rounded-2xl overflow-hidden" style="background: #1a1a1a; border: 1px solid #262626;">
            <div class="px-6 py-4 border-b flex items-center justify-between" style="border-color: #262626;">
                <h2 class="font-black text-white">Articles commandés</h2>
                <span class="text-xs text-[#6b6b9a]">{{ $commande->ligneCommandes->count() }} article(s)</span>
            </div>
            <div class="divide-y" style="divide-color: #262626;">
                @foreach ($commande->ligneCommandes as $ligne)
                    <div class="flex items-center gap-4 p-4">
                        <div class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0" style="background: #262626; border: 1px solid #484847;">
                            @if ($ligne->produit->image)
                                <img src="{{ $ligne->produit->image }}" alt="{{ $ligne->produit->nom }}" class="w-full h-full object-cover"/>
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="material-symbols-outlined text-2xl" style="color: #6b6b9a;">sports_esports</span>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-bold text-white truncate">{{ $ligne->produit->nom }}</p>
                            <p class="text-xs text-[#6b6b9a]">{{ $ligne->produit->categorie->nom }}</p>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <p class="text-xs text-[#6b6b9a]">{{ $ligne->quantity }} × {{ number_format($ligne->produit->prix, 2) }} €</p>
                            <p class="font-black" style="color: #00d4ff;">{{ number_format($ligne->produit->prix * $ligne->quantity, 2) }} €</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="px-6 py-4 flex justify-between items-center border-t" style="border-color: #262626; background: #20201f;">
                <span class="font-black text-white">Total</span>
                <span class="text-2xl font-black" style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                    {{ number_format($commande->total(), 2) }} €
                </span>
            </div>
        </div>

    </div>

    {{-- Colonne latérale --}}
    <div class="space-y-6">

        {{-- Infos commande --}}
        <div class="rounded-2xl p-6" style="background: #1a1a1a; border: 1px solid #262626;">
            <h3 class="font-black text-white mb-4">Informations</h3>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-[#6b6b9a]">Commande</span>
                    <span class="font-bold text-white">#{{ $commande->id }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#6b6b9a]">Date</span>
                    <span class="font-bold text-white">{{ $commande->date->format('d/m/Y') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-[#6b6b9a]">Statut</span>
                    <span class="text-xs font-bold px-3 py-1 rounded-full"
                        style="background: {{ $statut['color'] }}15; border: 1px solid {{ $statut['color'] }}40; color: {{ $statut['color'] }};">
                        {{ $statut['label'] }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Client --}}
        <div class="rounded-2xl p-6" style="background: #1a1a1a; border: 1px solid #262626;">
            <h3 class="font-black text-white mb-4">Client</h3>
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-full flex items-center justify-center font-black text-white"
                    style="background: linear-gradient(135deg, #00d4ff, #8a2ce2);">
                    {{ strtoupper(substr($commande->user->nom, 0, 1)) }}
                </div>
                <div>
                    <p class="font-bold text-white">{{ $commande->user->nom }}</p>
                    <p class="text-xs text-[#6b6b9a]">{{ $commande->user->email }}</p>
                </div>
            </div>
        </div>

        {{-- Changer statut --}}
        <div class="rounded-2xl p-6" style="background: #1a1a1a; border: 1px solid #262626;">
            <h3 class="font-black text-white mb-4">Changer le statut</h3>
            <form action="{{ route('admin.commandes.statut', $commande) }}" method="POST" class="space-y-3">
                @csrf
                @method('PATCH')
                <select name="statut" class="w-full rounded-xl px-4 py-3 text-sm font-semibold outline-none cursor-pointer"
                    style="background: #262626; border: 1px solid #484847; color: #ffffff;">
                    @foreach (\App\Models\Commande::STATUTS as $s)
                        <option value="{{ $s }}" {{ $commande->statut === $s ? 'selected' : '' }}>
                            {{ ucfirst($s) }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="w-full py-3 rounded-xl font-bold text-sm text-white transition-all hover:scale-105"
                    style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); box-shadow: 0 0 15px #00d4ff20;">
                    Mettre à jour
                </button>
            </form>
        </div>

    </div>
</div>

@endsection
