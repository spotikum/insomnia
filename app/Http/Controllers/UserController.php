<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Product_image;

class UserController extends Controller
{
    function index(){
    	$data['produk'] = Product::with('gambar')->get();
    	return view('user.homepage', $data);
    }

    function buyproduct(){
    	Product::findOrFail($_GET['id']);

    	$data = Product::where('id', $_GET['id'])->first();
    	echo "Produk dibeli : ".$data->product_name;
    }
}
