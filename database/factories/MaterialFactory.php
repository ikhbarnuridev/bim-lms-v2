<?php

namespace Database\Factories;

use App\Services\MaterialService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Material>
 */
class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title(),
            'slug' => $this->faker->slug(),
            'content' => $this->faker->paragraph(),
            'order' => (new MaterialService)->getNextOrder(),
            'chapter_id' => ChapterFactory::new()->create(),
        ];
    }
}