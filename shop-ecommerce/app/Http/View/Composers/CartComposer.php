<?php

namespace App\Http\View\Composers;
 
use App\Repositories\UserRepository;
use Illuminate\View\View;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
 
class CartComposer
{
 
    public function __construct()
    {
        
    }
 
    
    public function compose(View $view)
    {
        $carts = Session::get('carts');
        if (is_null($carts)) $product_cart=[];
        else {
        $product_id=array_keys($carts);
        $product_cart=Product::join('image_products','image_products.product_id','=','products.id')
        ->join('images','images.id','=','image_products.image_id')
        ->join('group_products','group_products.id','=','products.group_id')
        ->join('product_details','product_details.product_id','=','products.id')
        ->where('active',1)
        ->whereIn('products.id',$product_id)
        ->get(['group_products.id as cate_id','products.id','group_products.name','products.name as name_product','description','price','amount','active','code_color','images.img']);

        }
        $view->with('product_cart', $product_cart)
        ->with('cart_qty',$carts);
    }
}