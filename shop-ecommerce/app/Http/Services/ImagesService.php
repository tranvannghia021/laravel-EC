<?php
namespace App\Http\Services;
use App\Models\images;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\TryCatch;
class ImagesService{
    public function create($data,$id){
        try {
            images::create([
                'id'=>(int)$id,
                'img'=>(string)$data
            ]);
        } catch (\Exception $err) {
            return false;
        }
        return true;
    }
    public function getId_thumb($id){
        return images::where('id',$id)->get();
    }
}