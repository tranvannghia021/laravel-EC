<?php

namespace App\Http\Middleware;

use App\Models\Staffs;
use App\Models\Roles;
use App\Models\RolePermissions;
use App\Models\Permissions;
use App\Http\Services\RoleService;
use Illuminate\Support\Facades\Session;
use Closure;
use Illuminate\Http\Request;

class CheckRole
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

        $url = route('admin.dashboard');
        $staff_id = Session::get('staff_id');
        $staff = Staffs::where('id', $staff_id)->first();
        $role_id = $staff->role_id;
        $permissions = RoleService::getListRolePermissionCheckMiddleware($role_id);
        $i = 0;
        $list_permissions = [];
        foreach ($permissions as $item) {
            $list_permissions[$i++] = $item->url;
        }
        if ($request->is('admin/products/*')) {
            if (!$this->isManagerProduct($list_permissions)) return redirect($url);
            else return $next($request);
        } else
        if ($request->is('admin/staffs/*')) {
            if (!$this->isManagerStaff($list_permissions)) return redirect($url);
            else return $next($request);
        } else
        if ($request->is('admin/customers/*')) {
            if (!$this->isManagerCustomer($list_permissions)) return redirect($url);
            else return $next($request);
        }else
        if ($request->is('admin/group-products/*')) {
            if (!$this->isManagerGroupProduct($list_permissions)) return redirect($url);
            else return $next($request);
        } else
        if ($request->is('admin/discounts/*')) {
            if (!$this->isManagerDiscount($list_permissions)) return redirect($url);
            else return $next($request);
        } else
        if ($request->is('admin/imports/*')) {
            if (!$this->isManagerImport($list_permissions)) return redirect($url);
            else return $next($request);
        }
        else
        if ($request->is('admin/providers/*')) {
            if (!$this->isManagerProvider($list_permissions)) return redirect($url);
            else return $next($request);
        } else
        if ($request->is('admin/orders/*')) {
            if (!$this->isManagerOrder($list_permissions)) return redirect($url);
            else return $next($request);
        } else
        if ($request->is('admin/sliders/*')) {
            if (!$this->isManagerSlider($list_permissions)) return redirect($url);
            else return $next($request);
        }
        else
        if ($request->is('admin/ratings/*')) {
            if (!$this->isManagerRating($list_permissions)) return redirect($url);
            else return $next($request);
        } else
        if ($request->is('admin/roles/*')) {
            if (!$this->isManagerRole($list_permissions)) return redirect($url);
            else return $next($request);
        }
        else return redirect()->route('admin.login'); 
        // đúng thi tiếp tục
    }
    private function isManagerProduct($list_permissions)
    {

        $check = in_array('/admin/products/', $list_permissions);
        return ($check == true) ? true : false;
    }
    private function isManagerStaff($list_permissions)
    {

        $check = in_array('/admin/staffs/', $list_permissions);
        return ($check == true) ? true : false;
    }
    private function isManagerCustomer($list_permissions)
    {

        $check = in_array('/admin/customers/', $list_permissions);
        return ($check == true) ? true : false;
    }
    private function isManagerGroupProduct($list_permissions)
    {

        $check = in_array('/admin/group-products/', $list_permissions);
        return ($check == true) ? true : false;
    }
    private function isManagerDiscount($list_permissions)
    {

        $check = in_array('/admin/discounts/', $list_permissions);
        return ($check == true) ? true : false;
    }
    private function isManagerImport($list_permissions)
    {

        $check = in_array('/admin/imports/', $list_permissions);
        return ($check == true) ? true : false;
    }
    private function isManagerProvider($list_permissions)
    {

        $check = in_array('/admin/providers/', $list_permissions);
        return ($check == true) ? true : false;
    }
    private function isManagerOrder($list_permissions)
    {

        $check = in_array('/admin/orders/', $list_permissions);
        return ($check == true) ? true : false;
    }
    private function isManagerRole($list_permissions)
    {

        $check = in_array('/admin/roles/', $list_permissions);
        return ($check == true) ? true : false;
    }
    private function isManagerRating($list_permissions)
    {

        $check = in_array('/admin/ratings/', $list_permissions);
        return ($check == true) ? true : false;
    }
    private function isManagerSlider($list_permissions)
    {

        $check = in_array('/admin/sliders/', $list_permissions);
        return ($check == true) ? true : false;
    }
   
}
