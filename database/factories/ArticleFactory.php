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
        $isEdited = $this->faker->boolean(chanceOfGettingTrue: 50);
        return [
            'topic_id' => Topic::inRandomOrder()->first()->id,
            'author_id'=> User::inRandomOrder()->first()->id,
            'title' => $this->faker->words(nb: 3, asText: true),
            'content' => $this->faker->paragraph(),
            'edited' => $isEdited,
            'original_content' => $isEdited ? $this->faker->paragraph() : null,
        ];
    }
}