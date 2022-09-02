<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

//use App\Models\Conference;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
// use ClientTableSeeder;
// use AttendeeTableSeeder;
// use CategoryTableSeeder;
// use ConferenceTableSeeder;
// use PresentationTableSeeder;
// use RoomTableSeeder;
// use SpeakerTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([ClientTableSeeder::class,
                     ConferenceTableSeeder::class,
                     RoomTableSeeder::class,
                     PresentationTableSeeder::class,
                     SpeakerTableSeeder::class,
                     CategoryTableSeeder::class,
                     AttendeeTableSeeder::class]);
    }
}
