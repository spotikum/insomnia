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
use App\Models\Transaction_detail;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
            
            return view('user.shop.checkout', compact('product', 'courier', 'cart', 'total', 'city', 'weight', 'cost'));
        } else if ($request->has('buy')) {
            $courier_id = Courier::where('code', $request->courier)->get('id')->first();

            Transaction::create([
                'timeout' => Carbon::tomorrow(),
                'address' => $request->street,
                'regency' => $request->destination,
                'province' => $request->destination,
                'total' => $request->total,
                'shipping_cost' => $request->cost,
                'sub_total' => $request->subtotal,
                'user_id' => $user_id,
                'courier_id' => $courier_id->id,
                'proof_of_payment' => null,
                'status' => 'unverified'
            ]);

            foreach ($cart as $cart) {
                $transaction_id = Transaction::latest()->first();
                Transaction_detail::create([
                    'transaction_id' => $transaction_id->id,
                    'product_id' => $cart->product_id,
                    'qty' => $cart->qty,
                    'discount' => 0,
                    'selling_price' => $cart->product->price
                ]);
            }

            Cart::where('status', 'notyet')
            ->update([
                'status' => 'checkedout'
            ]);

            return redirect('/');
        }
    }

    public function status(){
        $pending = Transaction::where('status','=', 'unverified')->orWhere('status','=', 'verified')->get();
        $status = Transaction::where('status','=', 'unverified')->orWhere('status','=', 'verified')->count();
        return view('user.shop.status', compact('pending', 'status'));
    }

    function upload_image(Request $request, $id){
        // dd($request);
		$request->validate([
			'images' => 'required'
		],[
			'images.required' => 'Pilih foto Bukti bayar terlebih dahulu'
		]);

		if ($request->hasFile('images')) {
			try {
				$image      = $request->file('images');
                $fileName   = time() . '.' . $image->getClientOriginalExtension(); //mengubah namafile
                $path = Storage::putFileAs('images/pay', $request->file('images'), $fileName); //upload file pada server

                Transaction::where('id', $id)
                    ->update([
                        'proof_of_payment' => $fileName
                    ]);
			return back();
            } catch (Exception $e) {
                return back();
            }
        }
        return back();
    }

    public function delete($id){
        Transaction::where('id', $id)
            ->update([
                'status' => 'canceled'
            ]);
        return back();
    }
}
