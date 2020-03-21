<?php

namespace App\Models;

use App\Models\Traits\{HasChildren, Filterd};
use Illuminate\Database\Eloquent\Model;
use App\Scoping\Scopes\Category\{CategoryScope};

class Category extends Model
{
    use HasChildren, Filterd;

    protected $fillable = [
        "name",
        "parent_id"
    ];

    /**
     * Get category's children.
     *
     */
    public function children()
    {
        return $this->hasMany(Category::class, "parent_id", "id");
    }

    /**
     * the product that belongs to category
     *
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    protected function scopes()
    {
        return [
            'category' => new CategoryScope(),
        ];
    }
}
