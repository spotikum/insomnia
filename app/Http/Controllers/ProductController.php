<?php

namespace App\Http\Controllers;
use App\Category;
use App\Product;
use App\ProductImages;
use App\ProductDetail;
use Carbon\Carbon;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        //Menampilkan daftar Product 
        $products = Product::with('RelasiProductCategory','RelasiProductImage')->get();
        return view ('admin.product.index', compact (['products']));
    }

    public function create()
    {
        //Menampilkan halaman penambahan data product
        $Category = Category::get();
        if ($Category->isEmpty()){
            return redirect('/product')->with('error','Tidak ada data Kategori');
        }else{
            return view ('admin.product.create', compact(['Category']));
        }

    }
    
    public function store(Request $request)
    {
        //Menyimpan data di tabel product
        if(Product::where('product_name',$request->nama_product)->exists()){
            return redirect('/product')->with('gagal','Gagal menambahkan data, data barang sudah terdaftar');
        }
        $products = new Product;
        $products->product_name = $request->nama_barang;
        $products->price = $request->harga_product;
        $products->description = $request->deskripsi_product;
        $products->stock = $request->stock_product;
        $products->weight = $request->berat_product;
        $products->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $products->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $products->save();

        //Menyimpan nama gambar dan menaruh file gambar di public
        // $productImage = new ProductImages;
        // $productImage->product_id = $products->id; 
        // $file = $request->file('gambar_product');
        // $name= $file->getClientOriginalName();
        // if (ProductImages::where('image_name',$name)->exists()){
        //     $name = uniqid().'-'.$name;
        // }
        // $productImage->image_name = $name;
        // $productImage->created_at = Carbon::now()->format('Y-m-d H:i:s');
        // $productImage->updated_at = Carbon::now()->format('Y-m-d H:i:s'); 
        // $file->move('img',$name); 
        // $productImage->save();

        if($request->hasfile('image_name')){
            $i = 0;

            $products = Product::select('id')->orderBy('id','DESC')->first();

            foreach ($request->file('image_name') as $image) {
                $folderName = 'product_image';
                $fileName = $products->id.'_'.$i;
                $fileExtension = $image->getClientOriginalExtension();
                $fileNameToStorage = $fileName.'_'.time().'.'.$fileExtension;
                $filePath = $image->storeAs('/'.$folderName , $fileNameToStorage);

                $images = new ProductImages();
                $images->product_id = $products->id;
                $images->image_name = $fileNameToStorage;
                $images->save();

                $i++;
            }
        }


        //Menyimpan id product dan kategori product pada detail product
        $productCategoryDetail = new ProductDetail;
        $productCategoryDetail->product_id = $products->id;
        $productCategoryDetail->category_id = $request->kategori_product;
        $productCategoryDetail->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $productCategoryDetail->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $productCategoryDetail->save();
        return redirect('/product')->with('berhasil','Anda Berhasil menambahkan data product');
        
    }
}
