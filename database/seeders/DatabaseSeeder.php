<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Photo;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Article::factory()->count(30)->create();
        // Photo::factory()->count(30)->create();
        Comment::factory()->count(100)->create();

        User::factory()->create([
            "name" => "Alice",
            "email" => "alice@gmail.com",
        ]);

        User::factory()->create([
            "name" => "Bob",
            "email" => "bob@gmail.com",
        ]);
    }
}
