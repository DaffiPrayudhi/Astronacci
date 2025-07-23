<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
    {
        \App\Models\Article::factory(20)->create();
        \App\Models\Video::factory(20)->create();
    }
}
