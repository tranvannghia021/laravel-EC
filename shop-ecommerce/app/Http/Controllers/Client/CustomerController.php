<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Services\CustomerService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Http\Services\OrderService;
use App\Http\Services\OrderDetailService;
class CustomerController extends Controller
{
    protected $customerService;
    protected $orderService;
    protected $orderDetailsService;

    public function __construct(CustomerService $customerService,OrderService $orderService, OrderDetailService $orderDetailService){
        $this->customerService = $customerService;
        $this->orderService = $orderService;
        $this->orderDetailService = $orderDetailService;
    }
    public function index()
    {
        return view('client.user.profile',[
            'title'=>'Thông Tin Cá Nhân',
            'customer'=> $this->customerService->getInFo(Session::get('customer_id')),
            'order_customer'=>$this->orderService->getbyCustomerId(Session::get('customer_id'))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        //
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
        //
    }
    public function updateClient(Request $request)
    {
        //dd($request->all());
       $result = $this->customerService->update($request);
       return redirect()->back();
    }

    public function changePassword(Request $request){
       // dd($request->all());
        //check confirm old password
        $customer = $this->customerService->getInFo($request->input('customer_id'));
        if (Hash::check($request->input('old_password'), $customer->password)) {
            $result = $this->customerService->changePassword($request);
            if($result)  return response()->json([
                'error'=>false,
                'message'=>'Thay Đổi Mật Khẩu Thành Công'
                
            ]);
            else  return response()->json([
                'error'=>true,
                'fail_node'=>'password',
                'message'=>'Thay Đổi Mật Khẩu Thất Bại'
            ]);
        }
        else  return response()->json([
            'error'=>true,
            'fail_node'=>'password',
            'message'=>'Mật Khẩu Không Đúng'
        ]);
        
    }

    public function showDetailOrder($id){
       
        return view('client.user.detail_order',[
            'title'=>'Chi Tiết Đơn Hàng',
            'order_details'=> $this->orderDetailService->getItem($id),
        ]);
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
}
