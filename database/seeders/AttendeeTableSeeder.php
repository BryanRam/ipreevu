<?php

# database/seeds/QuoteTableSeeder.php
namespace Database\Seeders;

use App\Models\Attendee;  
use Illuminate\Database\Seeder;

class AttendeeTableSeeder extends Seeder  
{
    protected $model = Attendee::class;

    public function run()
    {
        Attendee::factory()
        ->count(50)
        ->create();
    }
}