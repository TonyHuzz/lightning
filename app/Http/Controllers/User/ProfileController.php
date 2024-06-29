<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Presenters\PostPresenter;
use App\Presenters\UserPresenter;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    public function index(User $user): Response
    {
        $user->loadCount('publishedPosts', 'likedPosts');

        return Inertia::render('User/Profile', [
            'type' => 'show',
            'user' => UserPresenter::make($user)->with(static fn (User $user) => [
                'posts' => PostPresenter::collection(
                    $user->posts()
                        ->with('author')
                        ->where('is_published', true)
                        ->latest()
                        ->paginate(),
                )->preset('list'),
                'postsCount' => $user->published_posts_count,
                'likesCount' => $user->liked_posts_count,
            ]),
        ]);
    }

    public function likes(User $user): Response
    {
        $user->loadCount('publishedPosts', 'likedPosts');

        return Inertia::render('User/Profile', [
            'type' => 'likes',
            'user' => UserPresenter::make($user)->with(static fn (User $user) => [
                'posts' => PostPresenter::collection(
                    $user->likedPosts()
                        ->with('author')
                        ->latest()
                        ->paginate(),
                )->preset('list'),
                'postsCount' => $user->published_posts_count,
                'likesCount' => $user->liked_posts_count,
            ]),
        ]);
    }
}
