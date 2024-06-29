<?php

namespace App\Http\Controllers\Post;

use AdditionApps\FlexiblePresenter\Exceptions\InvalidPresenterPreset;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostRequest;
use App\Models\Post;
use App\Presenters\PostPresenter;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    /**
     * @throws InvalidPresenterPreset
     */
    public function index(): Response
    {
        $posts = auth()->user()
            ->posts()
            ->where('is_published', true)
            ->latest()
            ->paginate();

        return Inertia::render('Post/List', [
            'type' => 'published',
            'typeText' => '文章',
            'posts' => PostPresenter::collection($posts),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Post/Form', [
            'post' => PostPresenter::make(Post::make()),
        ]);
    }

    public function store(PostRequest $request): RedirectResponse
    {
        $attributes = $request->validated();

        $data = [
            'title' => $attributes['title'],
            'content' => $attributes['content'],
            'thumbnail' => $attributes['thumbnail'] ?? null,
            'is_published' => $request->boolean('is_published'),
        ];

        $data = collect($data)->reject(fn($value) => is_null($value))->toArray();

        $post = auth()->user()->posts()->create($data);

        return redirect()->route('posts.show', $post->id)->with('success', '新增成功');
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Post $post): Response
    {
        $this->authorize('update', $post);

        return Inertia::render('Post/Form', [
            'post' => PostPresenter::make($post)->with(static fn(Post $post) => [
                'content' => $post->content,
            ]),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        $this->authorize('update', $post);

        $post->update($request->validated());

        return redirect()->route('posts.show', $post->id)->with('success', '更新成功');
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Post $post): RedirectResponse
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('posts.index')->with('success', '刪除成功');
    }

    /**
     * @throws InvalidPresenterPreset
     */
    public function drafts(): Response
    {
        $posts = auth()->user()
            ->posts()
            ->where('is_published', false)
            ->latest()
            ->paginate();

        return Inertia::render('Post/List', [
            'type' => 'drafts',
            'typeText' => '草稿',
            'posts' => PostPresenter::collection($posts),
        ]);
    }

    /**
     * @throws ValidationException
     */
    public function like(Post $post)
    {
        if (!$post->is_published) {
            throw ValidationException::withMessages(['like' => '無法對未發布文章點喜歡']);
        }

        if ($post->isLikedBy(auth()->user())) {
            auth()->user()->unlike($post);
        } else {
            auth()->user()->like($post);
        }

        return back();
    }
}
