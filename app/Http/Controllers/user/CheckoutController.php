<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Transaction;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('user.shop.chart');
    }

    public function buy($id)
    {
        $user_id = Auth::user()->id;

        Transaction::create([
            'user_id' => $user_id
        ]);
        return view('user.shop.chart');
    }
}
