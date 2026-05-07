<div class="flex flex-col gap-2">
    <label class="text-sm font-semibold text-on-surface-variant">Nom du produit</label>
    <input name="nom" type="text" value="{{ old('nom', $produit->nom ?? '') }}"
        class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-high text-white focus:ring-2 focus:ring-primary/50 outline-none transition-all placeholder:text-on-surface-variant"
        placeholder="Ex: Clavier mécanique RGB"/>
</div>

<div class="grid grid-cols-2 gap-4">
    <div class="flex flex-col gap-2">
        <label class="text-sm font-semibold text-on-surface-variant">Prix (€)</label>
        <input name="prix" type="number" step="0.01" min="0" value="{{ old('prix', $produit->prix ?? '') }}"
            class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-high text-white focus:ring-2 focus:ring-primary/50 outline-none transition-all"
            placeholder="0.00"/>
    </div>
    <div class="flex flex-col gap-2">
        <label class="text-sm font-semibold text-on-surface-variant">Stock</label>
        <input name="stock" type="number" min="0" value="{{ old('stock', $produit->stock ?? '') }}"
            class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-high text-white focus:ring-2 focus:ring-primary/50 outline-none transition-all"
            placeholder="0"/>
    </div>
</div>

<div class="flex flex-col gap-2">
    <label class="text-sm font-semibold text-on-surface-variant">Catégorie</label>
    <select name="categorie_id" class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-high text-white focus:ring-2 focus:ring-primary/50 outline-none transition-all">
        <option value="">-- Choisir une catégorie --</option>
        @foreach($categories as $categorie)
            <option value="{{ $categorie->id }}" {{ old('categorie_id', $produit->categorie_id ?? '') == $categorie->id ? 'selected' : '' }}>
                {{ $categorie->nom }}
            </option>
        @endforeach
    </select>
</div>

<div class="flex flex-col gap-2">
    <label class="text-sm font-semibold text-on-surface-variant">
        Image <span class="text-on-surface-variant font-normal">(PNG, JPG, WEBP — max 2MB)</span>
    </label>

    {{-- Aperçu image actuelle --}}
    @if (!empty($produit->image))
        <div class="flex items-center gap-3 mb-2">
            <img src="{{ Storage::url($produit->image) }}" alt="Image actuelle" class="w-16 h-16 rounded-xl object-cover"/>
            <span class="text-xs text-on-surface-variant">Image actuelle — laisser vide pour la conserver</span>
        </div>
    @endif

    <input name="image" type="file" accept="image/png,image/jpeg,image/webp"
        class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-high text-white focus:ring-2 focus:ring-primary/50 outline-none transition-all file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-primary/20 file:text-primary"/>
</div>
