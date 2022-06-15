<?php
namespace App\Http\Services;
use App\Models\image_product;
use App\Models\images;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\TryCatch;
class ImageProductService{
    public function create($request,$id){
        try {
           $id_img=image_product::create([
                'product_id'=>(int)$id,
            ]);

            $result=$id_img->id;
        } catch (\Exception $err) {
            return false;
        }
        return $result;
    }
    public function update($request,$id){
        try {
            $id_img=image_product::where('product_id',$id)->get('image_id')->toArray();
            images::where('id',$id_img[0]['image_id'])->update(['img'=>(string)$request]);
        } catch (\Exception $err) {
            return false;
        }
        return true;
    }
   
   
}