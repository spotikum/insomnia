<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product_categorie;

class CategoryController extends Controller
{
    function index(){
    	$data['category'] = Product_categorie::all();
    	return view('admin.listcategory', $data);
    }

    function savecategory(Request $req){
    	$req->validate([
    		'category_name' => 'required|unique:product_categories'
    	],[
    		'category_name.required' => 'nama kategori harus diisi',
    		'category_name.unique' => 'nama kategori sudah digunakan'
    	]);

    	try {
    		Product_categorie::create([
    			'category_name' => $req->category_name
    		]);
    		return redirect('/list/category')->with('sukses', 'Data kategori berhasil disimpan');
    	} catch (Exception $e) {
    		return redirect('/list/category')->with('gagal', 'Data kategori gagal disimpan');
    	}
    }

    function ubahcategory(Request $req){
    	$req->validate([
    		'category' => 'required'
    	],[
    		'category.required' => 'nama kategori harus diisi',
    	]);

    	Product_categorie::findOrFail($req->idcategory);

    	try {
    		Product_categorie::where('id', $req->idcategory)->update([
    			'category_name' => $req->category
    		]);
    		return redirect('/list/category')->with('sukses', 'Data kategori berhasil diubah');
    	} catch (Exception $e) {
    		return redirect('/list/category')->with('gagal', 'Data kategori gagal diubah');
    	}
    }

    function hapuscategory(){
    	Product_categorie::findOrFail($_GET['id']);

    	try {
    		Product_categorie::where('id', $_GET['id'])->delete();
    		return redirect('/list/category')->with('sukses', "Data kategori berhasil dihapus");
    	} catch (Exception $e) {
    		return redirect('/list/category')->with('gagal', "Data kategori gagal dihapus");
    	}
    }
}
