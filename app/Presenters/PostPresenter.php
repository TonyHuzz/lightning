<?php

namespace App\Presenters;

use AdditionApps\FlexiblePresenter\FlexiblePresenter;
use App\Acquaintances\Interaction;
use App\Models\Post;
use App\Presenters\Concerns\HasAuthUser;

class PostPresenter extends FlexiblePresenter
{
    use HasAuthUser;

    public function values(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'thumbnail' => $this->thumbnail,
            'is_published' => $this->is_published,
            'visits' => Interaction::numberToReadable($this->visits),
            'likes' => $this->likersCountReadable(),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'created_ago' => $this->created_at?->diffForHumans(),
        ];
    }

    public function presetShow(): PostPresenter
    {
        // 避免在閉包中使用 $this 噴錯，因此將 $this 指派給 $presenter
        $presenter = $this;

        return $this->with(fn (Post $post) => [
            'content' => $post->content,
            'author' => fn () => UserPresenter::make($post->author)->preset('withCount'),
            'can' => [
                'update' => $presenter->userCan('update', $post),
                'delete' => $presenter->userCan('delete', $post),
            ],
            'is_liked' => $this->user() && $post->isLikedBy($this->user()),
        ]);
    }

    public function presetList(): PostPresenter
    {
        return $this->with(static fn (Post $post) => [
            'author' => static fn () => UserPresenter::make($post->author)
                ->only('id', 'name', 'avatar'),
        ]);
    }
}
