<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nom',
        'email',
        'password',
        'role',
        'is_banned',
        'points',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'is_banned'         => 'boolean',
        ];
    }


    public function commandes(): HasMany
    {
        return $this->hasMany(Commande::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function niveauFidelite(): array
    {
        return match(true) {
            $this->points >= 1000 => ['label' => 'Gold',   'color' => '#ffaa00', 'icon' => 'emoji_events'],
            $this->points >= 500  => ['label' => 'Silver', 'color' => '#c0c0c0', 'icon' => 'military_tech'],
            default               => ['label' => 'Bronze', 'color' => '#cd7f32', 'icon' => 'workspace_premium'],
        };
    }
}
