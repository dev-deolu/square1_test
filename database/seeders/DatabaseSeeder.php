<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
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
        // Truncate Tables
        User::truncate();
        Post::truncate();
        
        // Run factory
        User::factory(10)->create();
        Post::factory(100)->create();
    }
}
