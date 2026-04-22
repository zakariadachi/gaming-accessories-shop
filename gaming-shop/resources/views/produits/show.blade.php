@extends('layouts.main')

@section('title', $produit->nom . ' - GearHub')

@section('content')

    <div class="max-w-6xl mx-auto px-4 md:px-6 py-10">

        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-on-surface-variant mb-8">
            <a href="{{ route('produits.index') }}" class="hover:text-primary transition">Produits</a>
            <span>/</span>
            <span class="text-primary">{{ $produit->nom }}</span>
        </div>

        <!-- Product Detail -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            <!-- Image -->
            <div class="bg-surface-container border border-primary/20 rounded-2xl h-64 md:h-96 overflow-hidden flex items-center justify-center">
                @if ($produit->image)
                    <img src="{{ $produit->image }}" alt="{{ $produit->nom }}" class="w-full h-full object-cover"/>
                @else
                    <span class="material-symbols-outlined text-9xl text-primary/30">sports_esports</span>
                @endif
            </div>

            <!-- Info -->
            <div class="flex flex-col justify-center space-y-6">
                <div>
                    <span class="text-sm text-primary font-semibold uppercase tracking-wider">{{ $produit->categorie->nom }}</span>
                    <h1 class="text-4xl font-black font-headline mt-2">{{ $produit->nom }}</h1>
                </div>

                <div class="text-4xl font-black text-primary">
                    {{ number_format($produit->prix, 2) }} €
                </div>

                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg {{ $produit->stock > 0 ? 'text-green-400' : 'text-error' }}">
                        {{ $produit->stock > 0 ? 'check_circle' : 'cancel' }}
                    </span>
                    <span class="{{ $produit->stock > 0 ? 'text-green-400' : 'text-error' }} font-semibold">
                        {{ $produit->stock > 0 ? $produit->stock . ' en stock' : 'Rupture de stock' }}
                    </span>
                </div>

                @if ($produit->stock > 0)
                    <form action="{{ route('cart.add', $produit) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-4 rounded-xl shadow-lg shadow-primary/20 flex items-center justify-center gap-2 transition-transform active:scale-[0.98]">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            <span>Ajouter au panier</span>
                        </button>
                    </form>
                @else
                    <button disabled class="w-full bg-surface-container-highest text-on-surface-variant font-bold py-4 rounded-xl cursor-not-allowed">
                        Indisponible
                    </button>
                @endif
            </div>
        </div>

        {{-- ===== REVIEWS ===== --}}
        <section class="mt-16">
            <h2 class="text-2xl font-black mb-2">
                Avis <span style="background: linear-gradient(135deg, #00d4ff, #8a2ce2); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">clients</span>
            </h2>

            {{-- Moyenne --}}
            <div class="flex items-center gap-3 mb-8">
                <span class="text-4xl font-black text-white">{{ number_format($produit->moyenneNotes(), 1) }}</span>
                <div>
                    <div class="flex gap-1">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="material-symbols-outlined text-lg" style="color: {{ $i <= round($produit->moyenneNotes()) ? '#ffaa00' : '#1e1e3f' }}; font-variation-settings: 'FILL' 1;">star</span>
                        @endfor
                    </div>
                    <p class="text-xs text-[#6b6b9a] mt-1">{{ $reviews->total() }} avis</p>
                </div>
            </div>

            {{-- Formulaire --}}
            @auth
                @if ($aAchete && !$aDejaAvis)
                    <div class="rounded-2xl p-6 mb-8" style="background: #0f0f23; border: 1px solid #1e1e3f;">
                        <h3 class="font-black text-white mb-4">Laisser un avis</h3>
                        @if (session('success'))
                            <div class="mb-4 flex items-center gap-2 bg-[#00e676]/10 border border-[#00e676]/30 rounded-xl px-4 py-3">
                                <span class="material-symbols-outlined text-[#00e676] text-sm">check_circle</span>
                                <p class="text-[#00e676] text-sm">{{ session('success') }}</p>
                            </div>
                        @endif
                        <form action="{{ route('reviews.store', $produit) }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="text-sm font-semibold text-[#6b6b9a] block mb-2">Note</label>
                                <div class="flex gap-2" id="star-rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <label class="cursor-pointer">
                                            <input type="radio" name="note" value="{{ $i }}" class="hidden" required/>
                                            <span class="material-symbols-outlined text-3xl transition-colors" style="color: #1e1e3f; font-variation-settings: 'FILL' 1;">star</span>
                                        </label>
                                    @endfor
                                </div>
                                @error('note') <p class="text-[#ff3d71] text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-[#6b6b9a] block mb-2">Commentaire</label>
                                <textarea name="commentaire" rows="3" placeholder="Partagez votre expérience..."
                                    class="w-full rounded-xl px-4 py-3 text-sm text-white placeholder:text-[#6b6b9a] outline-none resize-none"
                                    style="background: #1a1a35; border: 1px solid #1e1e3f;">{{ old('commentaire') }}</textarea>
                                @error('commentaire') <p class="text-[#ff3d71] text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <button type="submit" class="px-6 py-3 rounded-xl font-bold text-sm text-white transition-all hover:scale-105"
                                style="background: linear-gradient(135deg, #00d4ff, #8a2ce2);">
                                Publier mon avis
                            </button>
                        </form>
                    </div>
                @elseif (!$aAchete)
                    <div class="rounded-2xl p-4 mb-8 flex items-center gap-3" style="background: #0f0f23; border: 1px solid #1e1e3f;">
                        <span class="material-symbols-outlined text-[#6b6b9a]">info</span>
                        <p class="text-sm text-[#6b6b9a]">Achetez ce produit pour laisser un avis.</p>
                    </div>
                @endif
            @endauth

            {{-- Liste des avis --}}
            @if ($reviews->isEmpty())
                <p class="text-[#6b6b9a] text-sm">Aucun avis pour ce produit.</p>
            @else
                <div class="space-y-4">
                    @foreach ($reviews as $review)
                        <div class="rounded-2xl p-5" style="background: #0f0f23; border: 1px solid #1e1e3f;">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full flex items-center justify-center font-black text-sm text-white"
                                        style="background: linear-gradient(135deg, #00d4ff, #8a2ce2);">
                                        {{ strtoupper(substr($review->user->nom, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-white text-sm">{{ $review->user->nom }}</p>
                                        <p class="text-xs text-[#6b6b9a]">{{ $review->created_at->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="flex gap-0.5">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span class="material-symbols-outlined text-sm" style="color: {{ $i <= $review->note ? '#ffaa00' : '#1e1e3f' }}; font-variation-settings: 'FILL' 1;">star</span>
                                        @endfor
                                    </div>
                                    @if (auth()->check() && $review->user_id === auth()->id())
                                        <div class="flex items-center gap-1">
                                            <button onclick="toggleEditReview({{ $review->id }})" class="text-[#00d4ff] hover:bg-[#00d4ff]/10 p-1 rounded-lg transition-all">
                                                <span class="material-symbols-outlined text-sm">edit</span>
                                            </button>
                                            <form action="{{ route('reviews.destroy', $review) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-[#ff3d71] hover:bg-[#ff3d71]/10 p-1 rounded-lg transition-all">
                                                    <span class="material-symbols-outlined text-sm">delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <p class="text-sm text-[#c8c8e8] leading-relaxed">{{ $review->commentaire }}</p>
                        </div>

                        {{-- Formulaire modification --}}
                        @if (auth()->check() && $review->user_id === auth()->id())
                            <div id="edit-review-{{ $review->id }}" class="hidden mt-4">
                                <form action="{{ route('reviews.update', $review) }}" method="POST" class="space-y-3">
                                    @csrf
                                    @method('PUT')
                                    <div class="flex gap-2" id="edit-stars-{{ $review->id }}">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <label class="cursor-pointer">
                                                <input type="radio" name="note" value="{{ $i }}" class="hidden" {{ $review->note == $i ? 'checked' : '' }}/>
                                                <span class="material-symbols-outlined text-2xl" style="color: {{ $i <= $review->note ? '#ffaa00' : '#1e1e3f' }}; font-variation-settings: 'FILL' 1;">star</span>
                                            </label>
                                        @endfor
                                    </div>
                                    <textarea name="commentaire" rows="3"
                                        class="w-full rounded-xl px-4 py-3 text-sm text-white outline-none resize-none"
                                        style="background: #1a1a35; border: 1px solid #1e1e3f;">{{ $review->commentaire }}</textarea>
                                    <div class="flex gap-2">
                                        <button type="submit" class="px-5 py-2 rounded-xl font-bold text-sm text-white transition-all hover:scale-105"
                                            style="background: linear-gradient(135deg, #00d4ff, #8a2ce2);">
                                            Sauvegarder
                                        </button>
                                        <button type="button" onclick="toggleEditReview({{ $review->id }})" class="px-5 py-2 rounded-xl font-bold text-sm transition-all"
                                            style="background: #1a1a35; color: #6b6b9a;">
                                            Annuler
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="mt-6">
                    {{ $reviews->withQueryString()->links() }}
                </div>
            @endif
        </section>

        {{-- Produits similaires --}}
        @if ($similaires->isNotEmpty())
            <div class="mt-16">
                <h2 class="text-2xl font-bold font-headline mb-6">Produits similaires</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach ($similaires as $similaire)
                        <a href="{{ route('produits.show', $similaire) }}" class="group bg-surface-container border border-primary/20 rounded-2xl overflow-hidden hover:border-primary/60 transition-all">
                            <div class="h-32 bg-surface-container-high relative overflow-hidden">
                                @if ($similaire->image)
                                    <img src="{{ $similaire->image }}" alt="{{ $similaire->nom }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"/>
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <span class="material-symbols-outlined text-4xl text-primary/40">sports_esports</span>
                                    </div>
                                @endif
                            </div>
                            <div class="p-3">
                                <h3 class="font-semibold text-sm group-hover:text-primary transition-colors truncate">{{ $similaire->nom }}</h3>
                                <span class="text-primary font-bold text-sm">{{ number_format($similaire->prix, 2) }} €</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>

@endsection

@push('scripts')
<script>
    function toggleEditReview(id) {
        document.getElementById('edit-review-' + id).classList.toggle('hidden');
    }

    const stars = document.querySelectorAll('#star-rating label span');
    const inputs = document.querySelectorAll('#star-rating input');
    stars.forEach((star, index) => {
        star.addEventListener('mouseover', () => {
            stars.forEach((s, i) => s.style.color = i <= index ? '#ffaa00' : '#1e1e3f');
        });
        star.addEventListener('mouseout', () => {
            const checked = [...inputs].findIndex(i => i.checked);
            stars.forEach((s, i) => s.style.color = i <= checked ? '#ffaa00' : '#1e1e3f');
        });
        star.parentElement.addEventListener('click', () => {
            stars.forEach((s, i) => s.style.color = i <= index ? '#ffaa00' : '#1e1e3f');
        });
    });
</script>
@endpush
