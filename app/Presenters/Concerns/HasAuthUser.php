<?php

namespace App\Presenters\Concerns;

use Illuminate\Contracts\Auth\Authenticatable;

trait HasAuthUser
{
    protected function user(): ?Authenticatable
    {
        return auth()->user();
    }

    protected function userCan(string $abilities, $model): bool
    {
        return optional($this->user())->can($abilities, $model);
    }
}
