<?php

namespace Database\Seeders;

use App\Models\Passport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PassportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Passport::factory()->count(10)->create();
    }
}
