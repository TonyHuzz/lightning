<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(10),
            'content' => $this->faker->sentence(100),
            'visits' => $this->faker->numberBetween(10, 1000),
            'is_published' => $this->faker->boolean(80),
        ];
    }
}
