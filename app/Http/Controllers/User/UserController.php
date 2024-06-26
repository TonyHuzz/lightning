<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Presenters\UserPresenter;
use Illuminate\Contracts\Auth\Authenticatable;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{

    public function user(): ?Authenticatable
    {
        return auth()->user();
    }

    public function edit(): Response
    {
        return Inertia::render('User/Edit' ,[
            'user' => UserPresenter::make($this->user())
        ]);
    }

    public function update(UpdateRequest $request)
    {
        $user = $this->user();

        $attributes = $request->validated();

       tap($user, static function ($user) use ($attributes) {
           if (isset($attributes['password'])) {
               $user->password = $attributes['password'];
           }

           if (isset($attributes['avatar'])) {
               $user->avatar = $attributes['avatar'];
           }

           $attributes = collect($attributes)->except(['password', 'avatar'])->toArray();

           $user->update($attributes);
       });

        return redirect()->back()->with('success', '更新成功');
    }

    public function destroy()
    {
        $user = $this->user();

        auth()->logout();
        $user->delete();

        return redirect()->route('home')->with('success', '帳號已刪除');
    }
}
