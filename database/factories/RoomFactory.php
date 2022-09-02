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

class RoomFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => fake()->city,
            'conference_id' => fake()->numberBetween($min=1, $max=20),
            
        ];
    }
}