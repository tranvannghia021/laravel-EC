<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\CustomerService;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class LoginCustomerController extends Controller
{
    protected $customerService;
    private $OTP;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('client.user.login',[
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
        //Validate
        $customer=$this->customerService->findCustomerwithEmail($request->input('email'));
        if(!is_null($customer)){
            if (Hash::check($request->input('password'), $customer->password)) {
                // Lưu Session 
                Session::put("customer_id",$customer->id );
                Session::put("customer_login",true );
                return response()->json([
                    'error'=>false,
                    'fail_node'=>null,
                    'message'=>'Đăng Nhập Thành Công.'
                ]);
            }
            else
            return response()->json([
                'error'=>true,
                'fail_node'=>'password',
                'message'=>'Mật Khẩu Không Đúng'
            ]);
        }
        else return response()->json([
            'error'=>true,
            'fail_node'=>'email',
            'message'=>'Email không tồn tại trong hệ thống.'
        ]);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function showregistery(){
        return view('client.user.registery',[
            
        ]);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function storeRegistery(Request $request ){
            
            $this->validate($request,[
                'email' => 'required|email:filter|regex:/^.+@.+$/i',
                'password' => 'required|min:5'
            ]);
            //dd($request->all());

            //get Staff
            $customer=$this->customerService->findCustomerwithEmail($request->input('email'));
            if(is_null($customer)){

                // thuc hien viec đăng ký
                try{
                Customer::create([
                    'first_name'=>(string)$request->input('firstname'),
                    'last_name'=>(string)$request->input('lastname'),
                    'email'=>(string)$request->input('email'),
                    'password'=>(string)bcrypt($request->input('password')),
                    'status'=>1,
                ]);
               } catch (\Exception $err) {
                   return response()->json([
                    'error'=>true,
                    'fail_node'=>'insert_database',
                    'message'=>'Đăng Ký Tài Khoản Thất Bại'
                ]);
                
                 }
                 return response()->json([
                    'error'=>false,
                    'fail_node'=>null,
                    'message'=>'Đăng Ký Tài Khoản Thành Công'
                ]);
                
            }
            else return response()->json([
                'error'=>true,
                'fail_node'=>'email',
                'message'=>'Email Đã Tồn Tại'
            ]);
            
        
    }

    public function logout(Request $request){
       // dd($request->session()->get('customer_login'));
        if ($request->session()->has('customer_id') && $request->session()->get('customer_login')==true ) {
            $request->session()->forget('customer_id');
            session()->put('customer_login', false);
          //  $request->session()->flush();
        }
        return back();
    }


    // chc=eck mail gui mã OTP
    public function showFormCheckEmailForgotPassword(){
        return view('client.user.forgot-password');
    }

    public function storeFormCheckEmailForgotPassword(Request $request){
            $result=$this->customerService->findCustomerwithEmail($request->input('email'));
           
            if(is_null($result)){
                return response()->json([
                    'error'=>true,
                    'message'=>'Email Không Tồn Tại'
                ]);
            }
            else {
        $this->OTP=$this->customerService->sendOTP($request->input('email'));
        Session::put("xxxxxAGH_Error",$this->OTP);
                return response()->json([
                    'error'=>false,
                    'message'=>'Email  Tồn Tại'
                ]);
            }
    }
    // Send OTP email
    public function showFormSentOTP(){
        return view('client.user.check_email_reset_password');
    }
    public function storeFormSentOTP(Request $request){
        //$result=$this->customerService->checkOTP($request->input('otp'));
           $result=($request->input('otp')== Session::get("xxxxxAGH_Error"));
        if(!$result){
            return response()->json([
                'error'=>true,
                'message'=>'Mã Xác Thực Sai'
            ]);
        }
        else {
            return response()->json([
                'error'=>false,
                'message'=>'Chính Xác'
            ]);
        }
    }
    //reset password
    public function showResetPassword(){
            return view('client.user.reset_password',[
                'title'=>'Quên Mật Khẩu',
                            ]);
    }
    public function storeResetPassword(Request $request){
      $result= $this->customerService->changePasswordWithEmail($request);
      if(!$result){
        return response()->json([
            'error'=>true,
            'message'=>'Đổi Mật Khẩu Thành Công'
        ]);
    }
    else {
        return response()->json([
            'error'=>false,
            'message'=>'Thất Bại'
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
