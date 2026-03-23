<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['nom' => 'Claviers', 'description' => 'Claviers mécaniques et gaming'],
            ['nom' => 'Souris', 'description' => 'Souris gaming haute précision'],
            ['nom' => 'Casques', 'description' => 'Casques audio gaming'],
            ['nom' => 'Écrans', 'description' => 'Moniteurs gaming haute fréquence'],
            ['nom' => 'Chaises', 'description' => 'Chaises gaming ergonomiques'],
        ];

        foreach ($categories as $categorie) {
            Categorie::create($categorie);
        }
    }
}
