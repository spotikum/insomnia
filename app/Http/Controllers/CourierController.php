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
}
