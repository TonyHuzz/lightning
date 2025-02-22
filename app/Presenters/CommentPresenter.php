<?php

namespace App\Presenters;

use AdditionApps\FlexiblePresenter\FlexiblePresenter;
use App\Presenters\Concerns\HasAuthUser;

class CommentPresenter extends FlexiblePresenter
{
    use HasAuthUser;

    public function values(): array
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'commenter' => UserPresenter::make($this->commenter),
            'created_at' => $this->created_at->diffForHumans(),
            'can' => [
                'delete' => $this->userCan('delete', $this->resource),
            ],
        ];
    }
}
