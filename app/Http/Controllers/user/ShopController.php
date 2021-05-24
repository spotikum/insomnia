<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Discount;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Product_image;

class ShopController extends Controller
{
    public function index()
    {
        $product = Product::get();
		$discount = Discount::get();

		return view('user.shop.shop')
			->with('product', $product)
			->with('discount', $discount);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $discount = Discount::where('product_id', $id)->sum('percentage');
        $images = Product_image::get()->where('product_id',$id);
        $price = ($discount > 0) ? $price = ($product->price)-$product->price * $discount / 100 : $price = $product->price ;
        
        return view('user.shop.detail')
            ->with(['product' => $product])
            ->with(['discount' => $discount])
            ->with(['price' => $price])
            ->with(['images' => $images]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
