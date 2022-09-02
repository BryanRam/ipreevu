<?php

# database/seeds/QuoteTableSeeder.php
namespace Database\Seeders;

use App\Models\Room;  
use Illuminate\Database\Seeder;

class RoomTableSeeder extends Seeder  
{
    protected $model = Room::class;

    public function run()
    {
        Room::factory()
        ->count(50)
        ->create();
    }
}