<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'customer_id',
        'staff_id',
        'discount_id',
        'discount_value',
        'status',
        'total_price',
        'payment_method_id',
        'address',
   
    ];
}
