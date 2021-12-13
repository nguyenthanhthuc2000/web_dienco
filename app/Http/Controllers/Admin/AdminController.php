<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repository\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    protected $userRepo;
    public function __construct(
        UserRepositoryInterface $userRepo
    )
    {
        $this->userRepo = $userRepo;
    }

    public function index(){

        return view('admin.index');
    }

    public function login(){
        return view('admin.login');
    }

    public function logout(Request $request){

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function postChangePassword(Request $request){
        $this->validate($request,
            [
                'password' => ['required'],
                'newpassword' => ['required'],
                'confirmpassword' => ['required','same:newpassword'],
            ],
            [
                'password.required' => 'Vui lòng nhập mật khẩu',
                'newpassword.required' =>  'Vui lòng nhập mật khẩu mới',
                'confirmpassword.required' => 'Vui lòng nhập mật khẩu xác nhận',
                'confirmpassword.same' => 'Mật khẩu xác nhận không đúng'
            ],
        );

        if (Hash::check($request->password, Auth::user()->password))
        {
            $arr = array(
                'password' => Hash::make($request->newpassword)
            );
            $update = $this->userRepo->update(Auth::id(), $arr);
            if($update){
                return back()->with('success', 'Đổi mật khẩu thành công!');
            }
            return back()->with('error', 'Lỗi, vui lòng thử lại!');
        }
        return back()->with('error', 'Sai mật khẩu hiện tại!');

    }


    public function postLogin(Request $request){

        $this->validate($request,
            [
                'email' => ['required', 'email'],
                'password' => ['required'],
            ],
            [
                'email.required' => 'Vui lòng nhập địa chỉ email',
                'email.email' =>  'Email chưa đúng định dạng',
                'password.required' => 'Vui lòng nhập mật khẩu'
            ],
        );
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if(Auth::user()->status == 0){
                return back()->with([
                    'error' => 'Tài khoản đã bị khóa',
                 ]);
            }
            return redirect()->route('admin.index');
        }
        return back()->with([
            'error' => 'Tài khoản hoặc mật khẩu không chính xác',
        ]);
    }

    public function changePassword(){
        return view('admin.change_password');
    }
}
