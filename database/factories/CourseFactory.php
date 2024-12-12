<?php

namespace Database\Factories;

use App\Services\CourseService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
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
            'order' => (new CourseService)->getNextOrder(),
        ];
    }
}
