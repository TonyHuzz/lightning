<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::factory()->count(40)->make()->each(function ($post) {
            $user = User::inRandomOrder()->first();
            $user->posts()->save($post);
        });
    }
}
