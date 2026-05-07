<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Commande extends Model
{
    use HasFactory;

    protected $table = 'commandes';

    protected $fillable = [
        'user_id',
        'statut',
        'date',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'date'       => 'date',
    ];

    const STATUTS = ['en_attente', 'confirmée', 'annulée'];

    public function getTotalAttribute(): float
    {
        return $this->ligneCommandes->sum(function($ligne) {
            return $ligne->quantity * $ligne->prix_unitaire;
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ligneCommandes(): HasMany
    {
        return $this->hasMany(LigneCommande::class, 'commande_id');
    }

    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class);
    }
}
