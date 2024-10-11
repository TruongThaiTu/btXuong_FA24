<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Passport>
 */
class PassportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::factory(), // Tạo Student ngẫu nhiên
            'passport_number' => fake()->unique()->numberBetween(100000000, 999999999), // Số hộ chiếu giả
            'issued_date' => fake()->date(),
            'expiry_date' => fake()->date('Y-m-d', '+10 years'),
        ];
    }
}
