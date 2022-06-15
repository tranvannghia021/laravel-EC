<?php
namespace App\Http\Services;
use App\Models\GroupProduct;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Command\DumpCompletionCommand;

class GroupProduct_Service{
    public function getAll(){
        return GroupProduct::all();
    }
    public function getItems($id){
        return GroupProduct::where('id',$id)->get();
    }
    public function add_Cate($request,$namefile){
        try {
            GroupProduct::create([
                'name'=> $request->input('Cate_name'),
                'thumb'=>$namefile
            ]);
            
        } catch (\Exception $err) {
            
            return false;
        }
        return true;
    }
    public function update($request,$namefile,$id){
       try {
        GroupProduct::where('id',$id)->update([
            'name'=>$request->input('Cate_name'),
            'thumb'=>$namefile

    
    ]);
       } catch (\Exception $err) {
           return false;
        }
        return true;
    }
    public function delete($request){
        $id=$request->id;
        $category=GroupProduct::where('id',$id)->first();
        if($category){
            return GroupProduct::where('id',$id)->delete();
        }
        return false;
    }
}