<?php

namespace Database\Factories;

use App\Services\ChapterService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chapter>
 */
class ChapterFactory extends Factory
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
            'order' => (new ChapterService)->getNextOrder(),
            'course_id' => CourseFactory::new()->create(),
        ];
    }
}
