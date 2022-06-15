<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use App\Http\Services\StaffService;
use App\Http\Services\RoleService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    protected $staffService;
    protected $roleService;

    public function __construct(StaffService $staffService, RoleService $roleService)
    {
        $this->staffService = $staffService;
        $this->roleService = $roleService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.roles.list', [
            'title' => 'Danh Sách Quyền',
            'staff' => $this->staffService->getInFo(Session::get('staff_id')),
            'listRoles' => $this->roleService->getListRoles(),
            'listPermissions' => $this->roleService->getListPermissions(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.add', [
            'title' => 'Thêm Quyền',
            'staff' => $this->staffService->getInFo(Session::get('staff_id')),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $checkNameRole=$this->roleService->findRoleWithName($request->input('name'));
        $result = $this->roleService->create($request);
        
        if(!is_null($checkNameRole))
         return response()->json([
            'error' => true,
            'message' => 'Thêm Thất Bại'
        ]);
        if ($result)
            return response()->json([
                'error' => false,
                'message' => 'Thêm Thành Công'
            ]);
        else
            return response()->json([
                'error' => true,
                'message' => 'Thêm Thất Bại'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.roles.edit', [
            'title' => 'Sửa Quyền',
            'staff' => $this->staffService->getInFo(Session::get('staff_id')),
            'Roles' => $this->roleService->findRoleWithID($id),
            'listPermissionschecked' => $this->roleService->getListPermissionsWithRoleID($id),
            'listPermissions' => $this->roleService->getListPermissions(),
        ]);
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
        $result = $this->roleService->update($request);
        if ($result)  
          return response()->json([
             'error' => false,
             'message' => "Cập Nhật Thành Công"
         ]);
         else
             return response()->json([
                 'error' => true,
                'message' => "Cập Nhật Thất Bại"
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $result = $this->roleService->delete($request);
        if($result)  {
            return response()->json([
                'error'=>false,
                'message'=>'Xoá thành công!!!'
            ]);
        }
        return response()->json([
            'error'=>true
        ]);
        
    }
}
