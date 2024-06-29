<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Presenters\PostPresenter;
use Inertia\Inertia;
use Inertia\Response;

class ShowPostController extends Controller
{
    public function __invoke(Post $post): Response
    {
        // 驗證權限
        $this->authorize('view', $post);

        $this->incrementVisits($post);

        $post->load(['author' => fn ($query) => $query->withCount('publishedPosts', 'likedPosts')]);

        return Inertia::render('Post/Show', [
            'post' => PostPresenter::make($post)->preset('show'),
        ]);
    }

    private function incrementVisits(Post $post): void
    {
        if (auth()?->user()?->can('view', $post) && !session("posts:visited:{$post->id}")) {
            $post->increment('visits');
            session()->put("posts:visited:{$post->id}", true);
        }
    }
}
