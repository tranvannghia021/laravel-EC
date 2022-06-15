<?php

namespace App\Http\View\Composers;
use App\Http\Services\OrderService;

use Illuminate\View\View;

 
class NotificationComposer
{
    protected $orderService;
    public function __construct(OrderService $orderService)
    {
        $this->orderService=$orderService;
    }
 
    
    public function compose(View $view)
    {
        $status=$this->orderService->getStatus();
  
        return $view->with('notification_order',$status);
    }
}