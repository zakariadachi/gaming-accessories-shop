<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produit extends Model
{
    use HasFactory;

    protected $table = 'produits';

    protected $fillable = [
        'nom',
        'prix',
        'stock',
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
}
