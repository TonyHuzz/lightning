<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Post $post): RedirectResponse
    {
        $comment = Comment::make($request->validated());
        $comment->post()->associate($post);
        $comment->commenter()->associate(auth()->user());
        $comment->save();

        return back()->with('success', '留言成功');
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Comment $comment): RedirectResponse
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return back()->with('success', '刪除留言成功');
    }
}
