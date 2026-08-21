<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = fake()->word() . ' ' . fake()->word();
        
        return [
            'name' => $name,
            'slug' => str($name)->slug(),
            'sku' => strtoupper(fake()->unique()->lexify('SKU-??????')),
            'category_id' => 1,
            'brand' => fake()->company(),
            'short_description' => fake()->sentence(),
            'description' => fake()->paragraphs(3, true),
            'price' => fake()->numberBetween(100, 5000),
            'sale_price' => fake()->numberBetween(50, 4500),
            'cost_price' => fake()->numberBetween(30, 2000),
            'stock' => fake()->numberBetween(10, 1000),
            'low_stock_threshold' => 10,
            'unit' => fake()->randomElement(['kg', 'gram', 'liter', 'piece', 'pack']),
            'weight' => fake()->numberBetween(100, 5000),
            'featured' => fake()->boolean(30),
            'best_seller' => fake()->boolean(20),
            'new_product' => fake()->boolean(40),
            'flash_sale' => fake()->boolean(10),
            'status' => true,
            'seo_title' => $name,
            'seo_description' => fake()->sentence(),
            'seo_keywords' => fake()->words(5, true),
        ];
    }
}
