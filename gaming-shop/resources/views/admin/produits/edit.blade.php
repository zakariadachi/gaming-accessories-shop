@extends('layouts.admin')

@section('title', 'Modifier ' . $produit->nom . ' - Admin')
@section('page-title', 'Modifier le Produit')

@section('content')

    <div class="max-w-2xl">
        <a href="{{ route('admin.produits.index') }}" class="flex items-center gap-1 text-on-surface-variant hover:text-white text-sm mb-6 transition-colors w-fit">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            Retour à la liste
        </a>

        <div class="bg-surface-container rounded-xl p-8">
            @if($errors->any())
                <div class="mb-6 bg-error/10 border border-error/30 rounded-xl px-4 py-3">
                    @foreach($errors->all() as $error)
                        <p class="text-error text-sm">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('admin.produits.update', $produit) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')
                @include('admin.produits._form')
                <button type="submit" class="w-full py-3.5 bg-primary hover:brightness-110 text-white font-bold rounded-xl transition-all">
                    Mettre à jour
                </button>
            </form>
        </div>
    </div>

@endsection
