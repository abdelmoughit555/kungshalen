<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Scoping\Scoper;

Trait Filterd {

    /**
     * filter model based on givin params
     *
     */
    public function scopeWithScopes(Builder $builder)
    {
        return (new Scoper(request()))->apply($builder, $this->scopes());
    }
}
