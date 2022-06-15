<?php
namespace App\Http\Services;
use App\Models\Payment;
use Illuminate\Support\Facades\Session;


class PaymentService {

    public static  function create( $request ): bool
    {
        
        try {
            Payment::create([

                'transaction_id' => (int)$request->input('vnp_TransactionNo'),
                'order_id'=>(int)$request->input('vnp_TxnRef'),
                'money'=>(float)$request->input('vnp_Amount'),
                'transaction_code'=>(string)$request->input('vnp_TransactionStatus'),
                'note'=>(string)$request->input('vnp_OrderInfo'),
                'vnp_respond_code'=>(string)$request->input('vnp_ResponseCode'),
                'vnpay_code'=>(string)$request->input('vnp_BankTranNo'),
                'bank_code'=>(string)$request->input('vnp_BankCode'),
                'time'=>date('Y-m-d H:i:s'),

           ]);
       } catch (\Exception $err) {
          // Session::flash('error', $err->getMessage());
           return false;
       }
       return true;
    }

}