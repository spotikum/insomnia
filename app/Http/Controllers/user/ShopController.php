<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class ShopController extends Controller
{
    public function index()
    {
        //Menampilkan daftar Product 
        $products = Product::with('RelasiProductCategory','RelasiProductImage')->get();
        return view ('user.shop', compact (['products']));
    }
}
