<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportDetails extends Model
{
    use HasFactory;
    public $timestamps = true; 
    protected $fillable=[
        'import_id',
        'product_id',
        'category_id',
        'provider_id',
        'amount',
        'price'
    ];
}
