<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
            'transaction_id',
            'order_id',
            'money',
            'transaction_code',
            'note',
            'vnp_respond_code',
            'vnpay_code',
            'bank_code',
            'time',
    ];
}
