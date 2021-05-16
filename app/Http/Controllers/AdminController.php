<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product_categorie;

class AdminController extends Controller
{
    function index(){
    	$data['category'] = Product_categorie::all();
    	return view('admin.homepage', $data);
    }
}
