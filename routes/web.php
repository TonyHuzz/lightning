<?php

use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('HelloWorld', [
        'name' => 'Tony',
    ]);
})->name('home');

Route::get('about', function () {
    return Inertia::render('About');
});

Route::middleware('auth')->group(function () {
    Route::get('user/setting', [UserController::class, 'edit'])->name('user.edit');
    Route::put('user', [UserController::class, 'update'])->name('user.update');
    Route::delete('user', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('user/{user}', [ProfileController::class, 'index'])->name('user.profile');
});

require __DIR__ . '/auth.php';
