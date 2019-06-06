<?php

namespace App\Http\Controllers;

use App\cvht;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
//    public function  getLogin(){
//        return view('auth.login');
//    }
    public function check(Request $request)
    {
        $data=[
            'ten_dn'=>$request->username,
            'password'=>$request->password,
        ];
        if(Auth::attempt($data)){
            return redirect('covan/');
        }else{
            echo "Thất bại";
        }
    }

    public function getlogin(){
        return view('dangnhap_cvht');
    }

    public function postlogin(Request $request){
        $this -> validate($request,[
            'ten_dn' => 'required|max:50|min:3',
            'password' => 'required|max:10|min:3'
        ],[
            'ten_dn.required' => 'Mã số sinh viên không được trống',
            'ten_dn.max' => 'Mã số sinh viên không quá 50 ký tự',
            'ten_dn.min' => 'Mã số sinh viên không ít hơn 3 ký tự',
            'password.required' => 'Mật khẩu không được trống',
            'password.max' => 'Mật khẩu không quá 10 ký tự',
            'password.min' => 'Mật khẩu không ít hơn 3 ký tự',
        ]);
        $arr = [
            'ten_dn' => $request->ten_dn,
            'password' => $request->password,
        ];
        if (Auth::guard('cvht')->attempt($arr)) {
            $cvht = cvht::where('ten_dn','=',$request -> ten_dn)->first();
//            dd('đăng nhập thành công');
            return redirect('/covan')-> with('thongbao','Đăng nhập thành công');
        } else {
            return redirect('/covanlogin')->with('thongbao1','Đăng nhập không thành công');
        }

    }
}
