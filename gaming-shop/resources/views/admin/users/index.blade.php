@extends('layouts.admin')

@section('title', 'Utilisateurs - Admin GearHub')
@section('page-title', 'Gestion des Utilisateurs')

@section('content')

    {{-- Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="rounded-2xl p-5 text-center" style="background: #1a1a1a; border: 1px solid #262626;">
            <span class="material-symbols-outlined text-2xl mb-1 block" style="color: #00d4ff;">group</span>
            <div class="text-3xl font-black text-white">{{ $users->total() }}</div>
            <div class="text-xs text-[#6b6b9a] mt-1">Total membres</div>
        </div>
        <div class="rounded-2xl p-5 text-center" style="background: #1a1a1a; border: 1px solid #262626;">
            <span class="material-symbols-outlined text-2xl mb-1 block" style="color: #00e676;">person</span>
            <div class="text-3xl font-black text-[#00e676]">{{ $users->getCollection()->where('role', 'client')->count() }}</div>
            <div class="text-xs text-[#6b6b9a] mt-1">Clients</div>
        </div>
        <div class="rounded-2xl p-5 text-center" style="background: #1a1a1a; border: 1px solid #262626;">
            <span class="material-symbols-outlined text-2xl mb-1 block" style="color: #ffaa00;">shield</span>
            <div class="text-3xl font-black text-[#ffaa00]">{{ $users->getCollection()->where('role', 'admin')->count() }}</div>
            <div class="text-xs text-[#6b6b9a] mt-1">Admins</div>
        </div>
    </div>

    {{-- Table --}}
    <div class="rounded-2xl overflow-hidden" style="background: #1a1a1a; border: 1px solid #262626;">
        <div class="px-6 py-4 border-b" style="border-color: #262626;">
            <h2 class="font-black text-white">Tous les utilisateurs</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr style="background: #20201f; border-bottom: 1px solid #262626;">
                        <th class="text-left px-6 py-3 text-xs font-bold uppercase tracking-wider text-[#6b6b9a]">Membre</th>
                        <th class="text-left px-6 py-3 text-xs font-bold uppercase tracking-wider text-[#6b6b9a]">Email</th>
                        <th class="text-left px-6 py-3 text-xs font-bold uppercase tracking-wider text-[#6b6b9a]">Rôle</th>
                        <th class="text-left px-6 py-3 text-xs font-bold uppercase tracking-wider text-[#6b6b9a]">Commandes</th>
                        <th class="text-left px-6 py-3 text-xs font-bold uppercase tracking-wider text-[#6b6b9a]">Inscrit le</th>
                        <th class="text-left px-6 py-3 text-xs font-bold uppercase tracking-wider text-[#6b6b9a]">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y" style="divide-color: #262626;">
                    @forelse ($users as $user)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full flex items-center justify-center font-black text-sm text-white flex-shrink-0"
                                        style="background: linear-gradient(135deg, #00d4ff, #8a2ce2);">
                                        {{ strtoupper(substr($user->nom, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-white">{{ $user->nom }}</p>
                                        @if ($user->id === Auth::id())
                                            <span class="text-[10px] text-[#00d4ff]">← Vous</span>
                                        @elseif ($user->is_banned)
                                            <span class="text-[10px] font-bold" style="color: #ff3d71;">Banni</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-[#6b6b9a] text-xs">
                                {{ substr($user->email, 0, 3) }}***{{ '@' }}{{ explode('@', $user->email)[1] }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-bold px-3 py-1 rounded-full"
                                    style="background: #ffaa0015; border: 1px solid #ffaa0040; color: #ffaa00;">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-black" style="color: #00d4ff;">{{ $user->commandes_count }}</span>
                            </td>
                            <td class="px-6 py-4 text-[#6b6b9a] text-xs">
                                {{ $user->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($user->id !== Auth::id() && $user->role !== 'admin')
                                    <form action="{{ route('admin.users.ban', $user) }}" method="POST"
                                        onsubmit="return confirm('{{ $user->is_banned ? 'Débannir ' . $user->nom . ' ?' : 'Bannir ' . $user->nom . ' ? Il ne pourra plus se connecter.' }}')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="flex items-center gap-1 px-3 py-1.5 rounded-xl text-xs font-bold transition-all"
                                            style="background: {{ $user->is_banned ? '#00e67615' : '#ff3d7115' }}; border: 1px solid {{ $user->is_banned ? '#00e67630' : '#ff3d7130' }}; color: {{ $user->is_banned ? '#00e676' : '#ff3d71' }};">
                                            <span class="material-symbols-outlined text-sm">{{ $user->is_banned ? 'lock_open' : 'block' }}</span>
                                            {{ $user->is_banned ? 'Débannir' : 'Bannir' }}
                                        </button>
                                    </form>
                                @else
                                    <span class="text-xs text-[#6b6b9a]">—</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center text-[#6b6b9a]">
                                <span class="material-symbols-outlined text-4xl block mb-2">group_off</span>
                                Aucun utilisateur trouvé.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($users->hasPages())
            <div class="px-6 py-4 border-t" style="border-color: #262626;">
                {{ $users->links() }}
            </div>
        @endif
    </div>

@endsection
