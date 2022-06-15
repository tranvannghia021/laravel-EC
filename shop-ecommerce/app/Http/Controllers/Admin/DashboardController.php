<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\StaffService;
use App\Http\Services\OrderService;
use App\Http\Services\OrderDetailService;
use App\Models\Staff;
use App\Http\Services\CustomerService;
use Illuminate\Support\Facades\Session;
class DashboardController extends Controller
{
    protected $staffService;
    protected $orderDetailService;
    protected $orderService;
    protected $customerService;

    public function __construct(StaffService $staffService, OrderDetailService $orderDetailService,OrderService $orderService, CustomerService $customerService)
    {
        $this->staffService = $staffService;
        $this->orderDetailService = $orderDetailService;
        $this->customerService = $customerService;
        $this->orderService = $orderService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $lastdate=mktime(0, 0, 0, date("m")  , date("d")-8, date("Y"));
       // dd($request->input('start_date'));
        if($request->has('start_date') && $request->has('end_date')){
        $startDate=(!is_null($request->input('start_date')))?$request->input('start_date'):date('Y-m-d', $lastdate);
        $endDate=(!is_null($request->input('end_date')))?$request->input('end_date'): date('Y-m-d H:i:s');
        }
        else {
            $startDate= date('Y-m-d', $lastdate);
            $endDate=date('Y-m-d H:i:s');
        }
      
       // $this->orderService->getOrderInLongTime(date('Y-m-d', $lastdate),date('Y-m-d'));

                   return view('admin.dashboard',[
            'title'=>'Quản Trị Website Bán Hàng',
            'staff'=>$this->staffService->getInFo(Session::get('staff_id')),
            'statisticsGroupProduct'=> $this->orderDetailService->statisTical(date('m')),
            'number_new_order'=>$this->orderService->getStatisticsNewOrder(),
            'number_new_revenue'=>$this->orderService->getStatisticsNewRevenue(),
            'number_new_customer_registery'=>$this->customerService->getStatisticsNewCustomerRegistery(),
            'number_new_order_cancel'=>$this->orderService->getStatisticsNewCanceled(),
            'top_customer_cancel_order'=>$this->orderService->getStatisticsMostCancelOrder(),
            'dataChartOrder'=>$this->orderService->getOrderInLongTime( $startDate, $endDate),
            'dataChartRevenue'=>$this->orderService->getRevenueInLongTime( $startDate, $endDate),
            'start_date_Chart'=>$startDate,
            'end_date_Chart'=>$endDate

        ]);
    }

    public function loadChart(Request $request){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $lastdate=mktime(0, 0, 0, date("m")  , date("d")-8, date("Y"));
        $startDate=date('Y-m-d', $lastdate);
        $endDate=date('Y-m-d H:i:s');
        $this->orderService->getOrderInLongTime(date('Y-m-d', $lastdate),date('Y-m-d'));
        dd($request->all());
        return view('admin.dashboard',[
            'title'=>'Quản Trị Website Bán Hàng',
            'staff'=>$this->staffService->getInFo(Session::get('staff_id')),
            'statisticsGroupProduct'=> $this->orderDetailService->statisTical(date('m')),
            'number_new_order'=>$this->orderService->getStatisticsNewOrder(),
            'number_new_revenue'=>$this->orderService->getStatisticsNewRevenue(),
            'number_new_customer_registery'=>$this->customerService->getStatisticsNewCustomerRegistery(),
            'number_new_order_cancel'=>$this->orderService->getStatisticsNewCanceled(),
            'top_customer_cancel_order'=>$this->orderService->getStatisticsMostCancelOrder(),
            'dataChartOrder'=>$this->orderService->getOrderInLongTime( $startDate, $endDate),
            'start_date_Chart'=>$startDate,
            'end_date_Chart'=>$endDate

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
