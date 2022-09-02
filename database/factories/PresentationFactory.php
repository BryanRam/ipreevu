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
class PresentationFactory extends Factory
{
    public function definition()
    {
        return [
            'room_id' => fake()->numberBetween($min=1, $max=20),
            'conference_id' => fake()->numberBetween($min=1, $max=20),
            'title' => fake()->catchPhrase(),
            'start_time' => fake()->dateTime(),
            'end_time' => fake()->dateTime(),
            'abstract' => fake()->sentence($nbWords=30),
            'keywords' => fake()->sentence($nbWords=10),
                    
        ];
    }
}