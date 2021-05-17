<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    function index(){
		$data['produk'] = Product::with('gambar')->get();
		return view('user.shop.shop', $data);
	}
}
