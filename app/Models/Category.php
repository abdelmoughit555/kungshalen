<?php

namespace App\Models;

use App\Models\Traits\HasChildren;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Scoping\Scoper;
use App\Scoping\Scopes\Category\{CategoryScope};

class Category extends Model
{
    use HasChildren;

    protected $fillable = [
        "name",
        "parent_id"
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($category) {
            $category->children()->delete();
            $category->products()->detach();
        });
    }

    public function children()
    {
        return $this->hasMany(Category::class, "parent_id", "id");
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function scopeWithScopes(Builder $builder)
    {
        return (new Scoper(request()))->apply($builder, $this->scopes());
    }

    protected function scopes()
    {
        return [
            'category' => new CategoryScope(),
        ];
    }
}
