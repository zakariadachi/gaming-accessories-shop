<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Commande extends Model
{
    use HasFactory;

    protected $table = 'commandes';

    protected $fillable = [
        'date',
        'statut',
        'user_id',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    const STATUTS = ['en_attente', 'confirmée', 'annulée'];

    public function total(): float
    {
        return $this->ligneCommandes->sum(fn($l) => $l->produit->prix * $l->quantity);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ligneCommandes(): HasMany
    {
        return $this->hasMany(LigneCommande::class, 'commande_id');
    }
}
