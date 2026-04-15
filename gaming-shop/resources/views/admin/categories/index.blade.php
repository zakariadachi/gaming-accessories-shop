@extends('layouts.admin')

@section('title', 'Catégories - Admin GearHub')
@section('page-title', 'Gestion des Catégories')

@section('content')

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    {{-- Formulaire ajout --}}
    <div class="lg:col-span-1">
        <div class="rounded-2xl p-6 sticky top-24" style="background: #1a1a1a; border: 1px solid #262626;">
            <h2 class="font-black text-white mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined text-[#00d4ff]">add_circle</span>
                Nouvelle catégorie
            </h2>

            <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="text-xs font-bold uppercase tracking-wider text-[#6b6b9a] block mb-2">Nom</label>
                    <input name="nom" value="{{ old('nom') }}" type="text" placeholder="Ex: Claviers"
                        class="w-full rounded-xl px-4 py-3 text-sm text-white outline-none focus:ring-2 transition-all"
                        style="background: #262626; border: 1px solid #484847; focus:ring-color: #00d4ff;"/>
                    @error('nom') <p class="text-[#ff3d71] text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="text-xs font-bold uppercase tracking-wider text-[#6b6b9a] block mb-2">Description</label>
                    <textarea name="description" rows="3" placeholder="Description optionnelle..."
                        class="w-full rounded-xl px-4 py-3 text-sm text-white outline-none focus:ring-2 transition-all resize-none"
                        style="background: #262626; border: 1px solid #484847;">{{ old('description') }}</textarea>
                    @error('description') <p class="text-[#ff3d71] text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <button type="submit" class="w-full py-3 rounded-xl font-bold text-sm text-white transition-all hover:scale-105"
                    style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); box-shadow: 0 0 15px #00d4ff20;">
                    Ajouter la catégorie
                </button>
            </form>
        </div>
    </div>

    {{-- Liste des catégories --}}
    <div class="lg:col-span-2">
        <div class="rounded-2xl overflow-hidden" style="background: #1a1a1a; border: 1px solid #262626;">
            <div class="px-6 py-4 border-b flex items-center justify-between" style="border-color: #262626;">
                <h2 class="font-black text-white">Catégories ({{ $categories->count() }})</h2>
            </div>

            <div class="divide-y" style="divide-color: #262626;">
                @forelse ($categories as $categorie)
                    <div class="p-4" x-data="{ editing: false }">

                        {{-- Vue normale --}}
                        <div class="flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                                    style="background: #00d4ff15; border: 1px solid #00d4ff30;">
                                    <span class="material-symbols-outlined text-sm" style="color: #00d4ff;">category</span>
                                </div>
                                <div>
                                    <p class="font-bold text-white">{{ $categorie->nom }}</p>
                                    <p class="text-xs text-[#6b6b9a]">
                                        {{ $categorie->produits_count }} produit(s)
                                        @if ($categorie->description)
                                            · {{ Str::limit($categorie->description, 40) }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <button onclick="toggleEdit({{ $categorie->id }})"
                                    class="flex items-center gap-1 px-3 py-1.5 rounded-xl text-xs font-bold transition-all"
                                    style="background: #00d4ff15; border: 1px solid #00d4ff30; color: #00d4ff;">
                                    <span class="material-symbols-outlined text-sm">edit</span>
                                    Modifier
                                </button>
                                <form action="{{ route('admin.categories.destroy', $categorie) }}" method="POST"
                                    onsubmit="return confirm('Supprimer cette catégorie ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex items-center gap-1 px-3 py-1.5 rounded-xl text-xs font-bold transition-all"
                                        style="background: #ff3d7115; border: 1px solid #ff3d7130; color: #ff3d71;">
                                        <span class="material-symbols-outlined text-sm">delete</span>
                                    </button>
                                </form>
                            </div>
                        </div>

                        {{-- Formulaire édition --}}
                        <div id="edit-{{ $categorie->id }}" class="hidden mt-4">
                            <form action="{{ route('admin.categories.update', $categorie) }}" method="POST" class="space-y-3">
                                @csrf
                                @method('PUT')
                                <input name="nom" value="{{ $categorie->nom }}" type="text"
                                    class="w-full rounded-xl px-4 py-2.5 text-sm text-white outline-none"
                                    style="background: #262626; border: 1px solid #484847;"/>
                                <textarea name="description" rows="2"
                                    class="w-full rounded-xl px-4 py-2.5 text-sm text-white outline-none resize-none"
                                    style="background: #262626; border: 1px solid #484847;">{{ $categorie->description }}</textarea>
                                <div class="flex gap-2">
                                    <button type="submit" class="flex-1 py-2 rounded-xl text-xs font-bold text-white"
                                        style="background: linear-gradient(135deg, #00d4ff, #8a2ce2);">
                                        Sauvegarder
                                    </button>
                                    <button type="button" onclick="toggleEdit({{ $categorie->id }})"
                                        class="px-4 py-2 rounded-xl text-xs font-bold"
                                        style="background: #262626; color: #6b6b9a;">
                                        Annuler
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                @empty
                    <div class="px-6 py-16 text-center text-[#6b6b9a]">
                        <span class="material-symbols-outlined text-4xl block mb-2">category</span>
                        Aucune catégorie trouvée.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
    function toggleEdit(id) {
        const el = document.getElementById('edit-' + id);
        el.classList.toggle('hidden');
    }
</script>
@endpush
