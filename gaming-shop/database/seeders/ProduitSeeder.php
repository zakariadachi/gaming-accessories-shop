<?php

namespace Database\Seeders;

use App\Models\Produit;
use Illuminate\Database\Seeder;

class ProduitSeeder extends Seeder
{
    public function run(): void
    {
        $produits = [
            // Claviers (categorie_id: 1)
            [
                'nom' => 'Razer BlackWidow V4', 'prix' => 149.99, 'stock' => 25, 'categorie_id' => 1,
                'image' => 'https://images.unsplash.com/photo-1618384887929-16ec33fab9ef?w=500&h=500&fit=crop&q=90',
            ],
            [
                'nom' => 'Corsair K100 RGB', 'prix' => 229.99, 'stock' => 15, 'categorie_id' => 1,
                'image' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=500&h=500&fit=crop&q=90',
            ],
            [
                'nom' => 'SteelSeries Apex Pro', 'prix' => 189.99, 'stock' => 20, 'categorie_id' => 1,
                'image' => 'https://images.unsplash.com/photo-1541140532154-b024d705b90a?w=500&h=500&fit=crop&q=90',
            ],
            [
                'nom' => 'Logitech G915 TKL', 'prix' => 199.99, 'stock' => 0, 'categorie_id' => 1,
                'image' => 'https://images.unsplash.com/photo-1561112078-7d24e04c3407?w=500&h=500&fit=crop&q=90',
            ],

            // Souris (categorie_id: 2)
            [
                'nom' => 'Razer DeathAdder V3', 'prix' => 79.99, 'stock' => 40, 'categorie_id' => 2,
                'image' => 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=500&h=500&fit=crop&q=90',
            ],
            [
                'nom' => 'Logitech G Pro X Superlight', 'prix' => 159.99, 'stock' => 30, 'categorie_id' => 2,
                'image' => 'https://images.unsplash.com/photo-1615663245857-ac93bb7c39e7?w=500&h=500&fit=crop&q=90',
            ],
            [
                'nom' => 'SteelSeries Rival 650', 'prix' => 99.99, 'stock' => 18, 'categorie_id' => 2,
                'image' => 'https://images.unsplash.com/photo-1629429408209-1f912961dbd8?w=500&h=500&fit=crop&q=90',
            ],
            [
                'nom' => 'Corsair Scimitar Elite', 'prix' => 89.99, 'stock' => 0, 'categorie_id' => 2,
                'image' => 'https://images.unsplash.com/photo-1586349906319-47f4e28a5f2c?w=500&h=500&fit=crop&q=90',
            ],

            // Casques (categorie_id: 3)
            [
                'nom' => 'HyperX Cloud Alpha', 'prix' => 99.99, 'stock' => 35, 'categorie_id' => 3,
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500&h=500&fit=crop&q=90',
            ],
            [
                'nom' => 'SteelSeries Arctis Nova Pro', 'prix' => 349.99, 'stock' => 10, 'categorie_id' => 3,
                'image' => 'https://images.unsplash.com/photo-1583394838336-acd977736f90?w=500&h=500&fit=crop&q=90',
            ],
            [
                'nom' => 'Razer BlackShark V2', 'prix' => 99.99, 'stock' => 22, 'categorie_id' => 3,
                'image' => 'https://images.unsplash.com/photo-1546435770-a3e426bf472b?w=500&h=500&fit=crop&q=90',
            ],
            [
                'nom' => 'Corsair HS80 RGB', 'prix' => 129.99, 'stock' => 0, 'categorie_id' => 3,
                'image' => 'https://images.unsplash.com/photo-1484704849700-f032a568e944?w=500&h=500&fit=crop&q=90',
            ],

            // Écrans (categorie_id: 4)
            [
                'nom' => 'ASUS ROG Swift 360Hz', 'prix' => 699.99, 'stock' => 8, 'categorie_id' => 4,
                'image' => 'https://images.unsplash.com/photo-1616763355548-1b606f439f86?w=500&h=500&fit=crop&q=90',
            ],
            [
                'nom' => 'LG UltraGear 27GP950', 'prix' => 799.99, 'stock' => 5, 'categorie_id' => 4,
                'image' => 'https://images.unsplash.com/photo-1585792180666-f7347c490ee2?w=500&h=500&fit=crop&q=90',
            ],
            [
                'nom' => 'Samsung Odyssey G7', 'prix' => 549.99, 'stock' => 12, 'categorie_id' => 4,
                'image' => 'https://images.unsplash.com/photo-1606318801954-d46d46d3360a?w=500&h=500&fit=crop&q=90',
            ],

            // Chaises (categorie_id: 5)
            [
                'nom' => 'Secretlab Titan Evo', 'prix' => 449.99, 'stock' => 7, 'categorie_id' => 5,
                'image' => 'https://images.unsplash.com/photo-1598300042247-d088f8ab3a91?w=500&h=500&fit=crop&q=90',
            ],
            [
                'nom' => 'DXRacer Formula Series', 'prix' => 299.99, 'stock' => 14, 'categorie_id' => 5,
                'image' => 'https://images.unsplash.com/photo-1603302576837-37561b2e2302?w=500&h=500&fit=crop&q=90',
            ],
            [
                'nom' => 'Herman Miller Embody', 'prix' => 1799.99, 'stock' => 3, 'categorie_id' => 5,
                'image' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=500&h=500&fit=crop&q=90',
            ],
        ];

        foreach ($produits as $produit) {
            Produit::create($produit);
        }
    }
}
