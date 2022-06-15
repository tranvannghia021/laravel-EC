<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\StaffService;
use App\Http\Services\DiscountService;
use Illuminate\Support\Facades\Session;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $staffService;
    protected $discountService;
    public function __construct(StaffService $staffService, DiscountService $discountService)
    {
        $this->staffService=$staffService;
        $this->discountService=$discountService;
    }
    public function index()
    {
        
        
        $title='Mã giảm giá';
        $staff=$this->staffService->getInFo(Session::get('staff_id'));
        $discounts=$this->discountService->getAll();
         return view('admin.discounts.discount',compact('title','staff','discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title='Thêm mã giảm giá';
        $staff=$this->staffService->getInFo(Session::get('staff_id'));
        $discounts=$this->discountService->getAll();
        return view('admin.discounts.add_discount',compact('title','discounts','staff'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $valadate=$request->validate([
        //     'dis_name'=>'required|min:4',
        //     'dis_value'=>'required|integer',
        //     'dis_description'=>'required',
        //     'start_date'=>'required',
        //     'end_date'=>'required'
        // ],[
        //     'dis_name.required' =>'Tên mã giảm giá bắt buộc phải nhập',
        //     'dis_value.required'=>'phần trăm giảm giá bắt buộc phải nhập',
        //     'dis_description.required'=>'Chi tiết giảm giá bắt buộc phải nhập',
        //     'start_date.required'=>'Ngày bắt đầu giảm giá bắt buộc phải nhập',
        //     'end_date.required'=>'Ngày kết thúc giảm giá bắt buộc phải nhập',
        //     'dis_name.min'=>'Tên mã giảm giá phải trên :min ký tự',
        //     'dis_value.integer'=>'Phải là chữ số'
        // ]); 

        $result=$this->discountService->create($request);
        if($result){
            Session()->flash('success','Cập nhập thành công');
            return redirect()->route('admin.discounts.list');
        }
        Session()->flash('error','Cập nhập thất bại ');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title='Sửa mã giảm giá';
        $staff=$this->staffService->getInFo(Session::get('staff_id'));
       $discount=$this->discountService->getItems($id)->toArray();
       
      
        return view('admin.discounts.edit_discount',compact('title','staff','discount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        
        $title='Mã giảm giá';
        $staff=$this->staffService->getInFo(Session::get('staff_id'));
        $discounts=$this->discountService->getSearch($request);
       
         return view('admin.discounts.discount',compact('title','staff','discounts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $valadate=$request->validate([
        //     'dis_name'=>'required|min:4',
        //     'dis_value'=>'required|integer',
        //     'dis_description'=>'required',
        //     'start_date'=>'required',
        //     'end_date'=>'required'
        // ],[
        //     'dis_name.required' =>'Tên mã giảm giá bắt buộc phải nhập',
        //     'dis_value.required'=>'phần trăm giảm giá bắt buộc phải nhập',
        //     'dis_description.required'=>'Chi tiết giảm giá bắt buộc phải nhập',
        //     'start_date.required'=>'Ngày bắt đầu giảm giá bắt buộc phải nhập',
        //     'end_date.required'=>'Ngày kết thúc giảm giá bắt buộc phải nhập',
        //     'dis_name.min'=>'Tên mã giảm giá phải trên :min ký tự',
        //     'dis_value.integer'=>'Phải là chữ số'
        // ]); 
       $result= $this->discountService->update($request,$id);
       if($result){
           Session()->flash('success','Cập nhập thành công');
           return redirect()->route('admin.discounts.list');
       }
       Session()->flash('error','Cập nhập thất bại ');
       return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $result=$this->discountService->delete($request);
        if($result){
           return response()->json([
                'error'=>false,
                'message'=>'Xóa thành công danh mục'
            ]);
        }
        return response()->json([
            'error'=>true
        ]);
    }
}
