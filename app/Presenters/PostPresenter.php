<?php

namespace App\Presenters;

use AdditionApps\FlexiblePresenter\FlexiblePresenter;
use App\Models\Post;

class PostPresenter extends FlexiblePresenter
{
    public function values(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'thumbnail' => $this->thumbnail,
            'visits' => $this->visits,
            'is_published' => $this->is_published,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'created_ago' => $this->created_at?->diffForHumans(),
        ];
    }

    public function presetShow(): PostPresenter
    {
        return $this->with(static fn (Post $post) => [
            'content' => $post->content,
            'author' => static fn () => UserPresenter::make($post->author)->preset('withCount'),
        ]);
    }
}
