<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostRequest;
use App\Models\Post;
use App\Presenters\PostPresenter;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Post/Form', [
            'post' => PostPresenter::make(Post::make()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
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
}
