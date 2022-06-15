<?php
namespace App\Http\Services;
use App\Jobs\SendMail;
use App\Models\Customer;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class CustomerService {
    private $OTP=111111;
    public function __construct(){
      //  
    }
    public function getAll()
    {
        return Customer::orderbyDesc('id')->get();
    }

    public function getSearch($request){
        return Customer::orderbyDesc('id')
                        ->where('first_name','like','%'.$request->input('search').'%')
                        ->orwhere('last_name','like','%'.$request->input('search').'%')
                        ->get();
    }
    public function getFilter($request){
        $query = Customer::query();
        if($request->has('email') && !is_null($request->input('email')) ){
            $query=$query->where('email',$request->input('email'));
        }
        if($request->has('status') && $request->input('status')!=-1){
            $query=$query->where('status',$request->input('status'));
        }
        return $query->get();
    }



    public function findCustomerwithEmail($email){
        
        return Customer::select('id','email','password')->where('email',$email)->where('status',1)->first();
    }
    public static function getInFo($id){
        return Customer::where('id',$id)->first();
    }
    public function update($request): bool
    {
        try {           
            Customer::where("id", $request->input('customer_id'))->update([
            'first_name' => (string)$request->input('first_name'),
            'last_name' => (string)$request->input('last_name'),
            'phone' => (string)$request->input('phone'),
            'gender' => (string)$request->input('gender'),  
            'address' => (string)$request->input('address'),
            ]);
        
        }  catch (\Exception $err)  {
            // session()->flash('error', 'Cập nhật nhân viên thất bại !!! ');
              //Log::info($err->getMessage());
             return false;
         }
         return true;

        }
        public function changePassword($request): bool
        {
            try {           
                Customer::where("id", $request->input('customer_id'))->update([               
                'password' =>bcrypt($request->input('new_password')),
                ]);
            
            }  catch (\Exception $err)  {
                // session()->flash('error', 'Cập nhật nhân viên thất bại !!! ');
                  //Log::info($err->getMessage());
                 return false;
             }
             return true;
    
        }
        public function changePasswordWithEmail($request): bool
        {
            try {           
                Customer::where("email", $request->input('email'))->update([               
                'password' =>bcrypt($request->input('new_password')),
                ]);
            
            }  catch (\Exception $err)  {
                // session()->flash('error', 'Cập nhật nhân viên thất bại !!! ');
                  //Log::info($err->getMessage());
                 return false;
             }
             return true;
    
        }
    public function sendOTP($email){ 
        $this->OTP=random_int(100000, 999999);

        $data=[
            'reset_password' =>true,
            'otp'=>$this->OTP,
            'email'=>$email,
        ];
        SendMail::dispatch($data)->delay(now()->addSeconds(5));
        return $this->OTP;
    }
    public function checkOTP($otp){
        dd($this->OTP);
        return ($this->OTP==$otp);
    }
    public function create($request)
    {

        try {
             Customer::create([
                'gender' => (string)$request->input('gender'),
                'first_name' => (string)$request->input('first_name'),
                'last_name' => (string)$request->input('last_name'),
                'phone' => (string)$request->input('phone'),
                'email' => (string)$request->input('email'),
                'password' => (string)bcrypt($request->input('password')),
                'status' => (int)$request->input('status'),
                'address' => (string)$request->input('address'),

            ]);
        } catch (\Exception $err) {
           // Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }
    public function delete($request){
        $product=Customer::where('id',$request->input('id'))->first();
        if($product ){
            $product->delete();
            return true;
        }
        return false;
    }
    public function updateAdmin($request): bool
    {

       
        try {           
            Customer::where("id", $request->input('id'))->update([
                'gender' => (string)$request->input('gender'),
                'first_name' => (string)$request->input('first_name'),
                'last_name' => (string)$request->input('last_name'),
                'phone' => (string)$request->input('phone'),
                'email' => (string)$request->input('email'),
                'password' => (string)bcrypt($request->input('password')),
                'status' => (int)$request->input('status'),
                'address' => (string)$request->input('address'),
            ]);
        
        }  catch (\Exception $err)  {
            // session()->flash('error', 'Cập nhật nhân viên thất bại !!! ');
              //Log::info($err->getMessage());
             return false;
         }
         return true;
        }

        /** Statictis-------- */
        public function getStatisticsNewCustomerRegistery(){
            return Customer::where('created_at','>',date('Y-m-d'))->count();
        }
        
}
   


