<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Imageable;
use Illuminate\Support\Str;
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

    public function getPriceAttribute($value)
    {
        return money_format('%i', $value / 100);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->image = $product->imageable();
            $product->slug = Str::slug($product->title, '-');
        });

        static::created(function ($product) {
             $product->country()->attach(request()->country);
             $product->category()->attach(request()->category);
        });

        static::updating(function ($product) {
            $product->updateImageable();
        });

        static::updated(function( $product) {
            $product->country()->sync(request()->country);
            $product->category()->sync(request()->category);
        });

        static::deleting(function ($product) {
            $product->country()->detach();
            $product->category()->detach();
        });
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

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

    public function country()
    {
        return $this->belongsToMany(Country::class);
    }

    public function scopeWithScopes(Builder $builder)
    {
        return (new Scoper(request()))->apply($builder, $this->scopes());
    }

    protected function scopes()
    {
        return [
            'category' => new CategoryScope(),
            'country' => new CountryScope(),
            'price' => new PriceScope(),
        ];
    }
}
