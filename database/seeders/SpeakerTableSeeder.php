<?php

# database/seeds/QuoteTableSeeder.php
namespace Database\Seeders;

use App\Models\Speaker;  
use Illuminate\Database\Seeder;

class SpeakerTableSeeder extends Seeder  
{
    protected $model = Speaker::class;

    public function run()
    {
        Speaker::factory()
        ->count(50)
        ->create();
    }
}