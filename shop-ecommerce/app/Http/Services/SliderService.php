<?php
namespace App\Http\Services;
use App\Models\Slider;
use Illuminate\Support\Facades\Session;


class SliderService{

    public function getSliders(){
        return Slider::where('active',1)->get();
    }
   function getAll(){
       return Slider::all();
   }
   function getSearch($request){
       return Slider::where('name','like','%'.$request->input('search').'%')->get();
   }
   function create($request,$namefile){
       try {
           Slider::create([
               'name'=>$request->input('name'),
               'description'=>$request->input('description'),
               'active'=>$request->input('active'),
               'thumb'=>$namefile
           ]);
       } catch (\Exception $err) {
          return false;
        }
        return true;
   }
   function getItems($id){
      return Slider::where('id',$id)->get();
   }
   function update($request,$namefile,$id){
       try {
           Slider::where('id',$id)->update([
               'name'=>$request->input('name'),
               'description'=>$request->input('description'),
               'active'=>$request->input('active'),
               'thumb'=>$namefile
           ]);
       } catch (\Exception $err) {
           return false;
        }
        return true;
   }
   public function delete($request){
    $id=$request->id;
    $sliders=Slider::where('id',$id)->first();
    if($sliders){
        return Slider::where('id',$id)->delete();
    }
    return false;
}
}