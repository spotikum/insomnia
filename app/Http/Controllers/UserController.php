<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Product_image;

class UserController extends Controller
{
	function index(){
		$product = Product::get();
		$discount = Discount::get();

		return view('homepage')
			->with('product', $product)
			->with('discount', $discount);
	}
}
