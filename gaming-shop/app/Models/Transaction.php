<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'commande_id',
        'user_id',
        'stripe_session_id',
        'montant',
        'reduction',
        'montant_final',
        'devise',
        'statut',
        'points_utilises',
        'points_gagnes',
    ];

    protected $casts = [
        'montant'        => 'float',
        'reduction'      => 'float',
        'montant_final'  => 'float',
    ];

    public function commande(): BelongsTo
    {
        return $this->belongsTo(Commande::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
