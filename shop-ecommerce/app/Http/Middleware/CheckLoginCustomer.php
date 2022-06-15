<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckLoginCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
      
        $url=route('login');
        if(!$this->isLogin($request)) return redirect($url);
         return $next($request);// đúng thi tiếp tục
     }
     private function isLogin($request){
        if ($request->session()->has('customer_id')) {
            return true;
        }
        return false;
     }
}
