<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\CustomerService;
use App\Http\Services\GroupProduct_Service;
use App\Http\Services\ProductService;
use App\Http\Services\CartService;
use App\Http\Services\OrderDetailService;
use App\Http\Services\SliderService;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    protected $customerService;
    protected $groupProductService;
    protected $cartService;
    protected $productService;
    protected $sliderService;
    protected $orderDetailsService;

    public function __construct(OrderDetailService $orderDetailService,CustomerService $customerService, GroupProduct_Service $groupProductService, CartService $cartService, ProductService $productService, SliderService $sliderService)
    {
        $this->customerService = $customerService;
        $this->groupProductService = $groupProductService;
        $this->cartService = $cartService;
        $this->productService = $productService;
        $this->sliderService = $sliderService;
        $this->orderDetailsService= $orderDetailService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('client.home', [
            'title' => 'TRESOR',
            'customer' => $this->customerService->getInFo(Session::get('customer_id')),
            //  'group_products'=>$this->groupProductService->getAll(),
            'new_arrival_products' => $this->productService->getNewArrivalProducts(),
            'best_seller_products' => $this->orderDetailsService->getBestSellerProducts(),
            'sliders' => $this->sliderService->getSliders()
            // 'products'=>'products',
            // 'group_product'=>'category',
        ]);
    }

    public function showListProducts(Request $request)
    {
        return view('client.products.list', [
            'title' => 'Cửa Hàng',
            'products' => $this->productService->getListProducts($request),
        ]);
    }

    public function showListProductSortby(Request $request, $id, $slug)
    {
        return view('client.products.list', [
            'title' => 'Danh Sách Sản Phẩm',
            'products' => $this->productService->getListProductSortby($request, $id),
        ]);
    }
    public function loadProduct(Request $request)
    {
        $page = $request->input('page', 0);
        $result = $this->productService->loadProduct($page);
        if (count($result) != 0) {
            $html = view('client.products.content_list', ['products' => $result])->render();
            return response()->json(['data' => $html]);
        }
        return response()->json(['data' => ""]);
    }
    public function aboutStore(){
        return view('client.about',['title'=>'Thông Tin Cửa Hàng']);
    }
    public function contactStore(){
        return view('client.contact',['title'=>'Thông Tin Liên Hệ Cửa Hàng']);
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
