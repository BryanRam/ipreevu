<?php

# database/seeds/QuoteTableSeeder.php

namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Client;  
class ClientTableSeeder extends Seeder  
{
    protected $model = Client::class;
    
    public function run()
    {
        Client::factory()
        ->count(50)
        ->create();
       
    }
}