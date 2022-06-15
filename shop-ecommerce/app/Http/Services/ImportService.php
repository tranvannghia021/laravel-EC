<?php
namespace App\Http\Services;
use App\Models\Imports;
use App\Models\ImportDetails;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\TryCatch;

class ImportService{
    public function getAll(){
        return Imports::orderBy('id', 'DESC')->get();
    }
    public function search($request){
        return Imports::where('created_at','>=',$request->input('start_date'))
                        ->where('created_at','<=',$request->input('end_date'))->get();
    }
    public function getItems($id){
        return Imports::join('import_details','import_details.import_id','=','imports.id')
                        ->where('id',$id)->get();
    }
    public function addSession($request){
        $qty = (int)$request->input('amount');
        $product_id = (int)$request->input('product');
        $category=(int)$request->input('category');
        $price=(int)$request->input('price');
        $provider=(int)$request->input('name_provider');
    

        if ($qty <= 0 || $product_id <= 0) {
            //  Session::flash('error', 'Số lượng hoặc Sản phẩm không chính xác');
            return false;
        }
            
        $imports = Session::get('imports');
        if (!is_null($imports)) {
            $id=count($imports);
            
           $imports[$id] = [
                'id'=>$id,
                'provide_id'=>$provider,
                'category_id'=>$category,
                'product_id'=>$product_id,
                'amount'=>$qty,
                'price'=>$price
                
            ];
            Session::put('imports',$imports);
            return true;
        }else{
            $imports[0] =[
                'id'=>0,
            'provide_id'=>$provider,
            'category_id'=>$category,
            'product_id'=>$product_id,
            'amount'=>$qty,
            'price'=>$price
            
        ];
        Session::put('imports',$imports);
        return true;
        }

       
      
    }
    public function create($imports){
        $priceTotal=0;
        foreach($imports as $i){
            $priceTotal+=($i['price']*$i['amount']);
        }
        
        try {
            $id_last=Imports::create([
                'total_price'=>$priceTotal,
            ]);
            foreach($imports as $import){
                ImportDetails::create([
                'import_id'=>$id_last->id,
                'product_id'=>(int)$import['product_id'],
                'category_id'=>(int)$import['category_id'],
                'provider_id'=>(int)$import['provide_id'],
                'amount'=>(int)$import['amount'],
                'price'=>(int)$import['price'],
            ]);
            }
        } catch (\Exception $err) {
            return false;
        }
        return true;
    }
    public function delete($request){
        $imports=Session::get('imports');
        if(is_null($imports)) return false;
        array_splice($imports, $request->input('id'), 1);
        Session::put('imports',$imports);
        return true;
        
        
    } 
}