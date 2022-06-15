<?php
namespace App\Http\Services;
use App\Models\Product;
use App\Models\Product_detail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\TryCatch;

class ProductService{
    CONST LIMIT =2;
    public function getPriceOfProduct($id){
            return Product_detail::select('price')->where('id', $id)->first();
    }
    public function getAll(){
        return Product::all();
    }
    public function getArray(){
        return Product::all(['id','name','group_id']);
    }
    public function getCheck(){
        return Product::all(['id','name']);
    }
    public function getName($id){
        return Product::where('id',$id)->get();
    }
    public function findByID($id){
        return Product::where('id',$id)->first();
    }
    public function getAllProduct(){
     
        
        return Product::join('image_products','image_products.product_id','=','products.id')
        ->join('images','images.id','=','image_products.image_id')
        ->join('group_products','group_products.id','=','products.group_id')
        ->join('product_details','product_details.product_id','=','products.id')
        ->orderBy('products.id', 'DESC')
        ->get(['products.id','group_products.name','group_products.id as group_products_id','products.name as name_product','description','price','amount','active','code_color','img'])
        ;
    }
    public function getProduct($id){
        return Product::join('image_products','image_products.product_id','=','products.id')
        ->join('images','images.id','=','image_products.image_id')
        ->join('group_products','group_products.id','=','products.group_id')
        ->join('product_details','product_details.product_id','=','products.id')
        ->where('products.id',$id)
        ->get(['group_products.id as cate_id','products.id','group_products.name','products.name as name_product','description','price','amount','active','code_color','images.img'])
        ->first();
    }
    public function getRelativeProducts($id='',$group_id=''){
        return Product::join('image_products','image_products.product_id','=','products.id')
        ->join('images','images.id','=','image_products.image_id')
        ->join('group_products','group_products.id','=','products.group_id')
        ->join('product_details','product_details.product_id','=','products.id')
        ->where('products.id','!=',$id)
        ->where('products.group_id',$group_id)
        ->orderBy('products.created_at', 'DESC')
        ->get(['group_products.id as cate_id','products.id','group_products.name','products.name as name_product','description','price','amount','active','code_color','images.img'])
        ;
    }
    public function getNewArrivalProducts(){
     
        
        return Product::join('image_products','image_products.product_id','=','products.id')
        ->join('images','images.id','=','image_products.image_id')
        ->join('group_products','group_products.id','=','products.group_id')
        ->join('product_details','product_details.product_id','=','products.id')
        ->orderBy('products.created_at', 'DESC')
        ->skip(0)->take(8)
        ->get(['products.id','group_products.name','products.name as name_product','description','price','amount','active','code_color','images.img'])
        ;
    }
  
    public function create($request){
       try {
          $products=Product::create([
                'group_id'=>(int)$request->input('Category'),
                'name'=>(string)$request->input('Product_name'),
                'description'=>(string)$request->input('Description'),
                'active'=>(int)$request->input('active')
          ]);
          $id=$products->id;

       } catch (\Exception $err) {
           return false;
       }
       return $id;
    }
    public function getToCate($id_cate,$id_product){
        return Product::join('group_products','group_products.id','=','products.group_id')
                        ->where('products.group_id',$id_cate)
                        ->where('products.id',$id_product)
                        ->get(['products.name as name_product','group_products.name as name_cate','products.id as id_product']);
    }
       
    public function getSearch($request){
        return Product::join('image_products','image_products.product_id','=','products.id')
        ->join('images','images.id','=','image_products.image_id')
        ->join('group_products','group_products.id','=','products.group_id')
        ->join('product_details','product_details.product_id','=','products.id')
        ->orderBy('products.id', 'DESC')->where('products.name','like','%'.$request->input('search').'%')
        ->get(['products.id','group_products.name','products.name as name_product','description','price','amount','active','code_color','img'])
        ;
    }
    public function createDetail($request,$id){
        try {
            Product_detail::create([
                'product_id'=>(int)$id,
                'code_color'=>(string)$request->input('Code_color'),
                'amount'=>(int)$request->input('Amount'),
                'price'=>(int)$request->input('Price')
            ]);
        } catch (\Exception $err) {
            return false;
        }
        return true;
    }
    public function updateActive($request){
        if($request->input('active')==1){
            $active=0;
        }else{
            $active=1;

        }
        try {
            Product::where('id',$request->input('id'))->update([
                
                'active'=>(int)$active
            ]);
        } catch (\Exception $err) {
            return false;
        }
        return true;
    }
    public function update($request,$id){
        try {
            Product::where('id',$id)->update([
                'group_id'=>(int)$request->input('Category'),
                'name'=>(string)$request->input('Product_name'),
                'description'=>(string)$request->input('Description'),
                'active'=>(int)$request->input('active')
            ]);
           Product_detail::where('product_id',$id)->update([
               'code_color'=>(string)$request->input('Code_color'),
               'amount'=>(int)$request->input('Amount'),
               'price'=>(int)$request->input('Price')
           ]);
        } catch (\Exception $err) {
            return false;
        }
        return true;
    }
    public function getListProducts($request){
        $query = Product::select(['products.id','group_products.name','group_products.id as group_products_id','products.name as name_product','description','price','amount','active','code_color','img'])
        ->join('image_products','image_products.product_id','=','products.id')
        ->join('images','images.id','=','image_products.image_id')
        ->join('group_products','group_products.id','=','products.group_id')
        ->join('product_details','product_details.product_id','=','products.id')
        ->where('active',1);
        if(!$request->has('search-product')){
        if($request->has('price_start')){
            $query= $query->where('product_details.price','>=',$request->input('price_start'));
         }
        if($request->has('price_end')){
            $query= $query->where('product_details.price','<=',$request->input('price_end'));
         }
        if($request->has('price')){
            $query= $query->orderBy('price',$request->input('price'));
         }
        }
        else {
            $query=$query->where('products.name', 'LIKE', "%{$request->input('search-product')}%");
        }
       
        return $query
        ->paginate(32)
        ->withQueryString();
    }
    public function getListProductSortby($request,$id){
        $query = Product::select(['products.id','group_products.name','group_products.id as group_products_id','products.name as name_product','description','price','amount','active','code_color','img'])
        ->join('image_products','image_products.product_id','=','products.id')
        ->join('images','images.id','=','image_products.image_id')
        ->join('group_products','group_products.id','=','products.group_id')
        ->join('product_details','product_details.product_id','=','products.id')
        ->where('group_products.id','=',$id)
        ->where('active',1);
        if(!$request->has('search-product')){
        if($request->has('price_start')){
            $query= $query->where('product_details.price','>=',$request->input('price_start'));
         }
        if($request->has('price_end')){
            $query= $query->where('product_details.price','<=',$request->input('price_end'));
         }
        if($request->has('price')){
            $query= $query->orderBy('price',$request->input('price'));
         }
        }
        else {
            $query=$query->where('products.name', 'LIKE', "%{$request->input('search-product')}%");
        }
       
        return $query
        ->paginate(32)
        ->withQueryString();
    }
    public function loadProduct($page=null){
        return Product::select(['products.id','group_products.name','group_products.id as group_products_id','products.name as name_product','description','price','amount','active','code_color','img'])
        ->join('image_products','image_products.product_id','=','products.id')
        ->join('images','images.id','=','image_products.image_id')
        ->join('group_products','group_products.id','=','products.group_id')
        ->join('product_details','product_details.product_id','=','products.id')
        ->where('active',1)
        ->when($page!=null,function($query) use ($page){
                $offset=$page*self::LIMIT;
                $query->offset($offset);
        })
        ->limit(self::LIMIT)
        ->orderbyDesc('id')
        ->get();
    }
}