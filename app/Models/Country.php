<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Scoping\Scopes\Country\{CategoryScope};
use App\Models\Traits\Filterd;

class Country extends Model
{
    use Filterd;

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

    protected static function scopes()
    {
        return [
            'category' => new CategoryScope(),
        ];
    }

}
