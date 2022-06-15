<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\Image_product;

class images extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'img',
    ];
    public function image_product(){
        return  $this->hasMany(Image_product::class,'image_id','id');
    }
}
