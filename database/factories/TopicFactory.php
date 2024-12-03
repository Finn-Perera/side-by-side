<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Topic>
 */
class TopicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'author_id'=> User::inRandomOrder()->first()->id,
            'title' => $this->faker->words(nb: 3, asText: true),
            'content' => $this->faker->paragraph(),
            'date' => $this->faker->dateTimeBetween(startDate: '-30 years', endDate: 'now'),
        ];
    }
}
