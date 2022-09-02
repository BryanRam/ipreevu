<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call('ClientTableSeeder');
        $this->call('ConferenceTableSeeder');
        $this->call('RoomTableSeeder');
        $this->call('PresentationTableSeeder');
        $this->call('SpeakerTableSeeder');
	    $this->call('CategoryTableSeeder');
        $this->call('AttendeeTableSeeder');
    }
}
