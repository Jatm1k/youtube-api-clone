<?php

namespace App\Models;

use App\Enums\Period;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;

class Video extends Model
{
    use HasFactory;

    protected static $relationships = ['channel', 'categories', 'playlists', 'comments'];

    protected $fillable = [
        'title',
        'description',
    ];

    public function channel(): BelongsTo
    {
        return $this->belongsTo(Channel::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function playlists():BelongsToMany
    {
        return $this->belongsToMany(Playlist::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeFromPeriod($query, ?Period $period)
    {
        return $period ? $query->where('created_at', '>=', $period->date()) : $query;
    }

    public function scopeSearch($query, ?string $search)
    {
        return $search ? $query
            ->where('title', 'like', "%{$search}%")
            ->orWhere('description', 'like', "%{$search}%")
            : $query;
    }

    public function createRandomComments()
    {
        return Comment::factory(10)->create(['video_id' => $this->id]);
    }

}
