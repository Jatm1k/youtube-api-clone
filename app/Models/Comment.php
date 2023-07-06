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

    protected static $relationships = ['user', 'video', 'comment', 'comments'];

    protected $fillable = ['text', 'user_id', 'video_id', 'comment_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }

    public function comment(): BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
