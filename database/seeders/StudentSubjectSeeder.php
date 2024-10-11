<?php

namespace Database\Seeders;

use App\Models\StudentSubject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StudentSubject::factory()->count(10)->create();
    }
}
