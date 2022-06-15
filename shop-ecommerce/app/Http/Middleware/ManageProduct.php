<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Staffs;
use App\Models\Roles;
use App\Models\RolePermissions;
use App\Models\Permissions;
use App\Http\Services\RoleService;
use Illuminate\Support\Facades\Session;
class ManageProduct
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

        $url=route('admin.dashboard');
        if(!$this->isManagerProduct($request)) return redirect($url);
     
         return $next($request);// đúng thi tiếp tục
     }
     private function isManagerProduct($request){
        $staff_id=Session::get('staff_id');
        $staff=Staffs::where('id',$staff_id)->first();
        $role_id=$staff->role_id;
        $permissions=RoleService::getListRolePermissionCheckMiddleware($role_id);
        $i=0;$list_permissions=[];
        foreach($permissions as $item){
         $list_permissions[$i++]=$item->url;
        }
         $check=in_array('/admin/products/', $list_permissions);
        return ($check==true)?true:false;

    }
}
