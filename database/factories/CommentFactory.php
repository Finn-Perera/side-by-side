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
        return [
            'author_id'=> User::inRandomOrder()->first()->id,
            'article_id' => Article::inRandomOrder()->first()->id,
            'parent_id' => null,
            'content' => $this->faker->sentence(),
            'edited' => $isEdited,
            'original_content' => $isEdited ? $this->faker->sentence() : null,
        ];
    }

    /**
     * Defines a state for a child comment.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function child(): CommentFactory 
    {
        return $this->state(function (array $attributes): array {
            // If parents weren't created first a check would be needed here
            $parent = Comment::inRandomOrder()->first();


            $isEdited = $this->faker->boolean(chanceOfGettingTrue: 20);

            return [
                'author_id'=> User::inRandomOrder()->first()->id,
                'article_id' => $parent->article_id,
                'parent_id' => $parent->id,
                'content' => $this->faker->sentence(),
                'edited' => $isEdited,
                'original_content' => $isEdited ? $this->faker->sentence() : null,
            ];
        });
    }
}