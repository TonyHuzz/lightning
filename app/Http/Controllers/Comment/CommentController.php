<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
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
    public function create()
    {
    }

    public function store(CommentRequest $request, Post $post): RedirectResponse
    {
        $comment = Comment::make($request->validated());
        $comment->post()->associate($post);
        $comment->commenter()->associate(auth()->user());
        $comment->save();

        return back()->with('success', '留言成功');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
    }
}
