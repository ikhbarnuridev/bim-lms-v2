<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nis' => $this->faker->unique()->randomNumber(9),
            'user_id' => UserFactory::new()->create(),
        ];
    }

    public function configure()
    {
        return parent::configure()
            ->afterCreating(function (Student $student) {
                $student->user->assignRole('student');
            });
    }
}
