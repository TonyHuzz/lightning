<?php

namespace App\Http\Controllers\Post;

use AdditionApps\FlexiblePresenter\Exceptions\InvalidPresenterPreset;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostRequest;
use App\Models\Post;
use App\Presenters\PostPresenter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
            'posts' => PostPresenter::collection($posts)->preset('list'),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Post/Create', [
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

        $data = collect($data)->reject(fn ($value) => is_null($value))->toArray();

        $post = auth()->user()->posts()->create($data);

        return redirect()->route('posts.show', $post->id)->with('success', '新增成功');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
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
            'posts' => PostPresenter::collection($posts)->preset('list'),
        ]);
    }
}
