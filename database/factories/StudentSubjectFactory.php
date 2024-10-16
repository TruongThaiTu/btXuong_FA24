<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentSubject>
 */
class StudentSubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => 1,  // Đảm bảo bạn truyền giá trị cho student_id
            'subject_id' => 1,  // Đảm bảo bạn truyền giá trị cho student_id
        ];
    }
}
