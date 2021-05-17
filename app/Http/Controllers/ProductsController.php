<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\Product;
use App\Models\Product_categorie;
use App\Models\Product_category_detail;
use App\Models\Product_image;
use App\Models\Product_review;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
	//fungsi menampilkan dataproduk
	function index(){

    	//syntax get data dari database
		$data['products'] = Product::join('product_category_details', 'products.id', 'product_category_details.product_id')->leftJoin('product_images', 'products.id', 'product_images.product_id')->select('products.*', 'product_category_details.category_id', 'image_name')->get();
		$data['category'] = Product_categorie::all();

		return view('admin.listproducts', $data);
	}

	function listdiskon(){
		Product::findOrFail($_GET['id']);
		$data['category'] = Product_categorie::all();
		$data['diskon'] = Product::with('diskon')->get();
		return view('admin.listdiskon', $data);
	}

	function listreview(){
		Product::findOrFail($_GET['id']);
		$data['category'] = Product_categorie::all();
		$data['review'] = Product::with('review')->get();
		return view('admin.listreview', $data);
	}

	function hapusreview(){
		Product_review::findOrFail($_GET['id']);

		Product_review::where('id', $_GET['id'])->delete();
		return redirect('/daftar/review?id='.$_GET['idproduk'])->with('sukses', 'Review berhasil dihapus');
	}

	function savediskon(Request $req){
		$req->validate([
			'persen' => 'required',
			'start' => 'required',
			'end' => 'required',
		],[
			'persen.required' => 'Presentase harus diisi',
			'start.required' => 'Pilih tanggal awal dahulu',
			'end.required' => 'Pilih tanggal akhir dahulu'
		]);

		try {
			Discount::create([
				'product_id' => $req->idproduk,
				'percentage' => $req->persen,
				'start' => $req->start,
				'end' => $req->end
			]);
			return redirect('/daftar/diskon?id='.$req->idproduk)->with('sukses', 'Diskon berhasil ditambahkan');
		} catch (Exception $e) {
			return redirect('/daftar/diskon?id='.$req->idproduk)->with('gagal', 'Diskon gagal ditambahkan');
		}
	}

	function saveproductimage(Request $req){
		$req->validate([
			'foto' => 'required'
		],[
			'foto.required' => 'Pilih foto produk terlebih dahulu'
		]);

		if ($req->hasFile('foto')) {
			try {
				$image      = $req->file('foto');
                $fileName   = time() . '.' . $image->getClientOriginalExtension(); //mengubah namafile
                $path = Storage::putFileAs('public/images/produk', $req->file('foto'), $fileName); //upload file pada server
                //input user ke db
			Product_image::create([
				'product_id' => $req->idproduk,
				'image_name' => $fileName
			]);
			return redirect('/list/products')->with('sukses', "Gambar produk berhasil diupload");
		} catch (Exception $e) {
			return redirect('/list/products')->with('gagal', "Gambar produk gagal diupload");
		}
	}
}

function selectproduct($id){
	Product::findOrFail($id);

	$data = Product::where('id', $id)->first();
	echo json_encode($data);
}

//fungsi untuk simpan produk
function saveproduct(Request $req){

	//syntax validasi inputan
	$req->validate([
		'kategori' => 'required',
		'product_name' => 'required|unique:products',
		'harga' => 'required',
		'deskripsi' => 'required',
		'rating' => 'required',
		'stok' => 'required',
		'berat' => 'required'
	],[
		'kategori.required' => "Pilih kategori produk terlebih dahulu",
		'product_name.required' => "Nama produk harus diisi",
		'product_name.unique' => "Nama produk sudah digunakan",
		'harga.required' => "Harga produk harus diisi",
		'deskripsi.required' => "Deskripsi produk harus diisi",
		'rating.required' => "Rating produk harus diisi",
		'stok.required' => "Stok produk harus diisi",
		'berat.required' => "Berat produk harus diisi",
	]);

	try {
		//syntax input data ke db
		$id = Product::create([
			'product_name' => $req->product_name,
			'price' => $req->harga,
			'description' => $req->deskripsi,
			'product_rate' => $req->rating,
			'stock' => $req->stok,
			'weight' => $req->berat
		])->id;

		Product_category_detail::create([
			'product_id' => $id,
			'category_id' => $req->kategori
		]);

		return redirect('/list/products')->with('sukses', 'Data produk berhasil ditambahkan');
	} catch (Exception $e) {
		return redirect('/list/products')->with('gagal', 'Data produk gagal ditambahkan');
	}
}

//funcgsi untuk menampilkan halaman edit produk
function ubahproductpage(){
	//syntax cek produk dengan id
	Product::findOrFail($_GET['id']);

	//get data produk berdasarkan id
	$data['produk'] = Product::join('product_category_details', 'products.id', 'product_category_details.product_id')->select('products.*', 'product_category_details.category_id')->where('products.id', $_GET['id'])->get();
	$data['category'] = Product_categorie::all();
	return view('admin.ubahproduct', $data);
}

//fungsi untuk simpan edit produk
function ubahproduct(Request $req){    

	//validasi inputan	
	$req->validate([
		'kategori' => 'required',
		'product_name' => 'required',
		'harga' => 'required',
		'deskripsi' => 'required',
		'rating' => 'required',
		'stok' => 'required',
		'berat' => 'required'
	],[
		'kategori.required' => "Pilih kategori produk terlebih dahulu",
		'product_name.required' => "Nama produk harus diisi",
		'harga.required' => "Harga produk harus diisi",
		'deskripsi.required' => "Deskripsi produk harus diisi",
		'rating.required' => "Rating produk harus diisi",
		'stok.required' => "Stok produk harus diisi",
		'berat.required' => "Berat produk harus diisi",
	]);

	//cek ada tidaknya produk dengan id sekian
	Product::findOrFail($req->id);

	try {
		Product::where('id', $req->id)->update([
			'product_name' => $req->product_name,
			'price' => $req->harga,
			'description' => $req->deskripsi,
			'product_rate' => $req->rating,
			'stock' => $req->stok,
			'weight' => $req->berat
		]);

		Product_category_detail::where('product_id', $req->id)->update([
			'category_id' => $req->kategori
		]);

		return redirect('/list/products')->with('sukses', 'Data produk berhasil diubah');
	} catch (Exception $e) {
		return redirect('/list/products')->with('gagal', 'Data produk gagal diubah');
	}
}

//fungsi untuk hapus produk
function hapusproduct(){
	Product::findOrFail($_GET['id']);
	try {
		Discount::where('product_id', $_GET['id'])->delete();
		Product_image::where('product_id', $_GET['id'])->delete();
		Product_category_detail::where('product_id', $_GET['id'])->delete();
		Product::where('id', $_GET['id'])->delete();
		return redirect('/list/products')->with('sukses', "Data produk berhasil dihapus");
	} catch (Exception $e) {
		return redirect('/list/products')->with('gagal', "Data produk gagal dihapus");
	}
}
}
