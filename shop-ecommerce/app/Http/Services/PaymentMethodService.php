<?php
namespace App\Http\Services;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\TryCatch;
class PaymentMethodService{
    
    public function getpaymentMethod($id){
        return PaymentMethod::where('id',$id)->first();
    }
}