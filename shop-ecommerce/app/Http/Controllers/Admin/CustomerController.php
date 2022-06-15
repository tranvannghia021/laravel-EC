<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Services\StaffService;
use App\Http\Services\CustomerService;

class CustomerController extends Controller
{   
    protected $customerService;
    protected $staffService;
    public function __construct(CustomerService $customerService,StaffService $staffService){
        $this->customerService = $customerService;
        $this->staffService = $staffService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.customers.list', [
            'title' => 'Danh Sách Khách Hàng',
            'staff' => $this->staffService->getInFo(Session::get('staff_id')),
            'listCustomers' => $this->customerService->getAll(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customers.add', [
            'title' => 'Thêm Khách Hàng',
            'staff' => $this->staffService->getInFo(Session::get('staff_id')),
        ]);
    }
    public function checkEmailExist(Request $request)
    {
        //check email các table khác không quan tâm vấn đề này
        $staff = $this->customerService->findCustomerwithEmail($request->input('email'));
        if (is_null($staff))
            return response()->json([
                'error' => true,
                'message' => 'Email Exist'
            ]);
        //

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!is_null($request)) {
            $result = $this->customerService->create($request);
        }
        $customer= $this->customerService->findCustomerwithEmail($request->input('email'));
        if (is_null($customer))
            return response()->json([
                'error' => true,
                'message' => 'Email Exist'
            ]);
        //
        if ($result)
            return response()->json([
                'error' => false,
                'message' => 'Thêm Thành Công'
            ]);
        else
            return response()->json([
                'error' => true,
                'message' => 'Thêm Thất Bại'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.customers.edit', [
            'title' => 'Sửa Khách Hàng',
            'staff' => $this->staffService->getInFo(Session::get('staff_id')),
            'customer_edit' => $this->customerService->getInFo($id)
        ]);
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
    public function update(Request $request)
    {
       
        $result = $this->customerService->updateAdmin($request);
        $customer= $this->customerService->findCustomerwithEmail($request->input('email'));
        if (is_null($customer))
            return response()->json([
                'error' => true,
                'message' => 'Email Exist'
            ]);
       if ($result)  
         return response()->json([
            'error' => false,
            'message' => "Cập Nhật Thành Công"
        ]);
        else
            return response()->json([
                'error' => true,
               'message' => "Cập Nhật Thất Bại"
           ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $result = $this->customerService->delete($request);
        if($result)  {
            return response()->json([
                'error'=>false,
                'message'=>'Xoá thành công!!!'
            ]);
        }
        return response()->json([
            'error'=>true
        ]);
    }
    public function search(Request $request)
    {
        
        return view('admin.customers.list', [
            'title' => 'Danh Sách Khách Hàng',
            'staff' => $this->staffService->getInFo(Session::get('staff_id')),
            'listCustomers' => $this->customerService->getSearch($request),
        ]);
    }

    public function filter(Request $request)
    {
        //dd($this->staffService->getFilter($request));
        return view('admin.customers.list', [
            'title' => 'Danh Sách Khách Hàng',
            'staff' => $this->staffService->getInFo(Session::get('staff_id')),
            'listCustomers' => $this->customerService->getFilter($request),
        ]);
    }

   
}
