<?php

namespace Database\Factories;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\Subject;
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
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'classroom_id' => Classroom::factory(), // Tạo Classroom ngẫu nhiên
        ];
    }

        public function configure()
    {
        return $this->afterCreating(function (Student $student) {
            $subjects = Subject::factory()->count(3)->create(); // Tạo 3 môn học ngẫu nhiên
            $student->subjects()->attach($subjects->pluck('id')); // Gán sinh viên với các môn học
        });
    }
}
