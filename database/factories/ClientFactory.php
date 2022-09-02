<?php

namespace Database\Factories;
 
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

class ClientFactory extends Factory
{
    public function definition()
    {
        return [
            'contact_name' => fake()->name(),
            'email' => fake()->unique()->email(),
            'password' => fake()->password(),
            'organisation' => fake()->company(),
            'address1' => fake()->address(),
            'address2' => fake()->secondaryAddress(),
            'city' => fake()->city(),
            'country' => fake()->country(),
            
        ];
    }
}

