<?php

namespace Database\Seeders;

use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CommandeSeeder extends Seeder
{
    public function run(): void
    {
        // Créer un admin
        $admin = User::create([
            'nom'      => 'Admin GearHub',
            'email'    => 'admin@gearhub.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Créer 3 clients avec commandes
        $clients = [
            ['nom' => 'Alex Gaming',   'email' => 'alex@test.com'],
            ['nom' => 'Sarah Pro',     'email' => 'sarah@test.com'],
            ['nom' => 'Neon Player',   'email' => 'neon@test.com'],
        ];

        $produits = Produit::all();

        foreach ($clients as $clientData) {
            $client = User::create([
                'nom'      => $clientData['nom'],
                'email'    => $clientData['email'],
                'password' => Hash::make('password'),
                'role'     => 'client',
            ]);

            // Créer 2 commandes par client
            foreach (['en_attente', 'confirmée'] as $statut) {
                $commande = Commande::create([
                    'user_id' => $client->id,
                    'date'    => now()->subDays(rand(1, 30)),
                    'statut'  => $statut,
                ]);

                // Ajouter 2 produits aléatoires
                $produitsChoisis = $produits->random(2);
                foreach ($produitsChoisis as $produit) {
                    LigneCommande::create([
                        'commande_id' => $commande->id,
                        'produit_id'  => $produit->id,
                        'quantity'    => rand(1, 3),
                    ]);
                }
            }
        }
    }
}
