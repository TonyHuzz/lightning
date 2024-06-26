<?php

use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('user/setting', [UserController::class, 'edit'])->name('user.edit');
Route::put('user', [UserController::class, 'update'])->name('user.update');
Route::delete('user', [UserController::class, 'destroy'])->name('user.destroy');
Route::get('user/{user}', [ProfileController::class, 'index'])->name('user.profile');
