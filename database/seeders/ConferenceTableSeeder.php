<?php

# database/seeds/QuoteTableSeeder.php
namespace Database\Seeders;

use App\Models\Conference;
// use App\Models\Presentation;
// use App\Models\Speaker;
// use App\Models\Client;
// use App\Models\Room;
use Illuminate\Database\Seeder;

class ConferenceTableSeeder extends Seeder  
{
    protected $model = Conference::class;

    public function run()
    { 
        Conference::factory()
        ->count(50)
        ->create();
    }
}