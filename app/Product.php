<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductImages;

class Product extends Model
{
    //Nama Tabel yang digunakan di SQL
    protected $table ='products';

    //Relasi Many to Many dengan tabel product category
    public function RelasiProductCategory()
    {
        return $this->belongsToMany(Category::class,'product_category_details','product_id','category_id');
    }

    //Relasi One to Many dengan tabel product Image
    public function RelasiProductImage (){
        return $this->hasMany(ProductImages::class,'product_id','id');
    }

    public function product_images(){
        return $this->hasMany('App\ProductImages');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function discount(){
    return $this->hasMany(ProductDiscount::class);
    }
}
