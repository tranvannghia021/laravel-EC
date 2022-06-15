<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staffs;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Services\StaffService;
use App\Http\Services\RoleService;
use Symfony\Component\Console\Command\DumpCompletionCommand;

class StaffController extends Controller
{
    protected $staffService;
    protected $roleService;

    public function __construct(StaffService $staffService, RoleService $roleService, Request $request)
    {
        $this->staffService = $staffService;
        $this->roleService = $roleService;
        return $request;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.staffs.list', [
            'title' => 'Danh Sách Nhân Viên',
            'staff' => $this->staffService->getInFo(Session::get('staff_id')),
            'listStaffs' => $this->staffService->getAll(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.staffs.add', [
            'title' => 'Thêm Nhân Viên',
            'staff' => $this->staffService->getInFo(Session::get('staff_id')),
            'roles' => $this->roleService->getListRoles()
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
        // validate
        // dd($request->all());
        // $this->staffService->create($request);
        if (!is_null($request)) {
            $result = $this->staffService->create($request);
        }
        $staff = $this->staffService->findStaff($request->input('email'));
        if (is_null($staff))
            return response()->json([
                'error' => true,
                'message' => 'Email Exist'
            ]);
        //
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

    public function checkEmailExist(Request $request)
    {
        //check email các table khác không quan tâm vấn đề này
        $staff = $this->staffService->findStaff($request->input('email'));
        if (is_null($staff))
            return response()->json([
                'error' => true,
                'message' => 'Email Exist'
            ]);
        //

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.staffs.edit', [
            'title' => 'Sửa Nhân Viên',
            'staff' => $this->staffService->getInFo(Session::get('staff_id')),
            'roles' => $this->roleService->getListRoles(),
            'staff_edit' => $this->staffService->getInFo($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        
        return view('admin.staffs.list', [
            'title' => 'Danh Sách Nhân Viên',
            'staff' => $this->staffService->getInFo(Session::get('staff_id')),
            'listStaffs' => $this->staffService->getSearch($request),
        ]);
    }

    public function filter(Request $request)
    {
        //dd($this->staffService->getFilter($request));
        return view('admin.staffs.list', [
            'title' => 'Danh Sách Nhân Viên',
            'staff' => $this->staffService->getInFo(Session::get('staff_id')),
            'listStaffs' => $this->staffService->getFilter($request),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       
        $result = $this->staffService->update($request);
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
        $result = $this->staffService->delete($request);
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
