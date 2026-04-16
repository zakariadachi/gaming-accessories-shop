@extends('layouts.admin')

@section('title', 'Commandes - Admin GearHub')
@section('page-title', 'Gestion des Commandes')

@section('content')

    {{-- Stats --}}
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
        @php
            $statuts = [
                'en_attente' => ['label' => 'En attente', 'color' => '#ffaa00', 'icon' => 'schedule'],
                'confirmée'  => ['label' => 'Confirmée',  'color' => '#00d4ff', 'icon' => 'check_circle'],
                'annulée'    => ['label' => 'Annulée',    'color' => '#ff3d71', 'icon' => 'cancel'],
            ];
        @endphp
        @foreach ($statuts as $key => $s)
            <div class="rounded-2xl p-4 text-center" style="background: #1a1a1a; border: 1px solid {{ $s['color'] }}30;">
                <span class="material-symbols-outlined text-2xl mb-1 block" style="color: {{ $s['color'] }};">{{ $s['icon'] }}</span>
                <div class="text-2xl font-black" style="color: {{ $s['color'] }};">
                    {{ $commandes->where('statut', $key)->count() }}
                </div>
                <div class="text-xs mt-1" style="color: #6b6b9a;">{{ $s['label'] }}</div>
            </div>
        @endforeach
    </div>

    {{-- Table --}}
    <div class="rounded-2xl overflow-hidden" style="background: #1a1a1a; border: 1px solid #262626;">
        <div class="px-6 py-4 flex items-center justify-between border-b" style="border-color: #262626;">
            <h2 class="font-black text-white">Toutes les commandes</h2>
            <span class="text-xs text-[#6b6b9a]">{{ $commandes->total() }} commande(s)</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr style="background: #20201f; border-bottom: 1px solid #262626;">
                        <th class="text-left px-6 py-3 text-xs font-bold uppercase tracking-wider text-[#6b6b9a]">#</th>
                        <th class="text-left px-6 py-3 text-xs font-bold uppercase tracking-wider text-[#6b6b9a]">Client</th>
                        <th class="text-left px-6 py-3 text-xs font-bold uppercase tracking-wider text-[#6b6b9a]">Date</th>
                        <th class="text-left px-6 py-3 text-xs font-bold uppercase tracking-wider text-[#6b6b9a]">Articles</th>
                        <th class="text-left px-6 py-3 text-xs font-bold uppercase tracking-wider text-[#6b6b9a]">Total</th>
                        <th class="text-left px-6 py-3 text-xs font-bold uppercase tracking-wider text-[#6b6b9a]">Statut</th>
                        <th class="text-left px-6 py-3 text-xs font-bold uppercase tracking-wider text-[#6b6b9a]">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y" style="divide-color: #262626;">
                    @forelse ($commandes as $commande)
                        @php $s = $statuts[$commande->statut] ?? ['label' => $commande->statut, 'color' => '#6b6b9a']; @endphp
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="px-6 py-4 font-black text-white">
                                <a href="{{ route('admin.commandes.show', $commande) }}" class="hover:text-[#00d4ff] transition-colors">#{{ $commande->id }}</a>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-black text-white flex-shrink-0"
                                        style="background: linear-gradient(135deg, #00d4ff, #8a2ce2);">
                                        {{ strtoupper(substr($commande->user->nom, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-white text-sm">{{ $commande->user->nom }}</p>
                                        <p class="text-xs text-[#6b6b9a]">{{ substr($commande->user->email, 0, 3) }}***</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-[#c8c8e8]">{{ $commande->date->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-[#c8c8e8]">{{ $commande->ligneCommandes->count() }} article(s)</td>
                            <td class="px-6 py-4 font-black" style="color: #00d4ff;">{{ number_format($commande->total(), 2) }} €</td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-bold px-3 py-1 rounded-full"
                                    style="background: {{ $s['color'] }}15; border: 1px solid {{ $s['color'] }}40; color: {{ $s['color'] }};">
                                    {{ $s['label'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.commandes.statut', $commande) }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <select name="statut" onchange="this.form.submit()"
                                        class="text-xs rounded-xl px-3 py-2 font-semibold outline-none cursor-pointer"
                                        style="background: #262626; border: 1px solid #484847; color: #ffffff;">
                                        @foreach (\App\Models\Commande::STATUTS as $statut)
                                            <option value="{{ $statut }}" {{ $commande->statut === $statut ? 'selected' : '' }}>
                                                {{ ucfirst($statut) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center text-[#6b6b9a]">
                                <span class="material-symbols-outlined text-4xl block mb-2">receipt_long</span>
                                Aucune commande trouvée.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($commandes->hasPages())
            <div class="px-6 py-4 border-t" style="border-color: #262626;">
                {{ $commandes->links() }}
            </div>
        @endif
    </div>

@endsection
