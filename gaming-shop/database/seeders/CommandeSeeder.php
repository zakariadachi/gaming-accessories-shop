<?php

namespace Database\Seeders;

use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\Produit;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CommandeSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nom'      => 'Admin GearHub',
            'email'    => 'admin@gearhub.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        $clients = [
            ['nom' => 'Alex Gaming',    'email' => 'alex@test.com'],
            ['nom' => 'Sarah Pro',      'email' => 'sarah@test.com'],
            ['nom' => 'Neon Player',    'email' => 'neon@test.com'],
            ['nom' => 'Lucas Stream',   'email' => 'lucas@test.com'],
            ['nom' => 'Emma Setup',     'email' => 'emma@test.com'],
            ['nom' => 'Karim FPS',      'email' => 'karim@test.com'],
            ['nom' => 'Sofia RGB',      'email' => 'sofia@test.com'],
            ['nom' => 'Yassine Pro',    'email' => 'yassine@test.com'],
        ];

        $produits = Produit::all();

        $statuts = ['en_attente', 'confirmée', 'confirmée', 'confirmée', 'annulée'];

        foreach ($clients as $clientData) {
            $client = User::create([
                'nom'      => $clientData['nom'],
                'email'    => $clientData['email'],
                'password' => Hash::make('password'),
                'role'     => 'client',
                'points'   => rand(0, 800),
            ]);

            $nbCommandes = rand(3, 6);
            for ($i = 0; $i < $nbCommandes; $i++) {
                $statut   = $statuts[array_rand($statuts)];
                $commande = Commande::create([
                    'user_id' => $client->id,
                    'date'    => now()->subDays(rand(1, 180))->format('Y-m-d'),
                    'statut'  => $statut,
                ]);

                $produitsChoisis = $produits->where('stock', '>', 0)->random(rand(1, 3));
                $total = 0;

                foreach ($produitsChoisis as $produit) {
                    $quantity = rand(1, 3);
                    $total   += $produit->prix * $quantity;

                    LigneCommande::create([
                        'commande_id'   => $commande->id,
                        'produit_id'    => $produit->id,
                        'quantity'      => $quantity,
                        'prix_unitaire' => $produit->prix,
                    ]);
                }

                if (in_array($statut, ['confirmée', 'livrée'])) {
                    Transaction::create([
                        'user_id'           => $client->id,
                        'commande_id'       => $commande->id,
                        'amount'            => round($total, 2),
                        'status'            => 'paid',
                        'stripe_session_id' => 'cs_test_seed_' . $commande->id . '_' . uniqid(),
                    ]);

                    $client->increment('points', (int) floor($total));
                }
            }
        }
    }
}
