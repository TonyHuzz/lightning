<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('HelloWorld', [
        'name' => 'Tony',
    ]);
})->name('home');

Route::get('about', function () {
    return Inertia::render('About');
});
