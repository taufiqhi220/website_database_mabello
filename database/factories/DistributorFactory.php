<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DistributorFactory extends Factory
{
    protected $model = \App\Models\Distributor::class;

    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'username' => $this->faker->unique()->userName(),
            'password' => bcrypt('password'), // Default password
        ];
    }
}
