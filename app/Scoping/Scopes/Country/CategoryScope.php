<?php

namespace App\Scoping\Scopes\Country;

use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class CategoryScope implements Scope
{
    public function apply(Builder $builder, $value)
    {
        return $builder->whereHas('products.category', function ($builder) use ($value) {
            $builder->where('name', $value);
        })->withCount(['products' => function ($query) use ($value) {
                $query->whereHas('category', function ($builder) use ($value) {
                $builder->where('name', $value);
            });
        }]);
    }

}
