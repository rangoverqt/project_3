<?php

namespace App\Http\Controllers;

use App\admin;
use App\chucnang;
use App\chucnang_hk;
use App\chucvu;
use App\cvht;
use App\hocky;
use App\hocvien;
use App\khoa;
use App\lop;
use App\namhoc;
use App\nganh;
use App\phienlamviec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{
    //
    public function getdangnhap(){
        return view('admin.dangnhap_admin');
    }

    public function postdangnhap(Request $request){
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
        if (Auth::guard('admin')->attempt($arr)) {

//            dd('đăng nhập thành công');
            $admin = admin::where('ten_dn','=',$request -> ten_dn)->first();
            return redirect('admin/trangchu/'.$admin -> id)->with('thongbao','Đăng nhập thành công');
        } else {
            return redirect('admin/dangnhap')->with('thongbao1','Đăng nhập không thành công');
        }

    }

    public function dangxuat()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/dangnhap')->with('thongbao','Đăng xuất thành công');
    }

    public function gettrangchu($id){
        $admin = admin::find($id);
        return view('admin.trangchu',['admin'=>$admin]);
    }

    public function getquanly_nd($id){
        $admin = admin::find($id);
        $khoa = khoa::all();
        $nganh = nganh::all();
        view('admin.quanly.nguoidung_lop')->with('admin',$admin);
        return view('admin.quanly.quanly_nguoidung',['admin'=>$admin,'khoa'=>$khoa,'nganh'=>$nganh]);
    }

    public function getndlop($idlop){
        $hocvien = hocvien::where('id_lop','=',$idlop)->get();
        $admin = admin::first();
        $lop = lop::find($idlop);
        if (count(cvht::where('id_lop','=',$idlop)->get()) > 0){
            $cvht = cvht::where('id_lop','=',$idlop)->get();
        }
        else
        {
            $cvht = 'k';
        }
        return view('admin.quanly.nguoidung_lop',['hocvien'=>$hocvien,'lop'=>$lop,'cvht'=>$cvht,
            'admin'=>$admin]);
    }

    public function getthemcvht($idlop){
        $hocvien = hocvien::where('id_lop','=',$idlop)->get();
        $admin = admin::first();
        $lop = lop::find($idlop);
        $cvht_khonglop = cvht::where('id_lop','=',null)->get();
        return view('admin.quanly.them_cvht',['hocvien'=>$hocvien,'lop'=>$lop,
            'admin'=>$admin,'cvht_khonglop'=>$cvht_khonglop]);
    }

    public function postthemmoicvht(Request $request, $idlop){
        $this -> validate($request,[
            'hoten' => 'required|max:50|min:3',
            'tendn' => 'required|max:50|min:3',
            'password' => 'required|max:50|min:3',
            'email' => 'required',
            'ngaysinh' => 'required',
        ],[
            'hoten.required' => 'Họ tên không được trống',
            'hoten.max' => 'Họ tên không quá 50 ký tự',
            'hoten.min' => 'Họ tên không được ít hơn 3 ký tự',
            'tendn.required' => 'Tên đăng nhập không được trống',
            'tendn.max' => 'Tên đăng nhập không được quá 50 ký tự',
            'tendn.min' => 'Tên đăng nhập không được ít hơn 3 ký tự',
            'email.required' => 'Email không được trống',
            'ngaysinh.required' => 'Ngày sinh không được trống'
        ]);

        $cvht = new cvht;
        $cvht -> hoten = $request -> hoten;
        $cvht -> ten_dn = $request -> tendn;
        $cvht -> password = bcrypt($request -> password);
        $cvht -> email = $request -> email;
        $cvht -> sdt = $request -> sdt;
        $cvht -> ngay_sinh = $request -> ngaysinh;
        $cvht -> id_chucvu = 3;
        $cvht -> id_lop = $idlop;
        $cvht -> save();
        return redirect('admin/quanly/nguoidung_lop/'.$idlop)->with('thongbao','Đã thêm Cố vấn học tập');
    }

    public function postchonlaicvht(Request $request, $idlop){
//        dd($request);
        $cvht = cvht::find($request -> idcvht);

        $cvht -> id_lop = $idlop;
        $cvht -> save();
        return redirect('admin/quanly/nguoidung_lop/'.$idlop)->with('thongbao','Đã thêm cố vấn học tập');
    }

    public function xoacvht($idlop){
        $cvht = cvht::where('id_lop','=',$idlop)->first();
        $cvht -> id_lop = null;
        $cvht -> save();
        return redirect('admin/quanly/nguoidung_lop/'.$idlop)->with('thongbao','Đã xóa thành công');
    }

    public function getsuacvht($idlop){
        $cvht = cvht::where('id_lop','=',$idlop)->first();
        $lop = lop::find($idlop);
        $cvht_khonglop = cvht::where('id_lop','=',null)->get();

        return view('admin.quanly.sua_cvht',['cvht'=>$cvht,'lop'=>$lop,'cvht_khonglop'=>$cvht_khonglop]);
    }

    public function postsuacvht(Request $request, $idlop){
        $cvht = cvht::where('id_lop','=',$idlop)->first();
        $cvht -> hoten = $request -> hoten;
        $cvht -> ten_dn = $request -> tendn;
        $cvht -> email = $request -> email;
        $cvht -> sdt = $request -> sdt;
        $cvht -> ngay_sinh = $request -> ngaysinh;
        $cvht -> save();

        return redirect('admin/quanly/nguoidung_lop/'.$idlop)->with('thongbao','Đã sửa thông tin thành công');
    }
    public function postsuachonlaicvht(Request $request, $idlop){
//        dd($request);
        $cvht_ht = cvht::where('id_lop','=',$idlop)->first();
        $cvht_dc = cvht::find($request -> idcvht);

        $cvht_ht -> id_lop = null;
        $cvht_ht -> save();
        $cvht_dc -> id_lop = $idlop;
        $cvht_dc -> save();

        return redirect('admin/quanly/nguoidung_lop/'.$idlop)->with('thongbao','Đã đổi cố vấn học tập');
    }

    public function getsuatthocvien($idhocvien){
        $hocvien = hocvien::find($idhocvien);

        return view('admin.quanly.sua_hv',['hocvien'=>$hocvien]);
    }

    public function postsuatthocvien(Request $request,$idhocvien){
        $hv = hocvien::find($idhocvien);

        $hv -> hoten = $request -> hoten;
        $hv -> email = $request -> email;
        $hv -> sdt = $request -> sdt;
        $hv -> id_chucvu = $request -> chucvu;
        $hv -> save();

        return redirect('admin/quanly/nguoidung_lop/'.$hv -> lop -> id)->with('thongbao','Đã sửa học viên');
    }

    public function xoahocvien($idhocvien){
        $xoa = hocvien::find($idhocvien);

        $xoa -> delete();

        return redirect('admin/quanly/nguoidung_lop/'.$xoa ->  lop -> id)->with('thongbao','Đã xóa thành công');
    }

    public function getthemhv($idlop){
        $lop = lop::find($idlop);
        $hocvien = hocvien::orderBy('mssv','desc')->first();
        return view('admin.quanly.them_hv',['lop'=>$lop,'hocvien'=>$hocvien]);
    }

    public function postthemhv(Request $request,$idlop){
        $this -> validate($request,[
            'hoten' => 'required|max:50|min:3',
            'email' => 'required',
            'ngaysinh' => 'required'
        ],[
            'hoten.required' => 'Họ tên không được trống',
            'hoten.max' => 'Họ tên không quá 50 ký tự',
            'hoten.min' => 'Họ tên không ít hơn 3 ký tự',
            'email.required' => 'Email không được trống',
            'ngaysinh.required' => 'Ngày sinh không được trống'
        ]);

        $hocvien = new hocvien;
        $hocvien -> hoten = $request -> hoten;
        $hocvien -> mssv = $request -> mssv;
        $hocvien -> email = $request -> email;
        $hocvien -> sdt = $request -> sdt;
        $hocvien -> ngay_sinh = $request -> ngaysinh;
        $hocvien -> password = bcrypt(123);
        if ($request -> chucvu == 2){
        $hocvien -> id_chucvu = 2;
            }
            else{
                $hocvien -> id_chucvu = 1;
            }
            $hocvien -> id_lop = $idlop;

            $hocvien -> save();
            return redirect('admin/quanly/nguoidung_lop/'.$idlop)->with('thongbao','Đã thêm học viên');
    }

    public function phienphanquyen($idadmin){
        $namhoc = namhoc::all();
        $hocky = hocky::all();
        $admin = admin::find($idadmin);
        $phienlamviec_check = phienlamviec::count();
        $phienlamviec = phienlamviec::first();
        return view('admin.quanly.phien_phanquyen',['namhoc'=>$namhoc,'hocky'=>$hocky,
            'phienlamviec_check'=>$phienlamviec_check,'phienlamviec'=>$phienlamviec,
            'admin'=>$admin]);
    }

    public function phanquyen_chucnang($idhocky){
        $admin = admin::first();
        $hocky = hocky::find($idhocky);
        $chucnang = chucnang::all();
        $hocvien = chucvu::where('ten_chucvu','=','Sinh viên')->first();
        $cvht = chucvu::where('ten_chucvu','=','Cố vấn học tập')->first();
        $loptruong = chucvu::where('ten_chucvu','=','Lớp trưởng')->first();
        if (count(chucnang_hk::where('id_hocky','=',$idhocky)->get()) > 0){
        $chucnang_hk = chucnang_hk::where('id_hocky','=',$idhocky)->get();
        }
        else{
            $chucnang_hk = 'k';
        }
        return view('admin.quanly.phanquyen_chucnang',['hocky'=>$hocky,'admin'=>$admin,
            'chucnang'=>$chucnang,'hocvien'=>$hocvien,'cvht'=>$cvht,'loptruong'=>$loptruong,
            'chucnang_hk'=>$chucnang_hk]);
    }

    public function postphanquyen_chucnang(Request $request,$idhocky){
//        dd($request);
        $this -> validate($request,[
            'chucnang' => 'required'
        ],[
            'chucnang.required' => 'Phân quyền phải chọn'
        ]);
        $chucnang_hk = new chucnang_hk;
        $chucnang_hk -> id_hocky = $idhocky;
        $chucnang_hk -> id_chucnang = $request -> chucnang;
        $chucnang_hk -> save();

        $id_chucnang_hk = chucnang_hk::where('id_hocky','=',$idhocky)->where('id_chucnang','=',$request -> chucnang)
            ->first();
        if ($request -> chucnang == 2){
            $chucvu = chucvu::where('ten_chucvu','=','Sinh viên')->first();
            $chucvu -> id_chucnang_hk = $id_chucnang_hk -> id;
            $chucvu -> save();
            $chucvu1 = chucvu::where('ten_chucvu','=','Lớp trưởng')->first();
            $chucvu1 -> id_chucnang_hk = $id_chucnang_hk -> id;
            $chucvu1 -> save();
        }
        elseif ($request -> chucnang == 3){
            $chucvu = chucvu::where('ten_chucvu','=','Lớp trưởng')->first();
            $chucvu -> id_chucnang_hk = $id_chucnang_hk -> id;
            $chucvu -> save();
            $chucvu1 = chucvu::where('ten_chucvu','=','Sinh viên')->first();
            $chucvu1 -> id_chucnang_hk = null;
            $chucvu1 -> save();
        }
        elseif ($request -> chucnang == 4){
            $chucvu = chucvu::where('ten_chucvu','=','Cố vấn học tập')->first();
            $chucvu -> id_chucnang_hk = $id_chucnang_hk -> id;
            $chucvu -> save();
            $chucvu1 = chucvu::where('ten_chucvu','=','Lớp trưởng')->first();
            $chucvu1 -> id_chucnang_hk = null;
            $chucvu1 -> save();
        }
        elseif ($request -> chucnang == 5){
            $chucvu = chucvu::where('ten_chucvu','=','Cố vấn học tập')->first();
            $chucvu -> id_chucnang_hk = null;
            $chucvu -> save();
            $chucvu1 = chucvu::where('ten_chucvu','=','Sinh viên')->first();
            $chucvu1 -> id_chucnang_hk = $id_chucnang_hk -> id;
            $chucvu1 -> save();
            $chucvu2 = chucvu::where('ten_chucvu','=','Lớp trưởng')->first();
            $chucvu2 -> id_chucnang_hk = $id_chucnang_hk -> id;
            $chucvu2 -> save();
        }
        else{
            $chucvu = chucvu::where('ten_chucvu','=','Cố vấn học tập')->first();
            $chucvu -> id_chucnang_hk = $id_chucnang_hk -> id;
            $chucvu -> save();
            $chucvu1 = chucvu::where('ten_chucvu','=','Sinh viên')->first();
            $chucvu1 -> id_chucnang_hk = null;
            $chucvu1 -> save();
            $chucvu2 = chucvu::where('ten_chucvu','=','Lớp trưởng')->first();
            $chucvu2 -> id_chucnang_hk = null;
            $chucvu2 -> save();
        }
        return redirect('admin/quanly/phanquyen_chucnang/'.$idhocky)->with('thongbao','Đã phân quyền thành công');
    }

    public function chuyentrang($idhocky){
        $hocky = hocky::find($idhocky);
        $phienlamviec = new phienlamviec;
        $phienlamviec -> id_hocky = $idhocky;
        $phienlamviec -> id_namhoc = $hocky -> id_namhoc;
        $phienlamviec -> save();

        return redirect('admin/quanly/phanquyen_chucnang/'.$idhocky)->with('thongbao','Đã lưu phiên làm việc');
    }

    public function xoa_phienlamviec($idadmin){
        $null_hv = chucvu::where('ten_chucvu','=','Sinh viên')->first();
        $null_hv -> id_chucnang_hk = null;
        $null_hv -> save();
        $null_loptruong = chucvu::where('ten_chucvu','=','Lớp trưởng')->first();
        $null_loptruong -> id_chucnang_hk = null;
        $null_loptruong -> save();
        $null_cvht = chucvu::where('ten_chucvu','=','Cố vấn học tập')->first();
        $null_cvht -> id_chucnang_hk = null;
        $null_cvht -> save();
        $xoa = phienlamviec::first()->delete();
        $xoa_chucnang_hk = chucnang_hk::whereNotNull('id')->delete();
        return redirect('admin/quanly/phienphanquyen/'.$idadmin)->with('thongbao','Đã xóa phiên làm việc');
    }

    public function dongphanquyen_tucham($idhocky){
        $null_hv = chucvu::where('ten_chucvu','=','Sinh viên')->first();
        $null_hv -> id_chucnang_hk = null;
        $null_hv -> save();
        $null_loptruong = chucvu::where('ten_chucvu','=','Lớp trưởng')->first();
        $null_loptruong -> id_chucnang_hk = null;
        $null_loptruong -> save();
        return redirect('admin/quanly/phanquyen_chucnang/'.$idhocky)->with('thongbao','Đã đóng phân quyền tự chấm');
    }

    public function dongphanquyen_chamlan1($idhocky){
        $null_loptruong = chucvu::where('ten_chucvu','=','Lớp trưởng')->first();
        $null_loptruong -> id_chucnang_hk = null;
        $null_loptruong -> save();
        return redirect('admin/quanly/phanquyen_chucnang/'.$idhocky)->with('thongbao','Đã đóng phân quyền chấm lần 1');
    }

    public function dongphanquyen_chamlan2($idhocky){
        $null_cvht = chucvu::where('ten_chucvu','=','Cố vấn học tập')->first();
        $null_cvht -> id_chucnang_hk = null;
        $null_cvht -> save();
        return redirect('admin/quanly/phanquyen_chucnang/'.$idhocky)->with('thongbao','Đã đóng phân quyền chấm lần 2');
    }

    public function dongphanquyen_yeucau($idhocky){
        $null_hv = chucvu::where('ten_chucvu','=','Sinh viên')->first();
        $null_hv -> id_chucnang_hk = null;
        $null_hv -> save();
        $null_loptruong = chucvu::where('ten_chucvu','=','Lớp trưởng')->first();
        $null_loptruong -> id_chucnang_hk = null;
        $null_loptruong -> save();
        return redirect('admin/quanly/phanquyen_chucnang/'.$idhocky)->with('thongbao','Đã đóng phân quyền yêu cầu');
    }
    public function dongphanquyen_xemyeucau($idhocky){
        $null_cvht = chucvu::where('ten_chucvu','=','Cố vấn học tập')->first();
        $null_cvht -> id_chucnang_hk = null;
        $null_cvht -> save();
        return redirect('admin/quanly/phanquyen_chucnang/'.$idhocky)->with('thongbao','Đã đóng phân quyền xem yêu cầu');
    }


}
