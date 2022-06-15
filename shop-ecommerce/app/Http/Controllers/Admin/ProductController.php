<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\ProductService;
use App\Http\Services\GroupProduct_Service;
use App\Http\Services\ImagesService;
use App\Http\Services\ImageProductService;
use App\Http\Services\RatingService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Http\Services\StaffService;
use PHPUnit\Framework\Constraint\Count;

class ProductController extends Controller
{
    protected $productService;
    protected $staffService;
    protected $groupProductService;
    protected $imageProductService;
    protected $imagesService;
    protected $ratingService;
    public function __construct(ProductService $productService,
                                StaffService $staffService,
                                GroupProduct_Service $groupProductService,
                                ImageProductService $imageProductService,
                                ImagesService $imagesService,
                                RatingService $ratingService)
    {
        $this->productService=$productService;
        $this->staffService=$staffService;
        $this->groupProductService=$groupProductService;
        $this->imageProductService=$imageProductService;
        $this->imagesService=$imagesService;
        $this->ratingService=$ratingService;
       
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title='Danh sách sản phẩm';
        $products=$this->productService->getAllProduct();
  
        $staff=$this->staffService->getInFo(Session::get('staff_id'));

        return view('admin.products.products',compact('title','products','staff'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $title='Thêm sản phẩm';
        $staff=$this->staffService->getInFo(Session::get('staff_id'));
        $categorys=$this->groupProductService->getAll();
        $products=$this->productService->getCheck();

      
        return view('admin.products.add_product',compact('title','staff','products','categorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        
       // handle 1 file
   
       
       if($request->file('Img_link')){
           $img=$request->Img_link;
            $file_extension=['png','jpg','jpeg'];
            $extension=$img->getClientOriginalExtension();
            $namFile=$img->getClientOriginalName();
            $exe_flag=true;
            //check đuôi file
            $check=in_array($extension,$file_extension);
            if(!$check){
                $exe_flag=false;
                Session()->flash('error','Thêm sản phẩm thất bại,vui lòng kiểm tra file ảnh');
                    return redirect()->back();
            }
            //luu database
                 if($exe_flag){
                        $id=$this->productService->create($request);
                        if(!empty($id)){
                               $this->productService->createDetail($request,$id); 
                               $id_img=$this->imageProductService->create($request ,$id);

                                $img->storeAs('public/uploads',$namFile);
                              // Storage::disk('local')->put($namFile,'img');
                                $result=$this->imagesService->create($namFile,$id_img);   
                        }
                    }else{
                        Session()->flash('error','Thêm sản phẩm thất bại');
                        return redirect()->back();
                    }
                    if($result){
                        Session()->flash('success','Thêm sản phẩm thành công');
                        return redirect()->route('admin.products.list');
                    }else{
                        Session()->flash('error','Thêm sản phẩm thất bại!');
                        return redirect()->back();
                    }

            
       }
        // handle nhiều file (not delete :>>>)
        // if($request->file('Img_link')){
        //     $file_extension=['png','jpg','jpeg'];
        //     $files=$request->file('Img_link');
        //     $exe_flag=true;
        //     //check đuôi file
        //     foreach($files as $file){
        //         $extension=$file->getClientOriginalExtension();
        //         $check=in_array($extension,$file_extension);
        //         if(!$check){
        //             $exe_flag=false;
        //             Session()->flash('error','Thêm sản phẩm thất bại,vui lòng kiểm tra file ảnh');
        //             return redirect()->back();
        //         }
        //     }
        //     //luu databasse
        //     if($exe_flag){
        //         $id=$this->productService->create($request);
        //         if(!empty($id)){
        //                $this->productService->createDetail($request,$id); 
        //                $id_img=$this->imageProductService->create($request ,$id);
        //                foreach($request->Img_link as $img){
        //                 $img->storeAs('Images',$img->getClientOriginalName());
                     
        //                 $result=$this->imagesService->create($img->getClientOriginalName(),$id_img);

                        
        //             }
                    
        //         }
        //     }else{
        //         Session()->flash('error','Thêm sản phẩm thất bại');
        //         return redirect()->back();
        //     }
        //     if($result){
        //         Session()->flash('success','Thêm sản phẩm thành công');
        //         return redirect()->route('admin.products.list');
        //     }else{
        //         Session()->flash('error','Thêm sản phẩm thất bại!');
        //         return redirect()->back();
        //     }
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title='Sửa sản phẩm';
        $staff=$this->staffService->getInFo(Session::get('staff_id'));
        $product=$this->productService->getProduct($id)->toArray();
        $categorys=$this->groupProductService->getAll();
        $thumbs=$this->imagesService->getId_thumb($id);
        foreach($thumbs as $thum){
           $thums= $thum->img;
           
        }
        
        return view('admin.products.edit_product',compact('title','product','staff','categorys','thums'));
    }
    public function active(Request $request){
        $result=$this->productService->updateActive($request);
        if ($result)  
        {
           
           return response()->json([
              'error' => false,
              'products'=>$this->productService->getAllProduct()
          ]);
        }
      else
         {
           return response()->json([
               'error' => true,
              'message' => "Có lỗi!!!"
          ]);
         }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $title='Danh sách sản phẩm';
        $products=$this->productService->getSearch($request);
        
  
        $staff=$this->staffService->getInFo(Session::get('staff_id'));

        return view('admin.products.products',compact('title','products','staff'));
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
        // $validated = $request->validate([
        //     'Product_name' => 'required|min:6',
        //     'Category' => 'required',
        //     'Amount' => 'required|integer',
        //     'Price' => 'required|integer',
           
        // ],[
        //     'Product_name.required'=>'Tên sản phẩm phải bắt buộc',
        //     'Product_name.min'=>'Tên sản phẩm không được nhỏ hơn 6 ký tự',
        //     'Category.required'=>'Tên danh mục phải bắt buộc',
        //     'Amount.required'=>'Số lượng sản phẩm phải bắt buộc',
        //     'Amount.integer'=>'Số lượng sản phẩm phải là chữ số',
        //     'Price.required'=>'Giá sản phẩm phải bắt buộc',
        //     'Price.integer'=>'Giá sản phẩm phải là chữ số',
            

        // ]);
          
       if($request->file('Img_link'))
       {
        $img=$request->Img_link;
         $file_extension=['png','jpg','jpeg'];
         $extension=$img->getClientOriginalExtension();
         $namFile=$img->getClientOriginalName();
         $exe_flag=true;
         //check đuôi file
         $check=in_array($extension,$file_extension);
         if(!$check){
             $exe_flag=false;
             Session()->flash('error','Cập nhập sản phẩm thất bại,vui lòng kiểm tra file ảnh');
                 return redirect()->back();
         }
         if($exe_flag){

             $this->productService->update($request,$id);
             $result=$this->imageProductService->update($namFile,$id);
             $img->storeAs('public/uploads',$namFile);
             //Storage::disk('local')->put('example.txt', 'Contents');
             if($result){
                 Session()->flash('success','Cập nhập thành công');
                 return redirect()->route('admin.products.list');
                }
                Session()->flash('error','Cập nhập thất bại');
                return redirect()->back();
            }
        

    }else{
        $this->productService->update($request,$id);
        $result=$this->imageProductService->update($request->input('thumb'),$id);
        if($result){
            Session()->flash('success','Cập nhập thành công');
            return redirect()->route('admin.products.list');
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
    public function destroy($id)
    {
        //
    }
    /*================================================================Client================================================================*/
    public function showDetailProduct($id='',$slug=''){
        $product=$this->productService->getProduct($id);
        $relative_product=$this->productService->getRelativeProducts($id,$product->cate_id);
        $ratings=$this->ratingService->getAll_oneIdProduct($id);
        return view('client.products.detail',[
                'title'=>$product->name_product,
                'group_products'=>$this->groupProductService->getAll(),
                'product'=>$product,
                'ratings'=>$ratings,
                'relative_products'=>$relative_product
        ]);
    }
}
