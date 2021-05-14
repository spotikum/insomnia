<?php

namespace App\Http\Controllers;
use App\Couriers;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        //Menampilkan daftar Courier
        $couriers = Couriers::all();
        return view ('admin.couriers.index',compact (['couriers']));
    }
    
    public function create()
    {
        //Menampilkan halaman penambahan data Couriear
        return view ('admin.couriers.create');
    }

    public function store(Request $request)
    {
        //Menyimpan data courier
        if(Couriers::where('courier',$request->courier)->exists()){
            return redirect('/couriers')->with('gagal','Gagal menambahkan data, data courier sudah terdaftar');
        }
        $couriers = new Couriers;
        $couriers->courier = $request->courier;
        $couriers->save();
        return redirect('/couriers')->with('berhasil','Anda Berhasil menambahkan data courier');
    }

    public function destroy($id)
    {
        //Menghapus data
        $courier=Couriers::find($id);
        $courier->delete();
        return redirect('/couriers')->with('berhasil','Data Courier Berhasil Dihapus');
    }

}
