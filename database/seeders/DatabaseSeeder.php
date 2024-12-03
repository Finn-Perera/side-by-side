<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use App\Models\Topic;
use App\Models\Comment;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create users
        $users = User::factory(20)->create();

        // Create topics
        $topics = Topic::factory(6)->create();

        // Create articles
        $articles = Article::factory(8)->create();

        // Create root comments (no parent)
        Comment::factory(14)->create();

        // Child comments
        Comment::factory()->count(6)->child()->create();
        // Can create more deep comment chain with more calls
        Comment::factory()->count(6)->child()->create();
    }
}
