<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courier;
use App\Models\Product_categorie;

class CourierController extends Controller
{
    function index(){
		$data['category'] = Product_categorie::all();
    	$data['cou'] = Courier::all();
    	return view('admin.listcourier', $data);
    }

    function savecou(Request $req){
    	$req->validate([
    		'courier' => 'required|unique:couriers'
    	],[
    		'courier.required' => "Nama kurir harus diisi",
    		'courier.unique' => "Nama kurir telah digunakan",
    	]);

    	try {
    		Courier::create([
    			'courier' => $req->courier
    		]);
    		return redirect('/list/courier')->with('sukses', "Data kurir berhasil ditambahkan");
    	} catch (Exception $e) {
    		return redirect('/list/courier')->with('gagal', "Data kurir gagal ditambahkan");
    	}
    }

    function ubahcou(Request $req){
    	$req->validate([
    		'courier' => 'required'
    	],[
    		'courier.required' => "Nama kurir harus diisi",
    	]);

    	Courier::findOrFail($req->idcou);

    	try {
    		Courier::where('id', $req->idcou)->update([
    			'courier' => $req->courier
    		]);
    		return redirect('/list/courier')->with('sukses', "Data kurir berhasil diubah");
    	} catch (Exception $e) {
    		return redirect('/list/courier')->with('gagal', "Data kurir gagal diubah");
    	}
    }

    function hapuscou(){
    	Courier::findOrFail($_GET['id']);

    	try {
    		Courier::where('id', $_GET['id'])->delete();
    		return redirect('/list/courier')->with('sukses', "Data kurir berhasil dihapus");
    	} catch (Exception $e) {
    		return redirect('/list/courier')->with('gagal', "Data kurir gagal dihapus");
    	}
    }
}
