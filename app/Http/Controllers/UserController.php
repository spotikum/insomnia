<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Product_image;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
	function index(){
		$product = Product::get();
		$discount = Discount::get();
		$new = Carbon::yesterday();
		

		return view('homepage')
			->with('product', $product)
			->with('discount', $discount)
			->with('new', $new)
		;
	}

	function user(){
		$product = Product::paginate(2);
		$discount = Discount::get();

		return view('user.shop.shop')
			->with('product', $product)
			->with('discount', $discount);
	}
}
