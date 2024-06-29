<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Presenters\PostPresenter;
use Inertia\Inertia;
use Inertia\Response;

class ShowPostList extends Controller
{
    public function index(): Response
    {
        $posts = Post::with('author')
            ->where('is_published', true)
            ->latest()
            ->paginate();

        return Inertia::render('Home/Home', [
            'posts' => PostPresenter::collection($posts)
                ->preset('list'),
        ]);
    }
}
