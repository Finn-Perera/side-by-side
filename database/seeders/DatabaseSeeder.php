<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use App\Models\Topic;
use App\Models\Comment;
use App\Models\Profile;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create users
        $users = User::factory(30)->has(Profile::factory())->create();
        $user = new User;
        $user->name = 'example admin';
        $user->email = 'name@example.com';
        $user->password = Hash::make('password1');
        $user->remember_token = Str::random(10);
        $user->role = 'admin';
        $user->save();

        // Create topics
        $topics = Topic::factory(12)->create();

        // Create articles
        $articles = Article::factory(20)->create();

        // Create root comments (no parent)
        Comment::factory(50)->create();

        // Child comments
        Comment::factory()->count(20)->child()->create();
        // Can create more deep comment chain with more calls
        Comment::factory()->count(15)->child()->create();
    }
}
