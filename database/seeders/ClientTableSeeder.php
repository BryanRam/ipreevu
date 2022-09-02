<?php

# database/seeds/QuoteTableSeeder.php

use App\Models\Client;  
use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder  
{
    public function run()
    {
        
        Client::factory(App\Models\Client::class, 50)->create(); 
       
    }
}