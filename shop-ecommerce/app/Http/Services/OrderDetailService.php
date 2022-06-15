<?php
namespace App\Http\Services;
use App\Models\Orders;
use App\Models\OrderDetail;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderDetailService{
    
    public function getBestSellerProducts(){
        return  OrderDetail::select('order_details.product_id',DB::raw('SUM(order_details.amount ) AS Amount'))
        ->groupBy('order_details.product_id')
        ->orderBy('Amount', 'DESC')
        ->skip(0)->take(8)
        ->get();
    }
    public function getItem($id){
        return OrderDetail::join('orders','orders.id','=','order_details.order_id')
                        ->join('products','products.id','=','order_details.product_id')
                        ->join('product_details','product_details.product_id','=','products.id')
                        ->join('image_products','image_products.product_id','=','products.id')        
                        ->join('images','images.id','=','image_products.image_id')              
                        ->where('order_details.order_id',$id)
                        ->get(['orders.status as status_order','products.name','order_details.amount as amount_detail','orders.payment_method_id',
                        'product_details.price as product_price','product_details.code_color','products.id as product_id',
                        'orders.address as address_orders','orders.created_at','orders.discount_value','images.img']);
    }
    //Thống kê
    public function statisTical($month){
     
        return DB::select('select group_products.name, count(group_products.id) as Tong from order_details 
        INNER JOIN products ON products.id= order_details.product_id 
        INNER JOIN group_products ON group_products.id=products.group_id
         WHERE MONTH(order_details.created_at) = '.$month.'  GROUP BY group_products.name ');
    }
  
}