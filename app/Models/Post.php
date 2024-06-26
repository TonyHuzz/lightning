<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'content', 'thumbnail', 'visits', 'is_published',
    ];

    protected $casts = [
        'visits' => 'integer',
        'is_published' => 'boolean',
        'author_id' => 'integer',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (self $post) {
            $post->updateDescription();
        });

        static::updating(function (self $post) {
            $post->updateDescription();
        });
    }

    private function updateDescription(): static
    {
        $this->description = Str::limit(preg_replace('/\r|\n/', '', $this->content), 80);

        return $this;
    }
}
