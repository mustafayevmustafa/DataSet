<?php

namespace Database\Seeders;

use App\Models\Dataset;
use Illuminate\Database\Seeder;

class DatasetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dataset::create([
            'category' => 'Test Category',
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'johndoe@example.com',
            'gender' => 'Male',
            'birthDate' => '1990-01-01',
        ]);
    }
}
