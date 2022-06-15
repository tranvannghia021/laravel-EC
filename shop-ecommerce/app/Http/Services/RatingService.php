<?php
namespace App\Http\Services;
use App\Models\Ratings;

use Illuminate\Support\Facades\Session;

class RatingService{
    public function getAll(){
        return Ratings::join('products','products.id','=','ratings.product_id')
                        ->join('customers','customers.id','=','ratings.customer_id')
                        ->join('image_products','image_products.product_id','=','products.id')
                        ->join('images','images.id','=','image_products.image_id')
                        ->orderBy('ratings.id', 'DESC')
                        ->get([
                                'ratings.id as id_rating',
                                'customers.first_name',
                                'customers.last_name',
                                'ratings.context',
                                'ratings.point',
                                'products.name',
                                'images.img',
                                'ratings.created_at']);
    }
   
    public function getSearch($request){
        $ratings= Ratings::join('products','products.id','=','ratings.product_id')
        ->join('customers','customers.id','=','ratings.customer_id')
        ->join('image_products','image_products.product_id','=','products.id')
        ->join('images','images.id','=','image_products.image_id')
        ->where('ratings.created_at','>=',$request->input('start_date'))
         ->where('ratings.created_at','<=',$request->input('end_date'))
       
        ->orderBy('ratings.id', 'DESC');
        
       if(!is_null($request->input('name_product'))){
          
           $ratings->where('products.name','like','%'.$request->input('name_product').'%');
       }
       if(!is_null($request->input('point'))){
           $ratings->where('ratings.point',$request->input('point'));
            
       }
       if(!is_null($request->input('category'))){
        $ratings->where('products.group_id',$request->input('category'));

       }
        return $ratings->get([
            'ratings.id as id_rating',
            'customers.first_name',
            'customers.last_name',
            'ratings.context',
            'ratings.point',
            'products.name',
            'products.group_id',
            'images.img','ratings.created_at']);

    }
    public function getPoint($point){
        return Ratings::join('products','products.id','=','ratings.product_id')
                        ->join('customers','customers.id','=','ratings.customer_id')
                        ->join('image_products','image_products.product_id','=','products.id')
                        ->join('images','images.id','=','image_products.image_id')
                        ->where('ratings.point',$point)->orderBy('ratings.id', 'DESC')
                        ->get([
                                'ratings.id as id_rating',
                                'customers.first_name',
                                'customers.last_name',
                                'ratings.context',
                                'ratings.point',
                                'products.name',
                                'images.img']);
    }
   public function getAll_oneIdProduct($id){
       return Ratings::join('customers','customers.id','=','ratings.customer_id')
       ->where('product_id',$id)->get();
   }
   public function create($request,$id_cus){
       try {
           Ratings::create([
               'customer_id'=>$id_cus,
               'product_id'=>$request->input('product_id'),
               'point'=>$request->input('point'),
               'context'=>$request->input('context'),
               'image'=>'null'
           ]);
       } catch (\Exception $err) {
            return false;
        }
        return true;
   }
}