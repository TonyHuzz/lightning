<?php

use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Post\ShowPostController;
use App\Http\Controllers\Post\ShowPostList;
use Illuminate\Support\Facades\Route;

Route::get('/', [ShowPostList::class, 'index'])->name('home.index');
Route::resource('posts', PostController::class)->except(['show']);
Route::get('posts/drafts', [PostController::class, 'drafts'])->name('posts.drafts');
Route::get('posts/{post}', ShowPostController::class)->name('posts.show');
