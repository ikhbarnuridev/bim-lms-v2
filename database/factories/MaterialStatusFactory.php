<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaterialStatus>
 */
class MaterialStatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'is_done' => $this->faker->boolean(),
            'student_id' => StudentFactory::new()->create(),
            'material_id' => MaterialFactory::new()->create(),
        ];
    }
}
