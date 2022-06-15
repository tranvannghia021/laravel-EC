<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Group_product;


class Product extends Model
{
    use HasFactory;
    protected $fillable=[
        'group_id',
        'name',
        'description',
        'active',
        'created_at',
        'updated_at'
    ];
    public function group_product(){
        return $this->hasMany(Group_product::class,'id','product_id');
    }
}
