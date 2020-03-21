<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Imageable;
use Illuminate\Database\Eloquent\Builder;
use App\Scoping\Scoper;
use App\Scoping\Scopes\Product\{CategoryScope,CountryScope,PriceScope};

class Product extends Model
{
    use Imageable;

    protected $fillable = [
        "title",
        "slug",
        "description",
        "price",
        "image",
    ];

    /**
     * Get Price Attribute and formatted.
     *
     * @return integer
     */

    public function getPriceAttribute($value)
    {
        return money_format('%i', $value / 100);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * the category that belongs to product
     *
     */
    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * the country that belongs to product
     *
     */
    public function country()
    {
        return $this->belongsToMany(Country::class);
    }

    /**
     * filter model based on givin params
     *
     */
    public function scopeWithScopes(Builder $builder)
    {
        return (new Scoper(request()))->apply($builder, $this->scopes());
    }

     /**
     * group of params to filter with
     *
     * @return array
     */
    protected function scopes()
    {
        return [
            'category' => new CategoryScope(),
            'country' => new CountryScope(),
            'price' => new PriceScope(),
        ];
    }
}
