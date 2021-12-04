<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
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
            return redirect()->route('admin.index');
        }
        return back()->with([
            'password' => 'Tài khoản hoặc mật khẩu không chính xác',
        ]);
    }

    public function changePassword(){

    }
}
