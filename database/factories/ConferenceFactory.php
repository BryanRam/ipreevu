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
class ConferenceFactory extends Factory
{
    public function definition()
    {
        return [
            'client_id' => fake()->numberBetween($min=1, $max=20),
            'name' => fake()->name,
            'type' => 'public',
            'description' => fake()->sentence($nbWords=10),
            'address1' => fake()->address(),
            'address2' => fake()->secondaryAddress(),
            'city' => fake()->city(),
            'country' => fake()->country(),
            'start_time' => fake()->dateTime(),
            'end_time' => fake()->dateTime(),
        ];
    }
}