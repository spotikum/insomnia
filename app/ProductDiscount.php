<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDiscount extends Model
{
    protected $table='discounts';

    public function product (){
        return $this->belongsTo(Product::class);
    }
}
