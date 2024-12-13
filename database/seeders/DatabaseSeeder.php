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

        $profile = new Profile;
        $profile->user_id = 31;
        $profile->bio = 'Example bio';
        $profile->location = 'Swansea, United Kingdom';
        $profile->save();


        $user = new User;
        $user->name = 'example trusted';
        $user->email = 'name2@example.com';
        $user->password = Hash::make('password1');
        $user->remember_token = Str::random(10);
        $user->role = 'trusted';
        $user->save();

        $profile = new Profile;
        $profile->user_id = 32;
        $profile->bio = 'Example bio';
        $profile->location = 'Swansea, United Kingdom';
        $profile->save();

        // Create topics
        $topics = Topic::factory(28)->create();

        // Create articles
        $articles = Article::factory(48)->create();

        // Create root comments (no parent)
        Comment::factory(100)->create();

        // Child comments
        Comment::factory()->count(50)->child()->create();
        // Can create more deep comment chain with more calls
        Comment::factory()->count(40)->child()->create();
    }
}
