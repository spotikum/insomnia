<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['timeout', 'address', 'regency', 'province', 'total', 'shipping_cost', 'sub_total', 'user_id', 'courier_id', 'proof_of_payment', 'status'];

    
}
