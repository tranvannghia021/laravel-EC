<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\StaffService;
use Illuminate\Support\Facades\Session;
use App\Http\Services\ProductService;
use App\Http\Services\GroupProduct_Service;
use App\Http\Services\ImagesService;
use App\Http\Services\ImageProductService;
use App\Http\Services\ProductDetailService;
class CategoryController extends Controller
{
    //protected $productService;
    protected $staffService;
     protected $groupProductService;
    // protected $imageProductService;
    // protected $imagesService;
    // protected $productDetailService;
    public function __construct(StaffService $staffService, GroupProduct_Service $groupProductService)
    {
        // $this->productService=$productService;
        $this->staffService=$staffService;
        $this->groupProductService=$groupProductService;
        // $this->groupProductService=$groupProductService;
        // $this->imageProductService=$imageProductService;
        // $this->imagesService=$imagesService;
        // $this->productDetailService=$productDetailService;
    }/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title='Danh mục';
        $staff=$this->staffService->getInFo(Session::get('staff_id'));
        $categories=$this->groupProductService->getAll();

        return view('admin.categories.category',compact('title','staff','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title='Thêm danh mục';
        $staff=$this->staffService->getInFo(Session::get('staff_id'));
        $categorys=$this->groupProductService->getAll();
        return view('admin.categories.add_cate',compact('title','categorys','staff'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
             Session()->flash('error','Cập nhập loại sản phẩm thất bại,vui lòng kiểm tra file ảnh');
                 return redirect()->back();
         }
         if($exe_flag){

            $result=$this->groupProductService->add_Cate($request,$namFile);
            $img->storeAs('public/categories',$namFile);
            if($result){
                Session()->flash('success','Thêm danh mục thành công');
                 return redirect()->route('admin.categories.list');
            }
            Session()->flash('error','Thêm danh mục thất bại');
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
        $title='Sửa danh mục';
        $staff=$this->staffService->getInFo(Session::get('staff_id'));
        $cates=$this->groupProductService->getItems($id);
       
        return view('admin.categories.edit_cate',compact('title','staff','cates'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //     'Cate_name'=>'required|min:4'
        // ],[
        //     'required'=>'Tên danh mục bắt buộc phải nhập',
        //     'min'=>'Tên danh mục không được nhỏ hơn 6 chữ số'
        // ]);
        
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
              Session()->flash('error','Cập nhập danh mục thất bại,vui lòng kiểm tra file ảnh');
                  return redirect()->back();
          }
          if($exe_flag){
 
             $result=$this->groupProductService->update($request,$namFile,$id);
             $img->storeAs('public/categories',$namFile);
             if($result){
                 Session()->flash('success','Thêm danh mục thành công');
                  return redirect()->route('admin.categories.list');
             }
             Session()->flash('error','Thêm danh mục thất bại');
             return redirect()->back();
             }
     }else{
         $result=$this->groupProductService->update($request,$request->input('img'),$id);
       
         if($result){
             Session()->flash('success','Thêm danh mục thành công');
              return redirect()->route('admin.categories.list');
         }
         Session()->flash('error','Thêm danh mục thất bại');
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
        $result=$this->groupProductService->delete($request);
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
