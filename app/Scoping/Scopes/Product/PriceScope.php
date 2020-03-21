<?php

namespace App\Scoping\Scopes\Product;

use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class PriceScope implements Scope
{
    public function apply(Builder $builder, $value)
    {
        $value = $value == "asc" ? "asc" : "desc";

        return $builder->orderBy('price', $value);
    }
}
