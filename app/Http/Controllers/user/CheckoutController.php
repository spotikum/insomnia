<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Transaction;

class CheckoutController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $product = Product::get();
        $cart = Cart::where('user_id', $user_id)->where('status', 'notyet')->get();
        $total = 0 ;
        return view('user.shop.checkout', compact('product', 'cart', 'total'));
    }
}
