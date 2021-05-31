<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $cart = Cart::where('user_id', $user_id)->get();

        return view('user.shop.cart')
            ->with('cart', $cart)
        ;
    }

    public function buy($id)
    {
        $user_id = Auth::user()->id;
        $cart = Cart::where('product_id', '=', $id)->first();

        if ($cart === null) {
            Cart::create([
                'user_id' => $user_id,
                'product_id' => $id,
                'qty' => '1',
                'status' => 'notyet'
            ]);
        } else {
            DB::table('carts')->increment('qty');

        }
        
        return redirect('/cart');
    }

    public function add($id)
    {
        $user_id = Auth::user()->id;
        $cart = Cart::where('product_id', '=', $id)->first();

        if ($cart === null) {
            Cart::create([
                'user_id' => $user_id,
                'product_id' => $id,
                'qty' => '1',
                'status' => 'notyet'
            ]);
        } else {
            DB::table('carts')->increment('qty');

        }
        
        return back();
    }

    public function destroy($id)
    {
        Cart::destroy($id);
        return back();
    }
}
