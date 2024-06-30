<?php

use App\Http\Controllers\Comment\CommentController;
use Illuminate\Support\Facades\Route;

Route::resource('post.comments', CommentController::class)->shallow()->only(['store', 'destroy']);
