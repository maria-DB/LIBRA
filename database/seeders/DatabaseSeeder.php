<?php

namespace Database\Seeders;

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
        \App\Models\User::factory(10)->create();
        \App\Models\Books::factory(10)->create();
        \App\Models\Review::factory(10)->create();
        \App\Models\Comment::factory(10)->create();
        \App\Models\Rating::factory(10)->create();
        \App\Models\Bookshelf::factory(10)->create();
    }
}
