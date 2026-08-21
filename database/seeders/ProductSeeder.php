<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Create sample products
        $products = [
            [
                'name' => 'Fresh Hilsa Fish',
                'slug' => 'fresh-hilsa-fish',
                'sku' => 'FISH-001',
                'category_id' => 1,
                'brand' => 'Polli Farm',
                'short_description' => 'Fresh Hilsa fish from Bangladesh rivers',
                'description' => 'Fresh hilsa fish sourced directly from Bangladesh rivers. High in omega-3 fatty acids.',
                'price' => 850,
                'sale_price' => 750,
                'cost_price' => 400,
                'stock' => 100,
                'unit' => 'kg',
                'weight' => 1000,
                'featured' => true,
                'best_seller' => true,
                'status' => true,
            ],
            [
                'name' => 'Grass Fed Beef',
                'slug' => 'grass-fed-beef',
                'sku' => 'MEAT-001',
                'category_id' => 2,
                'brand' => 'Polli Farm',
                'short_description' => 'Premium grass-fed beef',
                'description' => 'High-quality grass-fed beef from local farms',
                'price' => 1200,
                'sale_price' => 1000,
                'cost_price' => 600,
                'stock' => 50,
                'unit' => 'kg',
                'weight' => 1000,
                'featured' => true,
                'best_seller' => true,
                'status' => true,
            ],
            [
                'name' => 'Raw Honey',
                'slug' => 'raw-honey',
                'sku' => 'HONEY-001',
                'category_id' => 4,
                'brand' => 'Polli Farm',
                'short_description' => 'Pure raw honey',
                'description' => 'Unpasteurized raw honey from rural Bangladesh',
                'price' => 500,
                'sale_price' => 450,
                'cost_price' => 250,
                'stock' => 200,
                'unit' => 'liter',
                'weight' => 1400,
                'featured' => true,
                'new_product' => true,
                'status' => true,
            ],
            [
                'name' => 'Jasmine Rice',
                'slug' => 'jasmine-rice',
                'sku' => 'RICE-001',
                'category_id' => 5,
                'brand' => 'Polli Farm',
                'short_description' => 'Premium jasmine rice',
                'description' => 'High-quality jasmine rice from Bangladesh',
                'price' => 120,
                'sale_price' => 100,
                'cost_price' => 50,
                'stock' => 500,
                'unit' => 'kg',
                'weight' => 1000,
                'featured' => false,
                'best_seller' => true,
                'status' => true,
            ],
            [
                'name' => 'Red Lentils',
                'slug' => 'red-lentils',
                'sku' => 'PULSE-001',
                'category_id' => 6,
                'brand' => 'Polli Farm',
                'short_description' => 'Red lentils (Masur)',
                'description' => 'Premium quality red lentils',
                'price' => 180,
                'sale_price' => 150,
                'cost_price' => 80,
                'stock' => 300,
                'unit' => 'kg',
                'weight' => 1000,
                'featured' => false,
                'best_seller' => true,
                'status' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
