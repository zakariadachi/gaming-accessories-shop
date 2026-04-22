<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Produit extends Model
{
    use HasFactory;

    protected $table = 'produits';

    protected $fillable = [
        'nom',
        'prix',
        'stock',
        'image',
        'categorie_id',
    ];

    protected $casts = [
        'prix' => 'float',
    ];

    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

    public function ligneCommandes(): HasMany
    {
        return $this->hasMany(LigneCommande::class, 'produit_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'produit_id');
    }

    public function moyenneNotes(): float
    {
        return round($this->reviews()->avg('note') ?? 0, 1);
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) return null;
        if (str_starts_with($this->image, 'http')) return $this->image;
        return Storage::url($this->image);
    }

    public function getImageAttribute($value): ?string
    {
        if (!$value) return null;
        if (str_starts_with($value, 'http')) return $value;
        return Storage::url($value);
    }
}
