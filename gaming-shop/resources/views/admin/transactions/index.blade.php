@extends('layouts.admin')

@section('title', 'Transactions - Admin GearHub')
@section('page-title', 'Transactions')

@section('content')

    {{-- Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="rounded-2xl p-5 text-center" style="background: #1a1a1a; border: 1px solid #262626;">
            <span class="material-symbols-outlined text-2xl mb-1 block" style="color: #00d4ff;">receipt_long</span>
            <div class="text-3xl font-black text-white">{{ $transactions->total() }}</div>
            <div class="text-xs text-[#6b6b9a] mt-1">Total transactions</div>
        </div>
        <div class="rounded-2xl p-5 text-center" style="background: #1a1a1a; border: 1px solid #262626;">
            <span class="material-symbols-outlined text-2xl mb-1 block" style="color: #00e676;">check_circle</span>
            <div class="text-3xl font-black text-[#00e676]">{{ $transactions->getCollection()->where('status', 'paid')->count() }}</div>
            <div class="text-xs text-[#6b6b9a] mt-1">Payées</div>
        </div>
        <div class="rounded-2xl p-5 text-center" style="background: #1a1a1a; border: 1px solid #262626;">
            <span class="material-symbols-outlined text-2xl mb-1 block" style="color: #ffaa00;">payments</span>
            <div class="text-3xl font-black text-[#ffaa00]">{{ number_format($transactions->getCollection()->sum('amount'), 2) }} €</div>
            <div class="text-xs text-[#6b6b9a] mt-1">Total encaissé</div>
        </div>
    </div>

    {{-- Table --}}
    <div class="rounded-2xl overflow-hidden" style="background: #1a1a1a; border: 1px solid #262626;">
        <div class="px-6 py-4 border-b" style="border-color: #262626;">
            <h2 class="font-black text-white">Toutes les transactions</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr style="background: #20201f; border-bottom: 1px solid #262626;">
                        <th class="text-left px-6 py-3 text-xs font-bold uppercase tracking-wider text-[#6b6b9a]">#</th>
                        <th class="text-left px-6 py-3 text-xs font-bold uppercase tracking-wider text-[#6b6b9a]">Client</th>
                        <th class="text-left px-6 py-3 text-xs font-bold uppercase tracking-wider text-[#6b6b9a]">Commande</th>
                        <th class="text-left px-6 py-3 text-xs font-bold uppercase tracking-wider text-[#6b6b9a]">Montant</th>
                        <th class="text-left px-6 py-3 text-xs font-bold uppercase tracking-wider text-[#6b6b9a]">Statut</th>
                        <th class="text-left px-6 py-3 text-xs font-bold uppercase tracking-wider text-[#6b6b9a]">Session Stripe</th>
                        <th class="text-left px-6 py-3 text-xs font-bold uppercase tracking-wider text-[#6b6b9a]">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#262626]">
                    @forelse ($transactions as $transaction)
                        @php
                            $statusConfig = [
                                'paid'     => ['label' => 'Payée',     'color' => '#00e676'],
                                'pending'  => ['label' => 'En attente','color' => '#ffaa00'],
                                'failed'   => ['label' => 'Échouée',   'color' => '#ff3d71'],
                                'refunded' => ['label' => 'Remboursée','color' => '#00d4ff'],
                            ];
                            $s = $statusConfig[$transaction->status] ?? ['label' => $transaction->status, 'color' => '#6b6b9a'];
                        @endphp
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="px-6 py-4 font-black text-white">#{{ $transaction->id }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-black text-white"
                                        style="background: linear-gradient(135deg, #00d4ff, #8a2ce2);">
                                        {{ strtoupper(substr($transaction->user->nom, 0, 1)) }}
                                    </div>
                                    <span class="font-semibold text-white">{{ $transaction->user->nom }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.commandes.show', $transaction->commande) }}"
                                    class="font-bold hover:underline" style="color: #00d4ff;">
                                    #{{ $transaction->commande_id }}
                                </a>
                            </td>
                            <td class="px-6 py-4 font-black" style="color: #00d4ff;">
                                {{ number_format($transaction->amount, 2) }} €
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-bold px-3 py-1 rounded-full"
                                    style="background: {{ $s['color'] }}15; border: 1px solid {{ $s['color'] }}40; color: {{ $s['color'] }};">
                                    {{ $s['label'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-[#6b6b9a] text-xs font-mono">
                                {{ substr($transaction->stripe_session_id, 0, 20) }}...
                            </td>
                            <td class="px-6 py-4 text-[#6b6b9a] text-xs">
                                {{ $transaction->created_at->format('d/m/Y H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center text-[#6b6b9a]">
                                <span class="material-symbols-outlined text-4xl block mb-2">receipt_long</span>
                                Aucune transaction trouvée.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($transactions->hasPages())
            <div class="px-6 py-4 border-t" style="border-color: #262626;">
                {{ $transactions->links() }}
            </div>
        @endif
    </div>

@endsection
