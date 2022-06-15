<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\StaffService;
use App\Models\Staffs;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class LoginController extends Controller
{

    protected $staffService;

    public function __construct(StaffService $staffService)
    {
        $this->staffService = $staffService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.user.login',[
            'title'=>'Đăng Nhập Quản Trị Hệ Thống'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
             
        $this->validate($request,[
            'email' => 'required|email:filter|regex:/^.+@.+$/i',
            'password' => 'required|min:5'
        ]);
        //get Staff
        $staff=$this->staffService->findStaff($request->input('email'));
        if(is_null($staff))
        return response()->json([
            'error'=>true,
            'fail_node'=>'email',
            'message'=>'Tài Khoản Không Tồn Tại hoặc Có Thể Bị Khoá'
        ]);
        else {
            if (Hash::check($request->input('password'), $staff->password)) {
                // Lưu Session 
                Session::put("staff_id",$staff->id );
                Session::put("staff_role_id",$staff->role_id );
                return response()->json([
                    'error'=>false,
                    'fail_node'=>null,
                    'message'=>'Đăng Nhập Thành Công.'
                ]);
            }
            else
            return response()->json([
                'error'=>true,
                'fail_node'=>'password',
                'message'=>'Mật Khẩu Không Đúng'
            ]);
        
    }
        
    }
    public function logout(Request $request){
        if ($request->session()->has('staff_id')) {
            $request->session()->flush();
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('admin.dashboard',[
            'title'=>'Danh sách danh mục',
            'staff'=>$this->staffService->findStaff('admin@gmail.com')
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
