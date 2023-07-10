<?php

namespace App\Models;

use App\Traits\WithRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory, WithRelationships;

    protected static $relationships = ['user', 'video', 'parent', 'replies'];

    protected $fillable = ['text', 'user_id', 'video_id', 'comment_id'];

    protected static function booted()
    {
        static::saving(function (Comment $comment) {
            $comment->user_id = $comment->user_id ?: auth()->id();

            if ($comment->comment_id) {
                $comment->video_id = Comment::query()->find($comment->comment_id)->video_id;
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'comment_id');
    }

    public function isOwnedBy(User $user)
    {
        return $user->id === $this->user_id;
    }
}
