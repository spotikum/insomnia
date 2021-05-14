<?php

namespace App\Http\Controllers;
use App\ProductDiscount;
use App\Product;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        //Menampilkan daftar Diskon
        $discount = ProductDiscount::with('product')->get();
        return view ('admin.discount.index', compact (['discount']));
    }

    public function create()
    {
        
        $product = Product::get();
        return view ('admin.discount.create', compact(['product']));
    }

    public function store(Request $request)
    {
        $discount = new ProductDiscount;
        $discount->id_product = $request->produk;
        $discount->percentage = $request->persen;
        $discount->start = $request->start;
        $discount->end = $request->end;
        $discount->save();
        return redirect('/discount')->with('berhasil','Anda Berhasil menambahkan data kategori');
    }

    public function edit($id)
    {
        //Menampilkan tampilan edit
        $discount=ProductDiscount::where('id',$id)->first();
        $product = Product::get(); 
        return view ('admin.discount.edit',compact(['discount','product']));
    }

    public function update(Request $request, $id)
    {
        //Mmeperbarui data
        ProductDiscount::where('id',$id)->update([
                    'id_product'=>$request->produk,
                    'percentage'=>$request->persen,
                    'start'=>$request->start,
                    'end'=>$request->end,
                ]);
        return redirect('/couriers')->with('berhasil','Data Courier Berhasil dirubah');
    }

    public function destroy($id)
    {
        //Menghapus data
        $discount=ProductDiscount::find($id);
        $discount->delete();
        return redirect('/discount')->with('berhasil','Data Kategori Berhasil Dihapus');

    }
}
