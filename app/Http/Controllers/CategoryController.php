<?php

namespace App\Http\Controllers;
use App\Category;
use Carbon\Carbon;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        //Menampilkan daftar Product Category
        $Category = Category::all();
        return view ('admin.category.index',compact (['Category']));
    }

    public function create()
    {
        return view ('admin.category.create');
    }
    public function store(Request $request)
    {
        //Menyimpan data courier
        if(Category::where('category_name',$request->nama_category)->exists()){
            return redirect('/category')->with('gagal','Gagal menambahkan data, data kategori sudah terdaftar');
        }
        $Category = new Category;
        $Category->category_name = $request->nama_category;
        $Category->save();
        return redirect('/category')->with('berhasil','Anda Berhasil menambahkan data kategori');
    }
    public function edit($id)
    {
        //Menampilkan tampilan edit
        $Category=Category::where('id',$id)->first(); 
        return view ('admin.category.edit',compact(['Category']));
    }

    public function update(Request $request, $id)
    {
        //Mmeperbarui data
        Category::where('id',$id)->update([
                    'category_name'=>$request->nama_category,
                    'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
                ]);
        return redirect('/category')->with('berhasil','Data Kategori Berhasil dirubah');
    }

    public function destroy($id)
    {
        //Menghapus data
        $Category=Category::find($id);
        $Category->delete();
        return redirect('/category')->with('berhasil','Data Kategori Berhasil Dihapus');
    }
}
