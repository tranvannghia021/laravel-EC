<?php
namespace App\Http\Services;


use App\Models\Staffs;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\Roles;
use App\Models\Permissions;
use App\Models\RolePermissions;

class RoleService {

    public static function getListRoles(){
        return Roles::orderByDesc('id')->get();
    } 
    public static function findRoleWithID($id) {
        return Roles::all()->where('id', $id)->first();
    }
    public static function findRoleWithName($name) {
        return Roles::where('name', $name)->first();
    }
    public static function getListRolePermissions($id){
       return Roles::select(['roles.id as role_id','role.name as role_name','permissions.id as permissions_id', 'permissions.name as permissions_name',])
        ->join('role_permissions','role_permissions.role_id','=','roles.id')
        ->join('permissions','permissions.id','=','role_permissions.permission_id')
        ->where('role.id',$id)
        ->get();
    }
    public static function getListRolePermissionCheckMiddleware($id){
        return RolePermissions::select(['permissions.map as url'])
         ->join('permissions','permissions.id','=','role_permissions.permission_id')
         ->where('role_permissions.role_id',$id)
         ->get();
     }
    public static function getListPermissions(){
        return Permissions::all();
    } 
    public static function getListPermissionsWithRoleID($id){
        return Permissions::select(['permissions.id as permission_id', 'permissions.name as permission_name'])
         ->join('role_permissions','role_permissions.permission_id','=','permissions.id')
         ->where('role_permissions.role_id',$id)
         ->get();
     }
    public function create($request){
        try {
            $role=Roles::create([
                'name'=>(string)$request->input('name'),
            ]);
            $role_permissions=$request->input('permission_id');
            foreach ($role_permissions as $item){
                RolePermissions::create([
                    'role_id'=>(int)$role->id,
                    'permission_id'=>(int)$item,
                ]);
            }

        } catch (\Exception $err) {
            return false;
        }
        return true;
    }

    public function delete($request){
        $role=Roles::where('id',$request->input('id'))->first();
      
       if( !is_null($role)  ){
         $role_permissions=RolePermissions::where('role_id',$request->input('id'))->get();
         // check condition staff role
         $check_staff=Staffs::where('role_id',$request->input('id'))->exists();
         if($check_staff) return false;
         // delete role -> role permission
            if( !is_null($role_permissions)) {
                RolePermissions::where('role_id',$request->input('id'))->delete();
            } 
            $result=$role->delete();
            return true;
       }
        return false;
    }
    public function update($request){
        try {           
            Roles::where("id", $request->input('id'))->update([
                'name'=>(string)$request->input('name'),
            ]);
            // lấy danh sách role_permissions hiện tại
           // $list_role_permissions=self::getListPermissionsWithRoleID($request->input('id'));
           // xoá role_permissions hiện tại
           RolePermissions::where('role_id',$request->input('id'))->delete();
            // insert cái mới vào
            $role_permissions=$request->input('permission_id');
            foreach ($role_permissions as $item){
                RolePermissions::create([
                    'role_id'=>(int)$request->input('id'),
                    'permission_id'=>(int)$item,
                ]);
            }
        }  catch (\Exception $err)  {
            // session()->flash('error', 'Cập nhật nhân viên thất bại !!! ');
              //Log::info($err->getMessage());
             return false;
         }
         return true;
    }

   
 
    
}
   


