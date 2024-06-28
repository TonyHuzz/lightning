<?php

use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Post\ShowPostController;
use Illuminate\Support\Facades\Route;

Route::resource('posts', PostController::class)->except(['show']);
Route::get('posts/{post}', ShowPostController::class)->name('posts.show');
