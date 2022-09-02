<?php

# database/seeds/QuoteTableSeeder.php
namespace Database\Seeders;

use App\Models\Category;  
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder  
{
    protected $model = Category::class;

    public function run()
    {
        Category::factory()
        ->count(50)
        ->create();
    }
}