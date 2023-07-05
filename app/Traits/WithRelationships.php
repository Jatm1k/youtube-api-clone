<?php

namespace App\Traits;

use Illuminate\Support\Arr;

trait WithRelationships
{

    public function scopeWithRelationships($query, array|string $with)
    {
        $validRelationships = collect($with)
            ->map(fn(string $relationships) => explode('.', $relationships))
            ->filter(fn (array $relationships) => (new static)->hasRelationships($relationships))
            ->map(fn(array $relationships) => implode('.', $relationships))
            ->all();

        return $query->with($validRelationships);
    }

    private function hasRelationships(array $relationships)
    {
        return (bool) collect($relationships)
            ->reduce(fn ($model, $relationship) => $model?->hasRelationship($relationship), $this);
    }

    private function hasRelationship(string $relationship)
    {
        return $this->isValidRelationship($relationship) ?
            $this->$relationship()->getRelated()
            : null;
    }

    private function isValidRelationship(string $relationship)
    {
        return method_exists($this, $relationship) && in_array($relationship, static::$relationships);
    }
}
