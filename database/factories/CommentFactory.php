<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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

        $id = Post::first()->user_id;
        return [
            "user_id" => $id,
            "photo" => $this->faker->image,
            "captcha" => $this->faker->word(),
            "text" => $this->faker->text(),
        ];
    }
}
