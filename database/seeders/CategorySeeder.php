<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Fish',
                'slug' => 'fish',
                'description' => 'Fresh fish from Bangladesh',
                'status' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Meat',
                'slug' => 'meat',
                'description' => 'High-quality meat products',
                'status' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Chui Jhal',
                'slug' => 'chui-jhal',
                'description' => 'Spicy chui jhal peppers',
                'status' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Honey',
                'slug' => 'honey',
                'description' => 'Pure raw honey',
                'status' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Rice',
                'slug' => 'rice',
                'description' => 'Premium quality rice',
                'status' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Pulses',
                'slug' => 'pulses',
                'description' => 'Lentils and pulses',
                'status' => true,
                'sort_order' => 6,
            ],
            [
                'name' => 'Vegetables',
                'slug' => 'vegetables',
                'description' => 'Fresh vegetables',
                'status' => true,
                'sort_order' => 7,
            ],
            [
                'name' => 'Fruits',
                'slug' => 'fruits',
                'description' => 'Fresh seasonal fruits',
                'status' => true,
                'sort_order' => 8,
            ],
            [
                'name' => 'Grocery',
                'slug' => 'grocery',
                'description' => 'Daily grocery items',
                'status' => true,
                'sort_order' => 9,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
