<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Services\ProviderService;
use App\Http\Services\StaffService;
class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $providerService;
    protected $staffService;
    public function __construct(ProviderService $providerService,StaffService $staffService)
    {
        $this->providerService=$providerService;
        $this->staffService=$staffService;
    }
    public function index()
    {   $id_cript=0;
        $id_provider=0;
        $title='Nhà cung cấp';
        $staff=$this->staffService->getInFo(Session::get('staff_id'));
        $providers=$this->providerService->getAll();
        $name='';
        $address='';
        $phones='';
        $name_btn='Thêm';
        return view('admin.provider.list',compact('title','id_provider','id_cript','name_btn','providers','name','address','phones','staff'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result=$this->providerService->create($request);
        if ($result)  
        {
            $providers=$this->providerService->getAll();
            return response()->json([
                'error' => false,
                'message' => "Thêm nhà cung cấp thành công",
                'providers'=>$providers
            ]);
        }
       else
           {
            return response()->json([
                'error' => true,
               'message' => "Thêm nhà cung cấp thất bại"
           ]);
           }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {   $id_cript=1;
        
        $title='Nhà cung cấp';
        $staff=$this->staffService->getInFo(Session::get('staff_id'));
        $providers=$this->providerService->getAll();
        $providers_items=$this->providerService->getItems($id);
        $name_btn='Cập nhập';
        $id_provider=$id;
        $name='';
        $address='';
        $phones='';
        foreach($providers_items as $items){
            $name=$items->name;
            $address=$items->address;
            $phones=$items->phones;
        }
      
        return view('admin.provider.list',compact('title','id_provider','id_cript','name_btn','providers','staff','name','address','phones'));
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
               // dd( $request->input('id'));
        $result=$this->providerService->update($request);
        
        if ($result)  
        {
            return response()->json([
                'error' => false,
                'message' => "Cập nhâp nhà cung cấp thành công"
            ]);
        }
       else
           {
            return response()->json([
                'error' => true,
               'message' => "Cập nhập nhà cung cấp thất bại"
           ]);
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
        $result=$this->providerService->delete($request);
        if($result)  {
            return response()->json([
                'error'=>false,
                'message'=>'Xoá thành công!!!'
            ]);
        }
        return response()->json([
            'error'=>true,
            'message'=>'Xoá không thành công!!!'
        ]);
    }
}
