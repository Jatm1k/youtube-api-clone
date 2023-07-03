<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected static $relationships = ['videos'];

    protected $fillable = ['name'];

    public function videos(): BelongsToMany
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
