<?php

namespace App\Scoping\Scopes\Category;

use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class CategoryScope implements Scope
{
    public function apply(Builder $builder, $value)
    {
        $builder->has('children')->with('children')->whereName($value);
    }

}
