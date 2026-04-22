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

    {{-- Preview image actuelle --}}
    @if(!empty($produit->image ?? null))
        <div class="flex items-center gap-3 mb-2">
            <img src="{{ $produit->image }}" class="w-16 h-16 rounded-xl object-cover border border-outline-variant"/>
            <span class="text-xs text-on-surface-variant">Image actuelle</span>
        </div>
    @endif

    <label class="flex flex-col items-center justify-center w-full h-32 rounded-xl border-2 border-dashed border-outline-variant bg-surface-container-high cursor-pointer hover:border-primary/50 transition-all" id="upload-label">
        <span class="material-symbols-outlined text-3xl text-on-surface-variant mb-1">upload_file</span>
        <span class="text-sm text-on-surface-variant" id="upload-text">Cliquer pour choisir une image</span>
        <input name="image" type="file" accept=".png,.jpg,.jpeg,.webp" class="hidden" id="image-input"/>
    </label>
    @error('image') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
</div>

@push('scripts')
<script>
    document.getElementById('image-input').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            document.getElementById('upload-text').textContent = file.name;
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('upload-label').style.backgroundImage = `url(${e.target.result})`;
                document.getElementById('upload-label').style.backgroundSize = 'cover';
                document.getElementById('upload-label').style.backgroundPosition = 'center';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
