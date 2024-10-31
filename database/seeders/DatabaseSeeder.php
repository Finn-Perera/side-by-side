<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use App\Models\Topic;
use App\Models\Comment;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();

        $topics = Topic::factory(4)->recycle($users)->create();

        $articles = Article::factory(7)->recycle($users)->recycle($topics)->create();

        Comment::factory(15)->recycle($users)->recycle($articles)->create();
    }
}
