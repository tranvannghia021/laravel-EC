<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class Image_product extends Model
{
    use HasFactory;
    protected $fillable=[
        'product_id',
    ];
    public function product(){
        return $this->hasMany(Product::class,'id','product_id');
    }
}
