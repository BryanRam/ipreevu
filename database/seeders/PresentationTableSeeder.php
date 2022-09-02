<?php

# database/seeds/QuoteTableSeeder.php
namespace Database\Seeders;

use App\Models\Presentation;  
use Illuminate\Database\Seeder;

class PresentationTableSeeder extends Seeder  
{
    protected $model = Presentation::class;

    public function run()
    {
        Presentation::factory()
        ->count(50)
        ->create();
    }
}