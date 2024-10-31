<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\Comment;
use App\Models\Article;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isEdited = $this->faker->boolean(20);
        $article = Article::factory()->create();
        return [
            'author_id' => User::factory(),
            'article_id' => $article->id,
            'parent_id' => $this->faker->boolean(20) ? Comment::factory()->for($article)->create()->id : null,
            'content' => $this->faker->sentence(),
            'edited' => $isEdited,
            'original_content' => $isEdited ? $this->faker->sentence() : null,
        ];
    }
}