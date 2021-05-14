<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //Nama Tabel Yang digunakan dalam SQL
    protected $table="product_categories";
    //Relasi Many to Many dengan tabel product
    public function RelasiProduct()
    {
        return $this->belongsToMany(Product::class,'product_category_details','product_id','category_id');
    }
}
