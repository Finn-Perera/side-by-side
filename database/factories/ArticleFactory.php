<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Topic;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isEdited = $this->faker->boolean(50);
        return [
            'topic_id' => Topic::factory(),
            'author_id'=> User::factory(),
            'title' => $this->faker->words(3, true),
            'content' => $this->faker->paragraph(),
            'edited' => $isEdited,
            'original_content' => $isEdited ? $this->faker->paragraph() : null,
        ];
    }
}