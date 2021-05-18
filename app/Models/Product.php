<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['product_name','price','description','product_rate','stock','weight'];

    function diskon(){
        return $this->hasMany('App\Models\Discount', 'product_id');
    }

    function review(){
        return $this->hasMany('App\Models\Product_review', 'product_id');
    }

    function gambar(){
        return $this->hasOne('App\Models\Product_image', 'product_id');
    }
}
