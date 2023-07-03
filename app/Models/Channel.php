<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Channel extends Model
{
    use HasFactory;

    protected static $relationships = ['videos', 'user', 'playlists'];

    protected $fillable = ['name'];

    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function playlists():HasMany
    {
        return $this->hasMany(Playlist::class);
    }

    public function scopeSearch($query, ?string $search)
    {
        return $search ? $query
            ->where('name', 'like', "%{$search}%")
            : $query;
    }

}
