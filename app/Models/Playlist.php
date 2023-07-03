<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Playlist extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'channel_id'];

    public function channel(): BelongsTo
    {
        return $this->belongsTo(Channel::class);
    }

    public function videos():BelongsToMany
    {
        return $this->belongsToMany(Video::class);
    }

    public function scopeSearch($query, ?string $search)
    {
        return $search ? $query
            ->where('name', 'like', "%{$search}%")
            : $query;
    }
}
