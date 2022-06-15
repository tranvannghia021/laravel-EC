<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\CartService;
use App\Http\Services\OrderService;
use App\Http\Services\PaymentService;
use App\Http\Services\DiscountService;
use App\Http\Services\CustomerService;
use App\Http\Services\GroupProduct_Service;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    private  $hashdata;
    private  $current_order_id=-1;
    protected $cartService;
    protected $customerService;
    protected $groupProductService;
    protected $discountService;
    protected $paymentService;
    protected $orderService;
    public function __construct(OrderService $orderService, PaymentService $paymentService, DiscountService $discountService, CustomerService $customerService, GroupProduct_Service $groupProductService, CartService $cartService)
    {
        $this->cartService = $cartService;
        $this->customerService = $customerService;
        $this->groupProductService = $groupProductService;
        $this->discountService = $discountService;
        $this->paymentService = $paymentService;
        $this->orderService = $orderService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->all());
        $result = $this->cartService->create($request);
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
    public function show()
    {
        $product = $this->cartService->getProduct();
        return view('client.carts.list', [
            'title' => 'Giỏ Hàng',
            'group_products' => $this->groupProductService->getAll(),
            'products' => $product,
            'cart_qty' => Session::get('carts'),
        ]);
    }

    public function checkOut(Request $request)
    {
        // VNPAY
        if ($request->input('payment_method_id') != 1) {
            $this->cartService->addCart($request);
            return view('client.vnpay.index', ['data' => $request]);
        }

        //COD
        $this->cartService->addCart($request);
        return redirect()->back();//route('home.products'); // có thể trả ra trang thông tin hoá đơn của khách hàng
    }
    public function checkOutVNPay(Request $request)
    {
        // dd($request->all());
        $VNP_TMN_CODE = "MOPIFXVG";
        $VNP_HASH_SECRET = "YDNPYDYMJFONJKTENYMWLLYERWPLTJPN";
        $VNP_URL = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_TxnRef = rand(); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $request->input('order_desc');
        $vnp_OrderType = $request->input('order_type');
        $vnp_Amount = $request->input('amount') * 100;
        $vnp_Locale = $request->input('language');
        $vnp_BankCode = $request->input('bank_code');
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $vnp_HashSecret = $VNP_HASH_SECRET;
        //Add Params of 2.0.1 Version
        //$vnp_ExpireDate = $_POST['txtexpire'];
        //Billing
        /* $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
        $vnp_Bill_Email = $_POST['txt_billing_email'];
        $fullName = trim($_POST['txt_billing_fullname']);
        if (isset($fullName) && trim($fullName) != '') {
            $name = explode(' ', $fullName);
            $vnp_Bill_FirstName = array_shift($name);
            $vnp_Bill_LastName = array_pop($name);
        }
        $vnp_Bill_Address = $_POST['txt_inv_addr1'];
        $vnp_Bill_City = $_POST['txt_bill_city'];
        $vnp_Bill_Country = $_POST['txt_bill_country'];
        $vnp_Bill_State = $_POST['txt_bill_state'];
        // Invoice
        $vnp_Inv_Phone = $_POST['txt_inv_mobile'];
        $vnp_Inv_Email = $_POST['txt_inv_email'];
        $vnp_Inv_Customer = $_POST['txt_inv_customer'];
        $vnp_Inv_Address = $_POST['txt_inv_addr1'];
        $vnp_Inv_Company = $_POST['txt_inv_company'];
        $vnp_Inv_Taxcode = $_POST['txt_inv_taxcode'];
        $vnp_Inv_Type = $_POST['cbo_inv_type'];*/
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $VNP_TMN_CODE,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => route('vnpay.return'),
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }


        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $VNP_URL . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $hashdata = $vnpSecureHash;
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
        return redirect($vnp_Url);
    }

    public function storeVNPay(Request $request)
    {
        $vnp_SecureHash = $request->input('vnp_SecureHash');
        $vnp_ResponseCode = $request->input('vnp_ResponseCode');
       // if ($this->hashdata == $vnp_SecureHash) {
            if ($vnp_ResponseCode == '00') {
                $order=$this->orderService->getOrderLast();
                $this->orderService->setStatus( $order->id,6);        
                $result = $this->paymentService->create($request);
                if ($result) {
                    return redirect()->route('home.profile'); 
                } else {
                    echo "GD Khong thanh cong";
                }
            } else
                return false;
      //  }
    }

    

    public function checkLoginPermission(Request $request)
    {
        // check login credentials
        if (Session::has('customer_id') && Session::get('customer_login') == true) {


            return response()->json([
                'error' => false,
                'message' => 'Sản Phảm Đã Được Tiến Hàng Thanh Toán'
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Đăng Nhập Để Mua Hàng'
            ]);
        }
        // $this->cartService->addCart($request);
        return redirect()->back();
    }



    public function showCheckOut()
    {
        $date = date('Y-m-d');
        return view('client.checkout.checkout', [
            'title' => 'Thanh Toán',
            'customer_checkout' => $this->customerService->getInFo(Session::get('customer_id')),
            'discount' => $this->discountService->getDiscount($date),
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
        $this->cartService->update($request);
        return redirect('/carts');
    }

    public function remove($id = 0)
    {
        $this->cartService->remove($id);
        return redirect('/carts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
