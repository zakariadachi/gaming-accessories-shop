<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $clients = User::where('role', 'client')->get();

        $avis = [
            ['note' => 5, 'commentaire' => 'Produit exceptionnel ! Qualité au top, je recommande vivement.'],
            ['note' => 4, 'commentaire' => 'Très bon produit, livraison rapide. Quelques petits défauts mineurs.'],
            ['note' => 5, 'commentaire' => 'Parfait pour le gaming, réactivité incroyable !'],
            ['note' => 3, 'commentaire' => 'Correct pour le prix, mais j\'attendais mieux.'],
            ['note' => 5, 'commentaire' => 'Meilleur achat de l\'année, je suis fan !'],
            ['note' => 4, 'commentaire' => 'Très satisfait, bon rapport qualité/prix.'],
            ['note' => 2, 'commentaire' => 'Déçu par la qualité des matériaux, pas à la hauteur.'],
            ['note' => 5, 'commentaire' => 'Excellent ! Exactement ce que je cherchais.'],
            ['note' => 4, 'commentaire' => 'Bonne prise en main, confortable pour de longues sessions.'],
            ['note' => 5, 'commentaire' => 'Top qualité, design magnifique, je suis ravi !'],
            ['note' => 3, 'commentaire' => 'Produit moyen, rien d\'exceptionnel mais fait le job.'],
            ['note' => 5, 'commentaire' => 'Incroyable ! Dépasse toutes mes attentes.'],
            ['note' => 4, 'commentaire' => 'Très bonne qualité, je recommande à tous les gamers.'],
            ['note' => 1, 'commentaire' => 'Très déçu, le produit ne correspond pas à la description.'],
            ['note' => 5, 'commentaire' => 'Parfait, rien à redire. Achat les yeux fermés !'],
        ];

        foreach ($avis as $i => $a) {
            Review::firstOrCreate(
                [
                    'produit_id' => 2,
                    'user_id'    => $clients[$i % $clients->count()]->id,
                ],
                [
                    'note'        => $a['note'],
                    'commentaire' => $a['commentaire'],
                ]
            );
        }
    }
}
