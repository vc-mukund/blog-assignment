<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $users = User::all()->except(1);
        foreach ($users as $user) {
            $user->assignRole('editor');
        }
        return [
            'user_id' => $users->random()->id,
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(),
            'image' => $this->faker->imageUrl(640, 480),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
