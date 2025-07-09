<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['name' => 'Indomie Goreng', 'price' => 3500, 'stock' => 50, 'category_id' => 1], // Makanan
            ['name' => 'Nescafe', 'price' => 8000, 'stock' => 30, 'category_id' => 2], // Minuman
            ['name' => 'Chitato', 'price' => 7500, 'stock' => 40, 'category_id' => 3], // Snack
            ['name' => 'Ultra Milk', 'price' => 5000, 'stock' => 60, 'category_id' => 2],
            ['name' => 'Sari Roti', 'price' => 5000, 'stock' => 25, 'category_id' => 1],
            ['name' => 'Le Mineral', 'price' => 3000, 'stock' => 70, 'category_id' => 2],
            ['name' => 'Oreo', 'price' => 6000, 'stock' => 50, 'category_id' => 3],
        ];

        foreach ($data as $item) {
            Product::create($item);
        }
    }
}
