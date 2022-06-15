<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Services\StaffService;
use App\Http\Services\SliderService;
class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $staffService;
    protected $sliderService;
    public function __construct(StaffService $staffService ,SliderService $sliderService)
    {
        $this->staffService=$staffService;
        $this->sliderService=$sliderService;
    }
    public function index()
    {
        $title='Danh sách thanh trược';
        $staff=$this->staffService->getInFo(Session::get('staff_id'));
        $sliders=$this->sliderService->getAll();

        return view('admin.sliders.slider',compact('title','staff','sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title='Thêm thanh trược';
        $staff=$this->staffService->getInFo(Session::get('staff_id'));
        

        return view('admin.sliders.add_slider',compact('title','staff'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->file('thumb')){
            $img=$request->thumb;
             $file_extension=['png','jpg','jpeg'];
             $extension=$img->getClientOriginalExtension();
             $namFile=$img->getClientOriginalName();
             $exe_flag=true;
             //check đuôi file
             $check=in_array($extension,$file_extension);
             if(!$check){
                 $exe_flag=false;
                 Session()->flash('error','Thêm slider thất bại,vui lòng kiểm tra file ảnh');
                     return redirect()->back();
             }
             //luu database
                  if($exe_flag){
                        $result=$this->sliderService->create($request,$namFile);
                        $img->storeAs('public/sliders',$namFile);

                     }else{
                         Session()->flash('error','Thêm slider thất bại');
                         return redirect()->back();
                     }
                     if($result){
                         Session()->flash('success','Thêm slider thành công');
                         return redirect()->route('admin.sliders.list');
                     }else{
                         Session()->flash('error','Thêm slider thất bại!');
                         return redirect()->back();
                     }
        
       
    }
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $title='Sửa thanh trược';
        $staff=$this->staffService->getInFo(Session::get('staff_id'));
        $sliders=$this->sliderService->getItems($id);

        return view('admin.sliders.edit_slider',compact('title','staff','sliders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $title='Danh sách thanh trược';
        $staff=$this->staffService->getInFo(Session::get('staff_id'));
        $sliders=$this->sliderService->getSearch($request);

        return view('admin.sliders.slider',compact('title','staff','sliders'));
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
        if($request->file('thumb'))
       {
        $img=$request->thumb;
        $file_extension=['png','jpg','jpeg'];
        $extension=$img->getClientOriginalExtension();
        $namFile=$img->getClientOriginalName();
        $exe_flag=true;
        //check đuôi file
        $check=in_array($extension,$file_extension);
        if(!$check){
            $exe_flag=false;
            Session()->flash('error','Thêm slider thất bại,vui lòng kiểm tra file ảnh');
                return redirect()->back();
        }
         if($exe_flag){
            $result=$this->sliderService->update($request,$namFile,$id);
            $img->storeAs('public/sliders',$namFile);

         }else{
             Session()->flash('error','Thêm slider thất bại');
             return redirect()->back();
         }
         if($result){
             Session()->flash('success','Thêm slider thành công');
             return redirect()->route('admin.sliders.list');
         }else{
             Session()->flash('error','Thêm slider thất bại!');
             return redirect()->back();
         }
        

    }else{
        $result=$this->sliderService->update($request,$request->input('img'),$id);
    
        if($result){
            Session()->flash('success','Cập nhập thành công');
            return redirect()->route('admin.sliders.list');
           }
           Session()->flash('error','Cập nhập thất bại');
           return redirect()->back();
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $result=$this->sliderService->delete($request);
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
