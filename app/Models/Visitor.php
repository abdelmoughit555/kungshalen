<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
          "ip",
     ];

     public function products()
     {
          return $this->belongsToMany(Product::class, 'carts')->withPivot('quantity', 'type', 'price');
     }
}
