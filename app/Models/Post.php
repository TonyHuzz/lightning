<?php

namespace App\Models;

use App\Acquaintances\CanBeLiked;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    use CanBeLiked;

    protected $fillable = [
        'title', 'description', 'content', 'thumbnail', 'visits', 'is_published',
    ];

    protected $casts = [
        'visits' => 'integer',
        'is_published' => 'boolean',
        'author_id' => 'integer',
    ];

    protected $perPage = 10;

    protected ?bool $isLikedCache = null;

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** 已發布文章 */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /** 未發布文章 */
    public function scopeUnpublished($query)
    {
        return $query->where('is_published', false);
    }

    /** 關聯留言 */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function getIsLikedAttributes(): ?bool
    {
        if (is_null($this->isLikedCache)) {
            $this->isLikedCache = auth()->user() ? $this->isLikedBy(auth()->user()) : false;
        }

        return $this->isLikedCache;
    }

    public function setThumbnailAttribute($thumbnail): void
    {
        $this->attributes['thumbnail'] = $thumbnail instanceof UploadedFile
            ? Storage::url($thumbnail->store('posts'))
            : $thumbnail;
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

    protected static function booted(): void
    {
        static::addGlobalScope('likes', fn (Builder $builder) => $builder->withCount('likers'));
    }

    private function updateDescription(): static
    {
        $this->description = $this->generateDescription($this->content, 80);

        return $this;
    }

    private function generateDescription(string $markdown, int $limit): string
    {
        $text = strip_tags(app('parsedown')->parse($markdown));
        $text = preg_replace('/\r|\n/', '', $text);

        return Str::limit($text, $limit);
    }
}
