<?php

namespace Database\Factories;

use App\Models\Dataset;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dataset>
 */
class DatasetFactory extends Factory
{
    protected $model = Dataset::class;

    public function definition()
    {
        $faker = \Faker\Factory::create();

        return [
            'category' => $faker->randomElement(['Category 1', 'Category 2', 'Category 3']),
            'firstname' => $faker->firstName,
            'lastname' => $faker->lastName,
            'email' => $faker->email,
            'gender' => $faker->randomElement(['Male', 'Female']),
            'birthDate' => $faker->date('Y-m-d'),
        ];
    }
}
