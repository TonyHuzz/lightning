<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Presenters\UserPresenter;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    public function index(User $user): Response
    {
        return Inertia::render('User/Profile', [
            'user' => UserPresenter::make($user),
        ]);
    }
}
