<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $name = fake()->word();
        
        return [
            'name' => $name,
            'slug' => str($name)->slug(),
            'description' => fake()->sentence(),
            'image' => null,
            'icon' => null,
            'parent_id' => null,
            'sort_order' => fake()->numberBetween(1, 100),
            'status' => true,
            'seo_title' => $name,
            'seo_description' => fake()->sentence(),
            'seo_keywords' => fake()->words(3, true),
        ];
    }
}
