<?php

# database/seeds/QuoteTableSeeder.php

use App\Models\Room;  
use Illuminate\Database\Seeder;

class RoomTableSeeder extends Seeder  
{
    public function run()
    {
        Room::factory(App\Models\Room::class, 50)->create(); 
       
    }
}