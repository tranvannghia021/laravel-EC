<?php

namespace App\Http\View\Composers;
 
use App\Repositories\UserRepository;
use Illuminate\View\View;
use App\Models\GroupProduct;
 
class GroupProductComposer
{
 
    public function __construct()
    {
        
    }
 
    
    public function compose(View $view)
    {
        $menus=GroupProduct::all();
        return $view->with('group_products',$menus);
    }
}