<?php

namespace App\Traits;

use Illuminate\Support\Arr;

trait WithRelationships
{

    public function scopeWithRelationships($query, array|string $with)
    {
        $validRelationships = collect($with)
            ->map(fn(string $relationships) => explode('.', $relationships))
            ->filter(function ($relationships) {
                return collect($relationships)->reduce(function ($model, $relationship) {
                    if($model && method_exists($model, $relationship) && in_array($relationship, $model::$relationships)) {
                        return $model->$relationship()->getRelated();
                    }
                    return null;
                }, new static);
            })
            ->map(fn(array $relationships) => implode('.', $relationships))
            ->all();

        return $query->with($validRelationships);
    }
}
