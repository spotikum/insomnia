<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class DashboardController extends Controller
{
    public function index()
    {
        //Menampilkan daftar Product 
        $products = Product::with('RelasiProductCategory','RelasiProductImage')->get();
        return view ('user.dashboard', compact (['products']));
    }
}
