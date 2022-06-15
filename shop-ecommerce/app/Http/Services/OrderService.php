<?php
namespace App\Http\Services;
use App\Models\Orders;
use App\Models\OrderDetail;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderService{
 
    public function getOrderLast(){
        return Orders::select('id')->orderByDesc('created_at')->first();
    }
    public function getAll(){
        return Orders::join('order_details','order_details.order_id','=','orders.id')
                        ->join('customers','customers.id','=','orders.customer_id')
                        ->distinct('orders.id')
                        ->get(['orders.id','discount_value','customers.first_name','customers.last_name','orders.status as status_order','orders.total_price','Orders.created_at']);
        

    }
    public function getSearch($request){
        $orders= Orders::join('order_details','order_details.order_id','=','orders.id')
        ->join('customers','customers.id','=','orders.customer_id')
        ->where('orders.created_at','>=',$request->input('start_date'))
        ->where('orders.created_at','<=',$request->input('end_date'))
        ->distinct('orders.id');
        if(!is_null($request->input('name_customer'))){
            $orders->where('customers.first_name','like','%'.$request->input('name_customer').'%')->orwhere('customers.last_name','like','%'.$request->input('name_customer').'%');
        }
        if(!is_null($request->input('status'))){
            $orders->where('orders.status',$request->input('status'));
        }
        if(!is_null($request->input('discount'))){
            $orders->where('discount_value',$request->input('discount'));
        }
        return $orders->get(['orders.id','discount_value','customers.first_name','customers.last_name','orders.status as status_order','orders.total_price','Orders.created_at']);


    }
    public function getStatus(){
        return Orders::join('order_details','order_details.order_id','=','orders.id')
                        ->join('customers','customers.id','=','orders.customer_id')
                        ->distinct('orders.id')->where('orders.status',1)
                        ->get(['orders.id','discount_value','customers.first_name','customers.last_name','orders.status as status_order','orders.total_price']);
        

    }
    public function getItem($id){
        return Orders::join('order_details','order_details.order_id','=','orders.id')
                        ->join('customers','customers.id','=','orders.customer_id')
                        ->join('products','products.id','=','order_details.product_id')
                        ->join('image_products','image_products.product_id','=','products.id')
                        ->join('images','images.id','=','image_products.image_id')->distinct('orders.id')
                        ->where('orders.id',$id)
                        ->get([
                            'orders.id as id_order',
                            'orders.status',
                            'customers.id',
                            'customers.first_name',
                            'customers.last_name',
                            'customers.phone',
                            'customers.email',
                            'orders.created_at',
                            'orders.address as address_orders',
                            'images.img',
                            'products.name',
                            'order_details.price',
                            'order_details.amount as amount_detail',
                            'orders.discount_value'
                        ]);
    }
    public function getbyCustomerId($customer_id){
        return Orders::join('customers','customers.id','=','orders.customer_id')->distinct('orders.id')
                        ->where('customers.id',$customer_id)
                        ->get(['orders.id as order_id','orders.payment_method_id','orders.status as status_order','orders.address as address_orders','orders.created_at','orders.discount_value','orders.total_price']);
    }

    public function getListProductOrderDetails($id){
        return Orders::join('order_details','order_details.order_id','=','orders.id')
        ->join('products','products.id','=','order_details.product_id')                      
        ->where('orders.id',$id)
        ->get(['products.id as product_id','products.name as product_name','order_details.amount as amount_detail',]);
    }
    public function update($request,$id){
        try {
            Orders::where('id',$id)->update(['status'=>$request]);
            

        } catch (\Exception $err) {
            
            return false;
        }
        return true;
    }
    public function setStatus($id,$status){
        try {
            Orders::where('id',$id)->update(['status'=>$status]);
            

        } catch (\Exception $err) {
            
            return false;
        }
        return true;
    }
    public function check($id_cus,$id_product){
      
          $result= Orders::join('order_details','order_details.order_id','=','Orders.id')
                    ->where('customer_id',$id_cus)->where('product_id',$id_product)->get();
                
       if(count($result) !=0){
           return true;
       }else{
           return false;
       }
    }

    /*---Statistics****************/
    public function getStatisticsOrderInMonth($month,$year){
        return Orders::join('order_details','order_details.order_id','=','orders.id');
    }

    // đơn hàng mới:
    public function getStatisticsNewOrder(){
        return Orders::where('created_at','>',date('Y-m-d'))->count();
        //select count(*) as new_order from orders where created_at > '2022-05-19'
    }
    public function getStatisticsNewRevenue(){
        return Orders::where('created_at','>',date('Y-m-d'))->sum('total_price');
        //select count(*) as new_order from orders where created_at > '2022-05-19'
    }
    public function getStatisticsNewCanceled(){
        return Orders::where('status',5)->where('updated_at','>',date('Y-m-d'))->count();
        //select count(*) as new_order from orders where created_at > '2022-05-19'
    }
    public function getStatisticsMostCancelOrder(){
        return Orders::select('customers.id',DB::raw('COUNT(*)AS number_cancel'))
        ->join('customers','customers.id','=','orders.customer_id')
        ->where('orders.status',5)->where('orders.updated_at','>',date('Y-m-d'))
        ->groupby('customers.id')
        ->skip(0)->take(5)->get();
    }
    public function getOrderInLongTime($start,$end){
        return Orders::select(DB::raw('DATE(created_at) as date'),DB::raw('COUNT(*)AS amount_order'))
       // ->where('status',6)
        ->groupBy('date')
        ->havingRaw('date  BETWEEN ? AND ?',  [''.$start.'', ''.$end.''])->get();
        //SELECT created_at, COUNT(created_at) FROM orders GROUP BY created_at HAVING (created_at BETWEEN '2022-05-14' AND '2022-05-20')

    }
    public function getRevenueInLongTime($start,$end){
        return Orders::select(DB::raw('DATE(created_at) as date') ,DB::raw('SUM(total_price)AS total_price'))
        ->groupBy('date')
        ->havingRaw('date  BETWEEN ? AND ?',  [''.$start.'', ''.$end.''])->get();

       // DB::select("select `created_at`, SUM(total_price)AS total_price from `orders` group by DATE(`created_at`) having created_at 
       // BETWEEN '$start' AND '$end'");
        //SELECT created_at, COUNT(created_at) FROM orders GROUP BY created_at HAVING (created_at BETWEEN '2022-05-14' AND '2022-05-20')
    }
    public function Order_InDate($start_date, $end_date){
     
        return DB::select('SELECT created_at, COUNT(created_at) 
        FROM `orders` 
        GROUP BY created_at 
        HAVING (created_at BETWEEN $start_date AND $end_date)');
  
    }

    public function Order_turnoverInMonth(){
        return DB::select('SELECT SUM(total_price) 
        FROM `orders` 
        WHERE MONTH(created_at) = MONTH(CURRENT_DATE())');
  
    }    

    public function Order_cancelInMonth(){
        return DB::select('SELECT COUNT(*) 
        FROM `orders` 
        WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) 
        AND status = 2;');
  
    }
}