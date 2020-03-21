<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Scoping\Scopes\Country\{CategoryScope};
use Illuminate\Database\Eloquent\Builder;
use App\Scoping\Scoper;

class Country extends Model
{

    protected $fillable = [
        "name"
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($country) {
            $country->product()->detach();
        });
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public static function scopeWithScopes(Builder $builder)
    {
        return (new Scoper(request()))->apply($builder, self::scopes());
    }

    protected static function scopes()
    {
        return [
            'category' => new CategoryScope(),
        ];
    }

}
