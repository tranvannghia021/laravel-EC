<?php
namespace App\Http\Services;
use App\Models\Providers;


use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\TryCatch;

class ProviderService{
    public function getAll(){
        return Providers::all();
    }
    public function getId($id){
        return Providers::where('id',$id)->get();
    }
    public function create($request){
        try {
            Providers::create([
                'name'=>$request->input('name'),
                'address'=>$request->input('address'),
                'phones'=>$request->input('phone')
            ]);
        } catch (\Exception $err) {
            return false;
        }
        return true;
    }
    public function update($request){
        try {
            Providers::where('id',$request->input('id'))->update([
                'name'=>$request->input('name'),
                'address'=>$request->input('address'),
                'phones'=>$request->input('phone')
            ]);
          
        } catch (\Exception $err) {
            return false;
        }
        return true;
    }
    public function getItems($id){
        return Providers::where('id',$id)->get();
    }
    public function delete($request){
        $Providers=Providers::where('id',$request->input('id'))->first();
        if($Providers ){
            $Providers->delete();
            return true;
        }
        return false;
    }
}