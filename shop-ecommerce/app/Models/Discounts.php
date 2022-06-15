<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discounts extends Model
{
    use HasFactory;
    protected $fillable=[
    'id',
    'name',
    'value',
    'status',
    'description',
    'start_date',
    'end_date',
    ];

}
