<?php

namespace App\Traits;

trait CommonQueryScopes
{
    public function scopeSearchByName($query, $name = null)
    {
        if ($name) {
            $query->where('name', 'like', "%{$name}%");
        }

        return $query;
    }

    public function scopeFilterByPrice($query, $min = null, $max = null)
    {
        if ($min !== null) {
            $query->where('price', '>=', $min);
        }

        if ($max !== null) {
            $query->where('price', '<=', $max);
        }

        return $query;
    }
}