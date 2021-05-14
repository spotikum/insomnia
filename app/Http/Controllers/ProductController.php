<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Category;
use App\Product;
use App\ProductImages;
use App\ProductDetail;
use App\ProductDiscount;

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

        //Menyimpam gambar/store ke public
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

    public function edit($id)
    {
        $Category=Category::all();
        $product=Product::where('id',$id)->first(); 
        return view ('admin.product.edit',compact(['Category','product']));
    }

    public function update(Request $request, $id)
    {
        Product::where('id',$id)->update([
            'product_name'=>$request->nama_barang,
            'price'=>$request->harga_product,
            'description'=>$request->deskripsi_product,
            'stock'=>$request->stock_product,
            'weight'=>$request->berat_product,
            'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
        ]);

        if($request->hasfile('image_name')){
            $i = 0;

            foreach ($request->file('image_name') as $image) {
                $folderName = 'product_image';
                $fileName = $id.'_'.$i;
                $fileExtension = $image->getClientOriginalExtension();
                $fileNameToStorage = $fileName.'_'.time().'.'.$fileExtension;
                $filePath = $image->storeAs('public/'.$folderName , $fileNameToStorage);

                $images = new ProductImages();
                $images->product_id = $id;
                $images->image_name = $fileNameToStorage;
                $images->save();

                $i++;
            }
            return redirect('/product')->with('berhasil','Data Product Berhasil dirubah');
        }
    }

    public function destroy($id)
    {
        $images = ProductImages::where('product_id',$id)->get();
        foreach ($images as $image) {
            Storage::delete('public/product_image/'.$image->image_name);
            $image->delete();
        }

        $product =  Product::find($id);
        $product->RelasiProductCategory()->detach();
        $product->delete();
        return redirect('/product')->with('berhasil','Anda Berhasil Menghapus Product');
    }

    public function imageDelete($id)
    {
        $image = ProductImages::find($id);
        Storage::delete('public/product_image/'.$image->image_name);
        $image->delete();
        return back()->with('berhasil','Image successfully deleted!');
    }


}
