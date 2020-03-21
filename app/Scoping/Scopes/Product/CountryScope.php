<?php

namespace App\Scoping\Scopes\Product;

use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class CountryScope implements Scope
{
    public function apply(Builder $builder, $value)
    {
        return $builder->whereHas('country', function ($builder) use ($value) {
            $builder->where('name', $value);
        });
    }
}
