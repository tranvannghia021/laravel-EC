<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Services\ProviderService;
use App\Http\Services\StaffService;
use App\Http\Services\GroupProduct_Service;
use App\Http\Services\ProductService;
use App\Http\Services\ImportService;
use Database\Seeders\ImportSeeder;

class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    protected $providerService;
    protected $staffService;
    protected $productService;
    protected $groupProduct_Service;
    protected $importService;
    public function __construct(ProviderService $providerService,StaffService $staffService,
                                GroupProduct_Service $groupProduct_Service,
                                ProductService $productService,
                                ImportService $importService)
    {
        $this->providerService=$providerService;
        $this->staffService=$staffService;
        $this->groupProduct_Service=$groupProduct_Service;
        $this->productService=$productService;
        $this->importService=$importService;
    }
    public function index() { 
        
        $title='Danh sách nhập hàng';
       
        $staff=$this->staffService->getInFo(Session::get('staff_id'));
        $imports=$this->importService->getAll();
        //dd($imports->toArray());
        return view('admin.imports.list',compact('title','staff','imports'));
    }
    public function search(Request $request){
        $title='Danh sách nhập hàng';
       
        $staff=$this->staffService->getInFo(Session::get('staff_id'));
        $imports=$this->importService->search($request);
        //dd($imports->toArray());
        return view('admin.imports.list',compact('title','staff','imports'));
    }
    public function importdetail($id){
        $title='Chi tiết nhập hàng';
       
        $staff=$this->staffService->getInFo(Session::get('staff_id'));
        $imports=$this->importService->getItems($id);
       // dd($imports->toArray());
        return view('admin.imports.detail',compact('title','staff','imports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //  Session::forget('imports');
        $title='Nhập hàng';
        
        if(Session::has('imports'))
        {
            $imports=Session::get('imports');

        }else{
            $imports=[];
        }
       
        $productsAll=$this->productService->getArray();
      
      
        $staff=$this->staffService->getInFo(Session::get('staff_id'));
        $providers=$this->providerService->getAll();
      
        $categorys=$this->groupProduct_Service->getAll();

        

        return view('admin.imports.add',compact('title','imports','productsAll','categorys','providers','staff'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        //dd(Session::get('imports'));
        $result=$this->importService->addSession($request);
        //dd($result);
        if ($result)  
        return response()->json([
           'error' => false,
           'message' => "Thêm Thành Công"
       ]);
       else
           return response()->json([
               'error' => true,
              'message' => "Thêm Thất Bại"
          ]);
    }
    public function save(){
        $imports=Session::get('imports');
        $result=$this->importService->create($imports);
        if ($result)  
         {
            Session::forget('imports');
            return response()->json([
               'error' => false,
               'message' => "Nhập hàng Thành Công"
           ]);
         }
       else
          {
            return response()->json([
                'error' => true,
               'message' => "Nhập hàng Thất Bại"
           ]);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $result=$this->importService->delete($request);
        if($result){
           return response()->json([
                'error'=>false,
                'message'=>'Xóa thành công '
            ]);
        }
        return response()->json([
            'error'=>true
        ]);
    }
}
