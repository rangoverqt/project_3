<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\bithu;//user model can kiem tra
use Auth; //use thư viện auth

class bithuLoginController extends Controller
{
    public function getLogin()
    {
        return view('bithu.bithu_login');//return ra trang login để đăng nhập
    }

    public function postLogin(Request $request)
    {
        $arr = [
            'ten_dn' => $request->ten_dn,
            'password' => $request->password,
        ];
        if ($request->remember == trans('remember.Remember Me')) {
            $remember = true;
        } else {
            $remember = false;
        }
        //kiểm tra trường remember có được chọn hay không
        
        if (Auth::guard('bithu')->attempt($arr)) {

            return redirect('bithu/');
            //..code tùy chọn
            //đăng nhập thành công thì hiển thị thông báo đăng nhập thành công
        } else {

            dd('tài khoản và mật khẩu chưa chính xác');
            //...code tùy chọn
            //đăng nhập thất bại hiển thị đăng nhập thất bại
        }
    }
}