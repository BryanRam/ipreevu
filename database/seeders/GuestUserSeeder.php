<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GuestUserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'guest@ipreevu.com'],
            ['name' => 'Guest', 'password' => Hash::make(env('GUEST_PASSWORD', 'guest1234'))]
        );
    }
}
