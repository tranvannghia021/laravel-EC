<?php

namespace App\Http\Services;

use App\Models\Staffs;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class StaffService
{

    public function findStaff($email)
    {

        return Staffs::select('id', 'role_id', 'email', 'password')->where('email', $email)->where('status',1)->first();
    }
    public function getInFo($id)
    {
        return Staffs::all()->where('id', $id)->first();
    }
    public function getAll()
    {
        return Staffs::orderbyDesc('id')->get();
    }
    public function getSearch($request){
        return Staffs::orderbyDesc('id')
                        ->where('first_name','like','%'.$request->input('search').'%')
                        ->orwhere('last_name','like','%'.$request->input('search').'%')
                        ->get();
    }
    public function getFilter($request){
        $query = Staffs::query();
        if($request->has('role_id') && $request->input('role_id')!=-1){
            $query=$query->where('role_id',$request->input('role_id'));
        }
        if($request->has('status') && $request->input('status')!=-1){
            $query=$query->where('status',$request->input('status'));
        }
        return $query->get();
    }
    public function create($request)
    {

        try {
             Staffs::create([
                'role_id' => (int)$request->input('role_id'),
                'first_name' => (string)$request->input('first_name'),
                'last_name' => (string)$request->input('last_name'),
                'phone' => (string)$request->input('phone'),
                'email' => (string)$request->input('email'),
                'password' => (string)bcrypt($request->input('password')),
                'status' => (int)$request->input('status'),
                'address' => (string)$request->input('address'),
                'start_date' => (string)$request->input('start_date'),
                'end_date' => (string)$request->input('end_date'),

            ]);
        } catch (\Exception $err) {
           // Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }
    public function delete($request){
        $product=Staffs::where('id',$request->input('id'))->first();
        if($product ){
            $product->delete();
            return true;
        }
        return false;
    }
    public function update($request): bool
    {

       
        try {           
            Staffs::where("id", $request->input('id'))->update([
            'role_id' => (int)$request->input('role_id'),
            'first_name' => (string)$request->input('first_name'),
            'last_name' => (string)$request->input('last_name'),
            'phone' => (string)$request->input('phone'),
            'email' => (string)$request->input('email'),
            'password' => (string)bcrypt($request->input('password')),
            'status' => (int)$request->input('status'),
            'address' => (string)$request->input('address'),
            'start_date' => (string)$request->input('start_date'),
            'end_date' => (string)$request->input('end_date'),
            ]);
        
        }  catch (\Exception $err)  {
            // session()->flash('error', 'Cập nhật nhân viên thất bại !!! ');
              //Log::info($err->getMessage());
             return false;
         }
         return true;
        // dd($request->all());
        /* DB::table('staffs')
            ->where('id', $id)
            ->update(['role_id' => (int)$request->input('role_id'),
            'first_name' => (string)$request->input('first_name'),
            'last_name' => (string)$request->input('last_name'),
            'phone' => (string)$request->input('phone'),
            'email' => (string)$request->input('email'),
            'password' => (string)($request->input('password')),
            'status' => (int)$request->input('status'),
            'address' => (string)$request->input('address'),
            'start_date' => (string)$request->input('start_date'),
            'end_date' => (string)$request->input('end_date'),]);
        /* try {
           
            $staff->role_id = (int)$request->input('role_id');
            $staff->first_name = (string)$request->input('first_name');
            $staff->last_name = (string)$request->input('last_name');
            $staff->phone = (string)$request->input('phone');
            $staff->email = (string)$request->input('email');
            $staff->password = (string)bcrypt($request->input('password'));
            $staff->status = (int)$request->input('status');
            $staff->address =(string)$request->input('address');
            $staff->start_date =(string)$request->input('start_date');
            $staff->end_date = (string)$request->input('end_date');
            
           // session()->flash('success', 'Cập nhật nhân viên thành công!!! ');
        }  catch (\Exception $err)  {
           // session()->flash('error', 'Cập nhật nhân viên thất bại !!! ');
            // echo $err->getMessage();
            return  $staff;
        }*/
       // return  $staff;
    }

    /*--- STatictis *************************************************/
   
}

