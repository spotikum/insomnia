<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Models\Courier;
use Illuminate\Support\Facades\DB;
use App\Models\Discount;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Product_categorie;
use App\Models\Product_image;
use App\Models\Product_review;
use Illuminate\Support\Carbon;

class ShopController extends Controller
{
    public function index()
    {
        $product = Product::get()->sortByDesc("updated_at");
        $gambar = Product::get();
        $category = Product_categorie::get();
        $courier = Courier::get();
		$discount = Discount::get();
        $new = Carbon::yesterday();

		return view('user.shop.shop', compact('product', 'gambar', 'category', 'courier', 'discount', 'new'));
    }

    public function by_category($id)
    {
        $product = DB::select('SELECT product_name FROM products, product_categories, product_category_details WHERE product_category_details.`category_id` = product_categories.`id` AND product_category_details.`product_id` = products.`id` AND product_categories.`id` = ?', [$id]);
        $gambar = Product::get();
        $category = Product_categorie::get();
        $courier = Courier::get();
		$discount = Discount::get();
        $new = Carbon::yesterday();

		return view('user.shop.shop', compact('product', 'gambar', 'category', 'courier', 'discount', 'new'));
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
        $rate = Product_review::where('product_id', $id)->sum('id');
        $discount = Discount::where('product_id', $id)->sum('percentage');
        $images = Product_image::get()->where('product_id',$id);
        $price = ($discount > 0) ? $price = ($product->price)-$product->price * $discount / 100 : $price = $product->price ;
        
        return view('user.shop.detail')
            ->with(['product' => $product])
            ->with(['rate' => $rate])
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
