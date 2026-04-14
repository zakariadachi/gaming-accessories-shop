@extends('layouts.admin')

@section('title', 'Produits - Admin')
@section('page-title', 'Gestion des Produits')

@section('content')

    <div class="flex items-center justify-between mb-6">
        <p class="text-on-surface-variant text-sm">{{ $produits->total() }} produits au total</p>
        <a href="{{ route('admin.produits.create') }}" class="flex items-center gap-2 bg-primary hover:brightness-110 text-white text-sm font-bold px-5 py-2.5 rounded-xl transition-all">
            <span class="material-symbols-outlined text-sm">add</span>
            Nouveau produit
        </a>
    </div>

    <div class="bg-surface-container rounded-xl overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-surface-container-high text-on-surface-variant uppercase text-xs tracking-widest">
                <tr>
                    <th class="px-6 py-4 text-left">Produit</th>
                    <th class="px-6 py-4 text-left">Catégorie</th>
                    <th class="px-6 py-4 text-left">Prix</th>
                    <th class="px-6 py-4 text-left">Stock</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($produits as $produit)
                    <tr class="hover:bg-surface-container-high transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($produit->image)
                                    <img src="{{ $produit->image }}" class="w-10 h-10 rounded-lg object-cover"/>
                                @else
                                    <div class="w-10 h-10 rounded-lg bg-surface-container-highest flex items-center justify-center">
                                        <span class="material-symbols-outlined text-primary/40 text-lg">sports_esports</span>
                                    </div>
                                @endif
                                <span class="font-semibold">{{ $produit->nom }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-on-surface-variant">{{ $produit->categorie->nom }}</td>
                        <td class="px-6 py-4 font-bold text-primary">{{ number_format($produit->prix, 2) }} €</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $produit->stock === 0 ? 'bg-error/20 text-error' : ($produit->stock <= 5 ? 'bg-yellow-400/20 text-yellow-400' : 'bg-green-500/20 text-green-400') }}">
                                {{ $produit->stock === 0 ? 'Rupture' : $produit->stock . ' en stock' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.produits.edit', $produit) }}" class="flex items-center gap-1 px-3 py-1.5 rounded-lg bg-primary/10 text-primary hover:bg-primary/20 text-xs font-bold transition-all">
                                    <span class="material-symbols-outlined text-sm">edit</span>
                                    Modifier
                                </a>
                                <form action="{{ route('admin.produits.destroy', $produit) }}" method="POST" onsubmit="return confirm('Supprimer ce produit ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex items-center gap-1 px-3 py-1.5 rounded-lg bg-error/10 text-error hover:bg-error/20 text-xs font-bold transition-all">
                                        <span class="material-symbols-outlined text-sm">delete</span>
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center text-on-surface-variant">
                            <span class="material-symbols-outlined text-4xl block mb-2">inventory_2</span>
                            Aucun produit trouvé.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $produits->links() }}
    </div>

@endsection
