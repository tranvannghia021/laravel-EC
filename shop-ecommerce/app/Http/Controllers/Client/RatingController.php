<?php

namespace App\Http\Controllers\client;
use App\Http\Services\RatingService;
use App\Http\Controllers\Controller;
use App\Http\Services\OrderService;
use App\Http\Services\StaffService;
use App\Http\Services\GroupProduct_Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use function GuzzleHttp\Promise\all;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $ratingService;
    protected $staffService;
    protected $orderService;
    protected $groupProductService;
    public function __construct(RatingService $ratingService,
                                GroupProduct_Service $groupProductService,
                                OrderService $orderService,StaffService $staffService)
    {
        $this->ratingService=$ratingService;
        $this->orderService=$orderService;
        $this->staffService=$staffService;
        $this->groupProductService=$groupProductService;
    }
    public function index()
    {   $point=0;
        $category_id=0;
        $title='Danh sách đánh giá';
        $staff=$this->staffService->getInFo(Session::get('staff_id'));
        $ratings=$this->ratingService->getAll();
        $categorys=$this->groupProductService->getAll();
    
        return view('admin.ratings.rating',compact('title','staff','ratings','category_id','point','categorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        if (Session::has('customer_id') && Session::get('customer_login') == true) {
            $id_cutomer=Session::get('customer_id');
            $check=$this->orderService->check($id_cutomer,$request->input('product_id'));
            
            if($check){
                $result=$this->ratingService->create($request,$id_cutomer);
            }else{
                return response()->json([
                    'error' => true,
                    'message' => 'Bạn chưa từng mua sản phẩm này'
                ]);
            }

            
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Đăng Nhập Để Bình luận'
            ]);
        }

            if($result){
                return response()->json([
                    'error' => false,
                    'message' => 'Bình luận thành công'
                ]);
            }else{
                return response()->json([
                    'error' => true,
                    'message' => 'Bình luận thất bại'
                ]);
            }
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
    public function show(Request $request)
    {
        
        // $rating=$this->ratingService->getPoint(5);
    }
    public function searchPoint(Request $request){
       //dd($request->all());
        $point=$request->input('point');
        $category_id=$request->input('category');
        $ratings=$this->ratingService->getSearch($request);
        $title='Danh sách đánh giá';
        $staff=$this->staffService->getInFo(Session::get('staff_id'));
        $categorys=$this->groupProductService->getAll();
        
         return view('admin.ratings.rating',compact('title','staff','ratings','category_id','point','categorys'));
        
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
