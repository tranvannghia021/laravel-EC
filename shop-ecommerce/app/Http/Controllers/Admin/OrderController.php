<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\StaffService;
use App\Http\Services\OrderService;
use App\Http\Services\OrderDetailService;
use Illuminate\Support\Facades\Session;



class OrderController extends Controller
{
    protected $staffService;
    protected $orderService;
    protected $orderdetailService;
    
    public $STATUS=[
        1=>'Chờ Xác Nhận',
        2=>'Đã Xác Nhận',
         3=>'Đang Giao Hàng',
         4=>'Giao Hàng Thành Công',
        5=>'Giao Hàng Thất Bại',
        6=>'Thất bại'
        ];

    public function __construct(StaffService $staffService, OrderService $orderService,
                                OrderDetailService $orderDetailService)
    {
        $this->staffService=$staffService;
        $this->orderService=$orderService;
        $this->orderDetailService=$orderDetailService;
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
     
       // $result=$this->orderDetailService->statisTical(); (Thống kê)
        
      
        $status=0;
        $title='Danh sách đơn hàng';
        $staff=$this->staffService->getInFo(Session::get('staff_id'));
        $orders=$this->orderService->getAll();
          $a=$this->STATUS;
         return view('admin.orders.orders',compact('title','staff','orders','a','status'));
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
       
        $title='Sét trạng thái đơn hàng';
        $staff=$this->staffService->getInFo(Session::get('staff_id'));
        $order_ups=$this->orderService->getItem($id);
        $a=$this->STATUS;
    
        foreach($order_ups as $order_up){
            $id_order=$order_up->id_order;
            $status_number= $order_up->status;
        }
      
        
        return view('admin.orders.edit_orderDetail',compact('title','staff','status_number','id_order','a'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
         $status=$request->input('status');
         $title='Danh sách đơn hàng';
         $staff=$this->staffService->getInFo(Session::get('staff_id'));
         $a=$this->STATUS;
        
        $orders=$this->orderService->getSearch($request);
    
     
        return view('admin.orders.orders',compact('title','staff','orders','a','status'));
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
        
        
        $result=$this->orderService->update($request->input('status_value'),$request->input('id'));
        if ($result)  
        return response()->json([
           'error' => false,
           'message' => "Cập nhập Thành Công"
       ]);
       else
           return response()->json([
               'error' => true,
              'message' => "Cập nhập Thất Bại"
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
    public function showDetail(Request $request){
           $title='Chi Tiết Đơn Hàng';
            $staff=$this->staffService->getInFo(Session::get('staff_id'));
            $orderItems=$this->orderService->getItem($request->id);
            $id_print=$request->id;
           //dd($orderItems);
        return view('admin.orders.order_details',compact('title','staff','orderItems','id_print'));
    }
    public function print(Request $request){
        
             $title='In Đơn Hàng';
            $staff=$this->staffService->getInFo(Session::get('staff_id'));
            $orderItems=$this->orderService->getItem($request->id);
            
            $id_print=$request->id;
        return view('admin.layout.print_orders',compact('title','staff','orderItems','id_print'));
    }
}
