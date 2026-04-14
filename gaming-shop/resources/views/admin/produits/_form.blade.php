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
    <label class="text-sm font-semibold text-on-surface-variant">URL de l'image <span class="text-on-surface-variant font-normal">(optionnel)</span></label>
    <input name="image" type="url" value="{{ old('image', $produit->image ?? '') }}"
        class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-high text-white focus:ring-2 focus:ring-primary/50 outline-none transition-all placeholder:text-on-surface-variant"
        placeholder="https://..."/>
</div>
