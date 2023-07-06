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

    public function associateParentComment()
    {
        if ($this->replies()->exists()) return;

        $this->parent()->associate($this->findParentComment())->save();
    }

    private function findParentComment()
    {
        return $this->video->comments()->doesntHave('parent')
            ->where('id', '<>', $this->id)
            ->inRandomOrder()
            ->first();
    }
}
