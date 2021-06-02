<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\City;
use App\Models\Courier;
use App\Models\Product;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class CheckoutController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $product = Product::get();
        $courier = Courier::get();
        $cart = Cart::where('user_id', $user_id)->where('status', 'notyet')->get();
        $total = 0 ;
        $weight = 0 ;
        $cost = null;

        $city = City::pluck('name', 'city_id');

        return view('user.shop.checkout', compact('product', 'courier', 'cart', 'total', 'city', 'weight', 'cost'));
    }

    public function buy(Request $request)
    {
        $user_id = Auth::user()->id;
        $product = Product::get();
        $courier = Courier::get();
        $cart = Cart::where('user_id', $user_id)->where('status', 'notyet')->get();
        $total = 0 ;
        
        $city = City::pluck('name', 'city_id');

        if ($request->has('update')) {
            $cost = RajaOngkir::ongkosKirim([
                'origin'        => 7,
                'destination'   => $request->destination,
                'weight'        => $request->weight,
                'courier'       => $request->courier
            ])->get();
                
            $weight = 0;
            $cost = $cost[0]['costs'][0]['cost'][0]['value'];
            
            // return redirect('/checkout');
            return view('user.shop.checkout', compact('product', 'courier', 'cart', 'total', 'city', 'weight', 'cost'));
        } else if ($request->has('buy')) {
            dd($request);
            Transaction::create([
                'timeout' => Carbon::yesterday(),
                'address' => $request->street,
                'regency' => $request->destination,
                'province' => $request,
                'total' => $request,
                'shipping_cost' => $request,
                'sub_total' => $request,
                'user_id' => $request,
                'courier_id' => $request,
                'proof_of_payment' => $request,
                'status' => 'unverified'
            ]);
            return redirect('/');
        }
    }
}
