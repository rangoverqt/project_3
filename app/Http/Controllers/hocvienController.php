<?php

namespace App\Http\Controllers;

use App\bangdiem;
use App\bangdiem_chitiet;
use App\bangdiem_chitiet_lan1;
use App\bangdiem_lan1;
use App\bangdiem_yeucau;
use App\chucnang;
use App\chucnang_hk;
use App\chucvu;
use App\hoatdong;
use App\hoatdong_hk_lop;
use App\hocky;
use App\hocvien;
use App\Imports\hocvienImport;
use App\lop;
use App\lop_nh;
use App\lydo_yeucau;
use App\namhoc;
use App\nganh;
use App\phieu_dd;
use App\thanhtich;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;


class hocvienController extends Controller
{
    //

//    public function __construct() {
//        $this->middleware('hocvien_mid',['except' => 'dangxuat']);
//    }


    public function getdangnhap(){
        return view('hocvien.dangnhap_hocvien');
    }

    public function postdangnhap(Request $request){
        $this -> validate($request,[
            'mssv' => 'required|max:50|min:3',
            'password' => 'required|max:10|min:3'
        ],[
            'mssv.required' => 'Mã số sinh viên không được trống',
            'mssv.max' => 'Mã số sinh viên không quá 50 ký tự',
            'mssv.min' => 'Mã số sinh viên không ít hơn 3 ký tự',
            'password.required' => 'Mật khẩu không được trống',
            'password.max' => 'Mật khẩu không quá 10 ký tự',
            'password.min' => 'Mật khẩu không ít hơn 3 ký tự',
        ]);
        $arr = [
            'mssv' => $request->mssv,
            'password' => $request->password,
        ];
        if (Auth::guard('hocvien')->attempt($arr)) {

//            dd('đăng nhập thành công');
            $hocvien = hocvien::where('mssv','=',$request -> mssv)->first();
            return redirect('hocvien/trangchu/'.$hocvien -> id)->with('thongbao','Đăng nhập thành công');
        } else {
            return redirect('hocvien/dangnhap')->with('thongbao1','Đăng nhập không thành công');
        }

    }

    public function getdangxuat()
    {
        Auth::guard('hocvien')->logout();
        return redirect('hocvien/dangnhap')->with('thongbao','Đăng xuất thành công');
    }


    public function gettrangchu($id){
//        dd(Auth::guard('hocvien')->check());
        $hocvien = hocvien::find($id);
        $chucvu_hk = chucnang_hk::find($hocvien->chucvu->id_chucnang_hk);
        if ($chucvu_hk == null){
            $bangdiem_lan2 = bangdiem_lan1::where('id_hocvien','=',$id)->first();
            $bangdiem_tc = 'k';
        }
        else{
        $bangdiem_tc = bangdiem::where('id_hocvien','=',$id)->where('id_hocky','=',$chucvu_hk -> hocky -> id)->get();
        $bangdiem_lan2 = bangdiem_lan1::where('id_hocvien','=',$id)->where('id_hocky','=',$chucvu_hk -> hocky -> id)->first();
        }
            if (bangdiem_lan1::where('id_hocvien','=',$id)->count() && $bangdiem_lan2 -> lan_2 == 1) {
                $bangdiem = bangdiem_lan1::where('id_hocvien', '=', $id)->get();
                foreach ($bangdiem as $bd) {
                    $namhoc = namhoc::where('id', '=', $bd->hocky->id_namhoc)->get();
                }
                return view('hocvien.trangchu', ['hocvien' => $hocvien, 'bangdiem' => $bangdiem, 'namhoc' => $namhoc,
                    'chucvu_hk' => $chucvu_hk,'bangdiem_tc' => $bangdiem_tc]);
            }
            else{
                return view('hocvien.trangchu',['hocvien'=>$hocvien,'chucvu_hk'=>$chucvu_hk,'bangdiem_tc' => $bangdiem_tc]);
            }
    }

    public function suatucham($idhocvien){
        $hocvien = hocvien::find($idhocvien);
        $chucvu_hk = chucnang_hk::find($hocvien->chucvu->id_chucnang_hk);
        $xoa = bangdiem::where('id_hocvien','=',$idhocvien)->where('id_hocky','=',$chucvu_hk -> hocky -> id)->delete();
//        dd($xoa);
        $phieu_dd = phieu_dd::where('id_hocvien','=',$idhocvien)->get();
        $thanhtich = thanhtich::where('id_hocvien','=',$idhocvien)->get();
        if (count($phieu_dd) > 0){
        foreach ($phieu_dd as $pd){
            $hoatdong[] = hoatdong_hk_lop::where('id_hoatdong','=',$pd -> id_hoatdong)
                ->where('id_hocky','=',$chucvu_hk -> id_hocky)->where('id_lop','=',$hocvien -> id_lop)->get();
        }
        $sum = 0;
        foreach ($hoatdong as $key => $hd){
            foreach ($hd as $hd1){
                $sum += $hd1 -> hoatdong -> diem;
            }
        }
        if ($sum > 12){
            $sum1 = 12;
        }
        else{
            $sum1 = $sum;
        }
        }
        else{
            $sum1 = 0;
            $hoatdong = 0;
        }
        if (count(thanhtich::where('id_hocvien','=',$hocvien -> id)->get()) > 0){
            $test = thanhtich::where('id_hocvien','=',$hocvien -> id)->get();
        }
        else{
            $test = 0;
        }
        if (count($thanhtich) > 0){
        foreach ($thanhtich as $tt){
            $hoatdong_tt[] = hoatdong_hk_lop::where('id_hoatdong','=',$tt -> id_hoatdong)
                ->where('id_hocky','=',$chucvu_hk -> id_hocky)->where('id_lop','=',$hocvien -> id_lop)->get();
        }
        foreach ($hoatdong_tt as $key => $hd){
            foreach ($hd as $hd1){
                $tt_check = thanhtich::where('id_hoatdong','=',$hd1 -> hoatdong -> id)
                    ->where('id_hocvien','=',$idhocvien)->count();
            }
        }
//        dd($tt -> hang);
//        dd($sum);
//        dd($hoatdong);
//        dd($hoatdong_tt);
        if ($tt_check > 0){
            $diem_tt = 6;
        }
        else {
            $diem_tt = 0;
        }
        }
        else{
            $diem_tt = 0;
            $hoatdong_tt = 0;
        }
        return view('hocvien.suatucham',['hocvien'=>$hocvien,'chucvu_hk'=>$chucvu_hk,'phieu_dd'=>$phieu_dd,
            'hoatdong'=>$hoatdong,'sum'=>$sum1,'hoatdong_tt'=>$hoatdong_tt,'diem_tt'=>$diem_tt,'test'=>$test]);
    }

    public function getthemtucham($idhocvien){
        $hocvien = hocvien::find($idhocvien);
        $chucvu_hk = chucnang_hk::find($hocvien->chucvu->id_chucnang_hk);
        $phieu_dd = phieu_dd::where('id_hocvien','=',$idhocvien)->get();
        $thanhtich = thanhtich::where('id_hocvien','=',$idhocvien)->get();
        if (count($phieu_dd) > 0){
        foreach ($phieu_dd as $pd){
         $hoatdong[] = hoatdong_hk_lop::where('id_hoatdong','=',$pd -> id_hoatdong)
             ->where('id_hocky','=',$chucvu_hk -> id_hocky)->where('id_lop','=',$hocvien -> id_lop)->get();
        }
        $sum = 0;
        foreach ($hoatdong as $key => $hd){
            foreach ($hd as $hd1){
                $sum += $hd1 -> hoatdong -> diem;
            }
        }
        if ($sum > 12){
            $sum1 = 12;
        }
        else{
            $sum1 = $sum;
        }
        }
        else{
            $sum1 = 0;
            $hoatdong = 0;
        }
        if (count(thanhtich::where('id_hocvien','=',$hocvien -> id)->get()) > 0){
            $test = thanhtich::where('id_hocvien','=',$hocvien -> id)->get();
        }
        else{
            $test = 0;
        }
        if (count($thanhtich) > 0){
        foreach ($thanhtich as $tt){
            $hoatdong_tt[] = hoatdong_hk_lop::where('id_hoatdong','=',$tt -> id_hoatdong)
                ->where('id_hocky','=',$chucvu_hk -> id_hocky)->where('id_lop','=',$hocvien -> id_lop)->get();
        }
        foreach ($hoatdong_tt as $key => $hd){
            foreach ($hd as $hd1){
                $tt_check = thanhtich::where('id_hoatdong','=',$hd1 -> hoatdong -> id)
                    ->where('id_hocvien','=',$idhocvien)->count();
            }
        }
//        dd($tt -> hang);
//        dd($sum);
//        dd($hoatdong);
//        dd($hoatdong_tt);
        if ($tt_check > 0){
            $diem_tt = 6;
        }
        else {
            $diem_tt = 0;
        }
        }
        else{
            $diem_tt = 0;
            $hoatdong_tt = 0;
        }
        return view('hocvien.tucham',['hocvien'=>$hocvien,'chucvu_hk'=>$chucvu_hk,'phieu_dd'=>$phieu_dd,
            'hoatdong'=>$hoatdong,'sum'=>$sum1,'hoatdong_tt'=>$hoatdong_tt,'diem_tt'=>$diem_tt,'test'=>$test]);
    }

    public function postthemtucham(Request $request,$idhocvien){
//        dd($request);
        $bangdiem = new bangdiem;
        $p1 = $request -> result1;
        $p2 = $request -> result2;
        $p3 = $request -> result3;
        $p4 = $request -> result4;
        $p5 = $request -> result5;
        $diemtong = $p1 + $p2 + $p3 + $p4 + $p5;
        $bangdiem -> diemtong = $diemtong;
        if ($diemtong >= 0 && $diemtong <= 30){
            $bangdiem -> xeploai = "Yếu";
        }
        elseif ($diemtong > 30 && $diemtong <= 50){
            $bangdiem -> xeploai = "Trung bình";
        }
        elseif ($diemtong > 50 && $diemtong <= 60){
            $bangdiem -> xeploai = "Trung bình - Khá";
        }
        elseif ($diemtong > 60 && $diemtong <= 70){
            $bangdiem -> xeploai = "Khá";
        }
        elseif ($diemtong > 70 && $diemtong <= 80){
            $bangdiem -> xeploai = "Khá - Giỏi";
        }
        elseif ($diemtong > 80 && $diemtong <= 90){
            $bangdiem -> xeploai = "Giỏi";
        }
        elseif ($diemtong > 90 && $diemtong <= 100){
            $bangdiem -> xeploai = "Xuất sắc";
        }
        $bangdiem -> id_hocky = $request -> hocky;
        $bangdiem -> id_hocvien = $idhocvien;
        $bangdiem -> save();

        $id_bangdiem = bangdiem::where('id_hocvien','=',$idhocvien)->where('id_hocky','=',$request -> hocky)->first();
        $bangdiem_chitiet = new bangdiem_chitiet;
        $bangdiem_chitiet -> p1_a_1 = $request -> p1_a_1;
        $bangdiem_chitiet -> p1_a_2 = $request -> p1_a_2;
        $bangdiem_chitiet -> p1_a_3 = $request -> p1_a_3;
        $bangdiem_chitiet -> p1_a_4 = $request -> p1_a_4;
        $bangdiem_chitiet -> chungchi_a = $request -> chungchi_a;
        $bangdiem_chitiet -> chungchi_b = $request -> chungchi_b;
        $bangdiem_chitiet -> chungchi_c = $request -> chungchi_c;
        $bangdiem_chitiet -> toeic = $request -> toeic;
        $bangdiem_chitiet -> p2_1 = $request -> p2_1;
        $bangdiem_chitiet -> p2_2_1 = $request -> p2_2_1;
        $bangdiem_chitiet -> p2_2_2 = $request -> p2_2_2;
        $bangdiem_chitiet -> p3_1 = $request -> p3_1;
        $bangdiem_chitiet -> p3_2_1 = $request -> p3_2_1;
        $bangdiem_chitiet -> p3_2_2 = $request -> p3_2_2;
        $bangdiem_chitiet -> p3_3_1 = $request -> p3_3_1;
        $bangdiem_chitiet -> p3_3_2 = $request -> p3_3_2;
        $bangdiem_chitiet -> p3_3_3 = $request -> p3_3_3;
        $bangdiem_chitiet -> p4_1 = $request -> p4_1;
        $bangdiem_chitiet -> p4_2 = $request -> p4_2;
        $bangdiem_chitiet -> p4_3 = $request -> p4_3;
        $bangdiem_chitiet -> p5_1 = $request -> p5_1;
        $bangdiem_chitiet -> p5_2 = $request -> p5_2;
        $bangdiem_chitiet -> p5_3 = $request -> p5_3;
        $bangdiem_chitiet -> id_bangdiem = $id_bangdiem -> id;
        $bangdiem_chitiet -> save();
        return redirect('hocvien/bangdiem/xemtucham/'.$idhocvien)->with('thongbao','Đã thêm bản điểm tự chấm');
    }

    public function postsuatucham(Request $request,$idhocvien){
        $bangdiem = new bangdiem;
        $p1 = $request -> result1;
        $p2 = $request -> result2;
        $p3 = $request -> result3;
        $p4 = $request -> result4;
        $p5 = $request -> result5;
        $diemtong = $p1 + $p2 + $p3 + $p4 + $p5;
        $bangdiem -> diemtong = $diemtong;
        if ($diemtong >= 0 && $diemtong <= 30){
            $bangdiem -> xeploai = "Yếu";
        }
        elseif ($diemtong > 30 && $diemtong <= 50){
            $bangdiem -> xeploai = "Trung bình";
        }
        elseif ($diemtong > 50 && $diemtong <= 60){
            $bangdiem -> xeploai = "Trung bình - Khá";
        }
        elseif ($diemtong > 60 && $diemtong <= 70){
            $bangdiem -> xeploai = "Khá";
        }
        elseif ($diemtong > 70 && $diemtong <= 80){
            $bangdiem -> xeploai = "Khá - Giỏi";
        }
        elseif ($diemtong > 80 && $diemtong <= 90){
            $bangdiem -> xeploai = "Giỏi";
        }
        elseif ($diemtong > 90 && $diemtong <= 100){
            $bangdiem -> xeploai = "Xuất sắc";
        }
        $bangdiem -> id_hocky = $request -> hocky;
        $bangdiem -> id_hocvien = $idhocvien;
        $bangdiem -> save();

        $id_bangdiem = bangdiem::where('id_hocvien','=',$idhocvien)->where('id_hocky','=',$request -> hocky)->first();
        $bangdiem_chitiet = new bangdiem_chitiet;
        $bangdiem_chitiet -> p1_a_1 = $request -> p1_a_1;
        $bangdiem_chitiet -> p1_a_2 = $request -> p1_a_2;
        $bangdiem_chitiet -> p1_a_3 = $request -> p1_a_3;
        $bangdiem_chitiet -> p1_a_4 = $request -> p1_a_4;
        $bangdiem_chitiet -> chungchi_a = $request -> chungchi_a;
        $bangdiem_chitiet -> chungchi_b = $request -> chungchi_b;
        $bangdiem_chitiet -> chungchi_c = $request -> chungchi_c;
        $bangdiem_chitiet -> toeic = $request -> toeic;
        $bangdiem_chitiet -> p2_1 = $request -> p2_1;
        $bangdiem_chitiet -> p2_2_1 = $request -> p2_2_1;
        $bangdiem_chitiet -> p2_2_2 = $request -> p2_2_2;
        $bangdiem_chitiet -> p3_1 = $request -> p3_1;
        $bangdiem_chitiet -> p3_2_1 = $request -> p3_2_1;
        $bangdiem_chitiet -> p3_2_2 = $request -> p3_2_2;
        $bangdiem_chitiet -> p3_3_1 = $request -> p3_3_1;
        $bangdiem_chitiet -> p3_3_2 = $request -> p3_3_2;
        $bangdiem_chitiet -> p3_3_3 = $request -> p3_3_3;
        $bangdiem_chitiet -> p4_1 = $request -> p4_1;
        $bangdiem_chitiet -> p4_2 = $request -> p4_2;
        $bangdiem_chitiet -> p4_3 = $request -> p4_3;
        $bangdiem_chitiet -> p5_1 = $request -> p5_1;
        $bangdiem_chitiet -> p5_2 = $request -> p5_2;
        $bangdiem_chitiet -> p5_3 = $request -> p5_3;
        $bangdiem_chitiet -> id_bangdiem = $id_bangdiem -> id;
        $bangdiem_chitiet -> save();
        return redirect('hocvien/bangdiem/xemtucham/'.$idhocvien)->with('thongbao','Đã thêm bản điểm tự chấm');
    }

    public function xemtucham($idhocvien){
        $hocvien = hocvien::find($idhocvien);
        $chucvu_hk = chucnang_hk::find($hocvien->chucvu->id_chucnang_hk);
        $bangdiem = bangdiem::where('id_hocvien','=',$hocvien->id)->where('id_hocky','=',
            $chucvu_hk->hocky->id)->first();
        $bangdiem_chitiet = bangdiem_chitiet::where('id_bangdiem','=',$bangdiem -> id)->first();

        $tong1 = bangdiem_chitiet::where('id_bangdiem','=',$bangdiem -> id)
            ->sum(DB::raw('IFNULL(p1_a_1,0) + IFNULL(p1_a_2,0) + IFNULL(p1_a_3,0) + IFNULL(p1_a_4,0) 
            + IFNULL(chungchi_a,0) + IFNULL(chungchi_b,0)
            + IFNULL(chungchi_c,0) + IFNULL(toeic,0)'));
        if ($tong1 > 30){
            $tong1 = 30;
        }
        $tong2 = bangdiem_chitiet::where('id_bangdiem','=',$bangdiem -> id)
            ->sum(DB::raw('IFNULL(p2_1,0) + IFNULL(p2_2_1,0) + IFNULL(p2_2_2,0)'));
        if ($tong2 > 25){
            $tong2 = 25;
        }
        $tong3 = bangdiem_chitiet::where('id_bangdiem','=',$bangdiem -> id)
            ->sum(DB::raw('IFNULL(p3_1,0) + IFNULL(p3_2_1,0) + IFNULL(p3_2_2,0) + IFNULL(p3_3_1,0)
            + IFNULL(p3_3_2,0) + IFNULL(p3_3_3,0)'));
        if ($tong3 > 20){
            $tong3 = 20;
        }
        $tong4 = bangdiem_chitiet::where('id_bangdiem','=',$bangdiem -> id)
            ->sum(DB::raw('IFNULL(p4_1,0) + IFNULL(p4_2,0) + IFNULL(p4_3,0)'));
        if ($tong4 > 15){
            $tong4 = 15;
        }
        $tong5 = bangdiem_chitiet::where('id_bangdiem','=',$bangdiem -> id)
            ->sum(DB::raw('IFNULL(p5_1,0) + IFNULL(p5_2,0) + IFNULL(p5_3,0)'));
        if ($tong5 > 10){
            $tong5 = 10;
        }
        return view('hocvien.xemtucham',['hocvien'=>$hocvien,'chucvu_hk'=>$chucvu_hk,'tong1'=>$tong1,
            'tong2'=>$tong2,'tong3'=>$tong3,'tong4'=>$tong4,'tong5'=>$tong5,'bangdiem'=>$bangdiem,
            'bangdiem_chitiet'=>$bangdiem_chitiet]);
    }
    public function gethoatdong($idlop){
        $namhoc = lop_nh::where('id_lop','=',$idlop)->get();
        $lop = lop::find($idlop);
        $hocvien = hocvien::where('id_lop','=',$idlop)->where('id_chucvu','=',2)->first();
        return view('hocvien.quanly.hoatdong',['namhoc'=>$namhoc,'lop'=>$lop,'hocvien'=>$hocvien]);
    }

    public function getxemchitiet($idbangdiem){
        $bangdiem_lan1 = bangdiem_lan1::find($idbangdiem);
        $bangdiem_yeucau = bangdiem_yeucau::where('id_bangdiem_lan1','=',$idbangdiem)->count();
        $namhoc = hocky::find($bangdiem_lan1 -> id_hocky);
        $hocvien = hocvien::find($bangdiem_lan1 -> id_hocvien);
        $chucvu_hk = chucnang_hk::find($hocvien -> chucvu -> id_chucnang_hk);
        $bangdiem_chitiet_lan1 = bangdiem_chitiet_lan1::where('id_bangdiem','=',$bangdiem_lan1 -> id)->first();
        $tong1_lan1 = bangdiem_chitiet_lan1::where('id_bangdiem','=',$idbangdiem)
            ->sum(DB::raw('IFNULL(p1_a_1,0) + IFNULL(p1_a_2,0) + IFNULL(p1_a_3,0) + IFNULL(p1_a_4,0) 
            + IFNULL(chungchi_a,0) + IFNULL(chungchi_b,0)
            + IFNULL(chungchi_c,0) + IFNULL(toeic,0)'));
        if ($tong1_lan1 > 30){
            $tong1_lan1 = 30;
        }
        $tong2_lan1 = bangdiem_chitiet_lan1::where('id_bangdiem','=',$idbangdiem)
            ->sum(DB::raw('IFNULL(p2_1,0) + IFNULL(p2_2_1,0) + IFNULL(p2_2_2,0)'));
        if ($tong2_lan1 > 25){
            $tong2_lan1 = 25;
        }
        $tong3_lan1 = bangdiem_chitiet_lan1::where('id_bangdiem','=',$idbangdiem)
            ->sum(DB::raw('IFNULL(p3_1,0) + IFNULL(p3_2_1,0) + IFNULL(p3_2_2,0) + IFNULL(p3_3_1,0)
            + IFNULL(p3_3_2,0) + IFNULL(p3_3_3,0)'));
        if ($tong3_lan1 > 20){
            $tong3_lan1 = 20;
        }
        $tong4_lan1 = bangdiem_chitiet_lan1::where('id_bangdiem','=',$idbangdiem)
            ->sum(DB::raw('IFNULL(p4_1,0) + IFNULL(p4_2,0) + IFNULL(p4_3,0)'));
        if ($tong4_lan1 > 15){
            $tong4_lan1 = 15;
        }
        $tong5_lan1 = bangdiem_chitiet_lan1::where('id_bangdiem','=',$idbangdiem)
            ->sum(DB::raw('IFNULL(p5_1,0) + IFNULL(p5_2,0) + IFNULL(p5_3,0)'));
        if ($tong5_lan1 > 10){
            $tong5_lan1 = 10;
        }
        ///////////////////////////////////////////////////////////////
        $bangdiem = bangdiem::where('id_hocvien','=',$bangdiem_lan1 -> id_hocvien)
            ->where('id_hocky','=',$bangdiem_lan1 -> id_hocky)->first();
        $bangdiem_check = bangdiem::where('id_hocvien','=',$bangdiem_lan1 -> id_hocvien)
            ->where('id_hocky','=',$bangdiem_lan1 -> id_hocky)->get();
        if (count($bangdiem_check) > 0){
        $bangdiem_chitiet = bangdiem_chitiet::where('id_bangdiem','=',$bangdiem -> id)->first();
        $tong1 = bangdiem_chitiet::where('id_bangdiem','=',$bangdiem -> id)
            ->sum(DB::raw('IFNULL(p1_a_1,0) + IFNULL(p1_a_2,0) + IFNULL(p1_a_3,0) + IFNULL(p1_a_4,0) 
            + IFNULL(chungchi_a,0) + IFNULL(chungchi_b,0)
            + IFNULL(chungchi_c,0) + IFNULL(toeic,0)'));
        if ($tong1 > 30){
            $tong1 = 30;
        }
        $tong2 = bangdiem_chitiet::where('id_bangdiem','=',$bangdiem -> id)
            ->sum(DB::raw('IFNULL(p2_1,0) + IFNULL(p2_2_1,0) + IFNULL(p2_2_2,0)'));
        if ($tong2 > 25){
            $tong2 = 25;
        }
        $tong3 = bangdiem_chitiet::where('id_bangdiem','=',$bangdiem -> id)
            ->sum(DB::raw('IFNULL(p3_1,0) + IFNULL(p3_2_1,0) + IFNULL(p3_2_2,0) + IFNULL(p3_3_1,0)
            + IFNULL(p3_3_2,0) + IFNULL(p3_3_3,0)'));
        if ($tong3 > 20){
            $tong3 = 20;
        }
        $tong4 = bangdiem_chitiet::where('id_bangdiem','=',$bangdiem -> id)
            ->sum(DB::raw('IFNULL(p4_1,0) + IFNULL(p4_2,0) + IFNULL(p4_3,0)'));
        if ($tong4 > 15){
            $tong4 = 15;
        }
        $tong5 = bangdiem_chitiet::where('id_bangdiem','=',$bangdiem -> id)
            ->sum(DB::raw('IFNULL(p5_1,0) + IFNULL(p5_2,0) + IFNULL(p5_3,0)'));
        if ($tong5 > 10){
            $tong5 = 10;
        }
        }
        else{
            $tong1 = $tong2 = $tong3 = $tong4 = $tong5 = 'k';
            $bangdiem_chitiet = null;
        }
        /////////////////////////////////////////////////////////////
        return view('hocvien.xemchitiet',['bangdiem_lan1'=>$bangdiem_lan1,'namhoc'=>$namhoc,'hocvien'=>$hocvien,
            'tong1_lan1'=>$tong1_lan1,'tong2_lan1'=>$tong2_lan1,'tong3_lan1'=>$tong3_lan1,'tong4_lan1'=>$tong4_lan1,
            'tong5_lan1'=>$tong5_lan1,
            'tong1'=>$tong1,'tong2'=>$tong2,'tong3'=>$tong3,'tong4'=>$tong4,'tong5'=>$tong5,
            'bangdiem_chitiet_lan1'=>$bangdiem_chitiet_lan1,
            'bangdiem_chitiet'=>$bangdiem_chitiet,
            'chucvu_hk' => $chucvu_hk,'bangdiem_yeucau'=>$bangdiem_yeucau]);
    }

    public function gettrangchu_lt($id) {
        $loptruong = hocvien::find($id);
        $chucvu_hk = chucnang_hk::find($loptruong->chucvu->id_chucnang_hk);

        return view('hocvien.quanly.trangchu',['loptruong' => $loptruong,'chucvu_hk'=>$chucvu_hk]);
    }

    public function getdanhsachhv($idlop){
        $hocvien = hocvien::where('id_lop','=',$idlop)->get();
        $lop = lop::find($idlop);
        $loptruong = hocvien::where('id_lop','=',$idlop)->where('id_chucvu','=',2)->first();
        $nganh = nganh::find($lop -> id_nganh);
        return view('hocvien.quanly.danhsachhv',['hocvien' => $hocvien,'lop' => $lop,'nganh' => $nganh,
            'loptruong' => $loptruong]);
    }

    public function export_excel($idlop){
        //dd($idlop);
        $exporter = app()->makeWith(ExportController::class, compact('idlop'));
        return $exporter->download('hocvien.xlsx');
    }

    public function import_excel(Request $request,$idlop){
        $this -> validate($request, [
           'import_file' => 'required|mimes:xls,xlsx'
        ],[
            'import_file.required' => 'Ô nhập file không được trống',
            'import_file.mimes' => 'Phải là định dạng xls hoặc xlsx'
        ]);
        if ($request -> hasFile('import_file')){
        $exporter = app()->makeWith(ImportController::class, compact('idlop'));
//            dd($exporter);
         $exporter->import($request->file('import_file'));
        }
        return redirect('hocvien/loptruong/danhsach/'.$idlop)->with('thongbao','Cập nhật thành công');
    }

    public function getxoa($id){
        $xoahv = hocvien::find($id);
        $xoahv-> delete();
        return redirect('hocvien/loptruong/danhsach/'.$xoahv -> id_lop) -> with('thongbao','Đã xóa thành công');
    }

    public function getdiemdanh($idhoatdong){
        $hoatdong = hoatdong_hk_lop::where('id_hoatdong','=',$idhoatdong)->first();
        $hocvien = hocvien::where('id_lop','=',$hoatdong -> id_lop)->get();
        return view('hocvien.quanly.diemdanh',['hoatdong'=>$hoatdong,'hocvien'=>$hocvien]);
    }

    public function postdiemdanh(Request $request,$idhoatdong){
        $data = $request -> get('id_hocvien');

//        dd($request->all());
        foreach($data as $key=>$hoatdong) {

            foreach($hoatdong as $hd){
                $scores = new phieu_dd();
                $scores->id_hocvien  = $hd;
                $scores->id_hoatdong = $key;
                $scores->save();

            }
        }
        return redirect('hocvien/loptruong/xemdiemdanh/'.$idhoatdong)->with('thongbao','Điểm danh thành công');
    }

    public function getxemdiemdanh($idhoatdong){
        $hoatdong = phieu_dd::where('id_hoatdong','=',$idhoatdong)->first();
        $hocvien = phieu_dd::where('id_hoatdong','=',$idhoatdong)->get();
        $namhoc = hoatdong_hk_lop::where('id_hoatdong','=',$idhoatdong)->first();
        $hd = hoatdong::find($idhoatdong);
        $thanhtich = thanhtich::where('id_hoatdong','=',$idhoatdong)->count();
        $xem = thanhtich::where('id_hoatdong','=',$idhoatdong)->get();
        return view('hocvien.quanly.xemdiemdanh',['hoatdong'=>$hoatdong,'hocvien'=>$hocvien,'namhoc'=>$namhoc,
            'hd'=>$hd,'thanhtich'=>$thanhtich,'xem'=>$xem]);
    }

    public function getsuadiemdanh($idhoatdong){
        $xoa = phieu_dd::where('id_hoatdong','=',$idhoatdong)->delete();
        $hoatdong = hoatdong_hk_lop::where('id_hoatdong','=',$idhoatdong)->first();
        $hocvien = hocvien::where('id_lop','=',$hoatdong -> id_lop)->get();
        return view('hocvien.quanly.diemdanh',['hoatdong'=>$hoatdong,'hocvien'=>$hocvien]);
    }

    public function getbangdiemlan1($idlop) {
        $hocvien = hocvien::where('id_lop','=',$idlop)->where('id_chucvu','=',2)->first();
        $lop = lop::find($idlop);
        $chucvu_hk = chucnang_hk::find($hocvien->chucvu->id_chucnang_hk);
        $hocvien_l = bangdiem::where('id_hocky','=',$chucvu_hk -> hocky -> id)->get();
        $hocvien_lop = bangdiem::select('id_hocvien')->where('id_hocky','=',$chucvu_hk -> hocky -> id)->get();
        $hocvien_ktc = hocvien::whereNotIn('id',$hocvien_lop)->get();
        return view('hocvien.quanly.bangdiemlan1',['lop'=>$lop,'chucvu_hk'=>$chucvu_hk,'hocvien'=>$hocvien,
            'hocvien_l'=>$hocvien_l,'hocvien_ktc'=>$hocvien_ktc]);
    }

    public function getduyetlan1($idlop,$idbangdiem){
        $lop = lop::find($idlop);
        $bangdiem = bangdiem::find($idbangdiem);
        $tong1 = bangdiem_chitiet::where('id_bangdiem','=',$bangdiem -> id)
            ->sum(DB::raw('IFNULL(p1_a_1,0) + IFNULL(p1_a_2,0) + IFNULL(p1_a_3,0) + IFNULL(p1_a_4,0) 
            + IFNULL(chungchi_a,0) + IFNULL(chungchi_b,0)
            + IFNULL(chungchi_c,0) + IFNULL(toeic,0)'));
        if ($tong1 > 30){
            $tong1 = 30;
        }
        $tong2 = bangdiem_chitiet::where('id_bangdiem','=',$bangdiem -> id)
            ->sum(DB::raw('IFNULL(p2_1,0) + IFNULL(p2_2_1,0) + IFNULL(p2_2_2,0)'));
        if ($tong2 > 25){
            $tong2 = 25;
        }
        $tong3 = bangdiem_chitiet::where('id_bangdiem','=',$bangdiem -> id)
            ->sum(DB::raw('IFNULL(p3_1,0) + IFNULL(p3_2_1,0) + IFNULL(p3_2_2,0) + IFNULL(p3_3_1,0)
            + IFNULL(p3_3_2,0) + IFNULL(p3_3_3,0)'));
        if ($tong3 > 20){
            $tong3 = 20;
        }
        $tong4 = bangdiem_chitiet::where('id_bangdiem','=',$bangdiem -> id)
            ->sum(DB::raw('IFNULL(p4_1,0) + IFNULL(p4_2,0) + IFNULL(p4_3,0)'));
        if ($tong4 > 15){
            $tong4 = 15;
        }
        $tong5 = bangdiem_chitiet::where('id_bangdiem','=',$bangdiem -> id)
            ->sum(DB::raw('IFNULL(p5_1,0) + IFNULL(p5_2,0) + IFNULL(p5_3,0)'));
        if ($tong5 > 10){
            $tong5 = 10;
        }
        return view('hocvien.quanly.duyet_lan1',['bangdiem'=>$bangdiem,'tong1'=>$tong1,'tong2'=>$tong2,
            'tong3'=>$tong3,'tong4'=>$tong4,'tong5'=>$tong5,'lop'=>$lop]);
    }

    public function getthongke($idlop) {
        $namhoc = lop_nh::where('id_lop','=',$idlop)->get();
        $hocvien = hocvien::where('id_lop','=',$idlop)->where('id_chucvu','=',2)->first();
        return view('hocvien.quanly.thongke',[]);
    }

    public function getthemthanhtich($idhoatdong){
        $namhoc = hoatdong_hk_lop::where('id_hoatdong','=',$idhoatdong)->first();
        $hd = hoatdong::find($idhoatdong);
        $hocvien = phieu_dd::where('id_hoatdong','=',$idhoatdong)->get();
        return view('hocvien.quanly.thanhtich',['hd'=>$hd,'namhoc'=>$namhoc,'hocvien'=>$hocvien]);
    }

    public function postthemthanhtich(Request $request,$idhoatdong)
    {
        $test = ['hocvien' => $request -> get('hocvien'), 'thanhtich' => $request -> get('thanhtich')];
//        var_dump($test);
//        dd($request->all());
        $test1 = [];
        for ($i =0;$i < count($test['hocvien']); $i++){
            $test1[] = [
              'id_hoatdong' => $idhoatdong,
                'id_hocvien' => $test['hocvien'][$i],
                'hang' => $test['thanhtich'][$i]
            ];
        }
        DB::table('thanhtich')->insert($test1);
        return redirect('hocvien/loptruong/xemdiemdanh/'.$idhoatdong)->with('thongbao','Đã thêm thành tích');
    }

    public function postduyetlan1(Request $request,$idlop,$idbangdiem){
//        dd($request);
        $hocvien = bangdiem::find($idbangdiem);
        $bangdiem = new bangdiem_lan1;
        $p1 = $request -> result1;
        $p2 = $request -> result2;
        $p3 = $request -> result3;
        $p4 = $request -> result4;
        $p5 = $request -> result5;
        $diemtong = $p1 + $p2 + $p3 + $p4 + $p5;
        $bangdiem -> diemtong = $diemtong;
        if ($diemtong >= 0 && $diemtong <= 30){
            $bangdiem -> xeploai = "Yếu";
        }
        elseif ($diemtong > 30 && $diemtong <= 50){
            $bangdiem -> xeploai = "Trung bình";
        }
        elseif ($diemtong > 50 && $diemtong <= 60){
            $bangdiem -> xeploai = "Trung bình - Khá";
        }
        elseif ($diemtong > 60 && $diemtong <= 70){
            $bangdiem -> xeploai = "Khá";
        }
        elseif ($diemtong > 70 && $diemtong <= 80){
            $bangdiem -> xeploai = "Khá - Giỏi";
        }
        elseif ($diemtong > 80 && $diemtong <= 90){
            $bangdiem -> xeploai = "Giỏi";
        }
        elseif ($diemtong > 90 && $diemtong <= 100){
            $bangdiem -> xeploai = "Xuất sắc";
        }
        $bangdiem -> id_hocky = $request -> hocky;
        $bangdiem -> id_hocvien = $hocvien -> hocvien -> id;
        $bangdiem -> save();

        $id_bangdiem = bangdiem_lan1::where('id_hocvien','=',$hocvien -> hocvien -> id)->where('id_hocky','=',$request -> hocky)->first();
        $bangdiem_chitiet = new bangdiem_chitiet_lan1;
        $bangdiem_chitiet -> p1_a_1 = $request -> p1_a_1;
        $bangdiem_chitiet -> p1_a_2 = $request -> p1_a_2;
        $bangdiem_chitiet -> p1_a_3 = $request -> p1_a_3;
        $bangdiem_chitiet -> p1_a_4 = $request -> p1_a_4;
        $bangdiem_chitiet -> chungchi_a = $request -> chungchi_a;
        $bangdiem_chitiet -> chungchi_b = $request -> chungchi_b;
        $bangdiem_chitiet -> chungchi_c = $request -> chungchi_c;
        $bangdiem_chitiet -> toeic = $request -> toeic;
        $bangdiem_chitiet -> p2_1 = $request -> p2_1;
        $bangdiem_chitiet -> p2_2_1 = $request -> p2_2_1;
        $bangdiem_chitiet -> p2_2_2 = $request -> p2_2_2;
        $bangdiem_chitiet -> p3_1 = $request -> p3_1;
        $bangdiem_chitiet -> p3_2_1 = $request -> p3_2_1;
        $bangdiem_chitiet -> p3_2_2 = $request -> p3_2_2;
        $bangdiem_chitiet -> p3_3_1 = $request -> p3_3_1;
        $bangdiem_chitiet -> p3_3_2 = $request -> p3_3_2;
        $bangdiem_chitiet -> p3_3_3 = $request -> p3_3_3;
        $bangdiem_chitiet -> p4_1 = $request -> p4_1;
        $bangdiem_chitiet -> p4_2 = $request -> p4_2;
        $bangdiem_chitiet -> p4_3 = $request -> p4_3;
        $bangdiem_chitiet -> p5_1 = $request -> p5_1;
        $bangdiem_chitiet -> p5_2 = $request -> p5_2;
        $bangdiem_chitiet -> p5_3 = $request -> p5_3;
        $bangdiem_chitiet -> id_bangdiem = $id_bangdiem -> id;
        $bangdiem_chitiet -> save();
        return redirect('hocvien/loptruong/bangdiemlan1/'.$idlop)->with('thongbao','Đã thêm bảng điểm lần 1');
    }
    public function xemchitiet_lan1($idlop,$idbangdiem){
        $lop = lop::find($idlop);
        $bangdiem = bangdiem::find($idbangdiem);
        $bangdiem_lan1 = bangdiem_lan1::where('id_hocvien','=',$bangdiem -> id_hocvien)->where('id_hocky','=',$bangdiem->id_hocky)
        ->first();
        $bangdiem_chitiet_lan1 = bangdiem_chitiet_lan1::where('id_bangdiem','=',$bangdiem_lan1 -> id)->first();
        $bangdiem_chitiet = bangdiem_chitiet::where('id_bangdiem','=',$bangdiem -> id)->first();
        $tong1 = bangdiem_chitiet::where('id_bangdiem','=',$bangdiem -> id)
            ->sum(DB::raw('IFNULL(p1_a_1,0) + IFNULL(p1_a_2,0) + IFNULL(p1_a_3,0) + IFNULL(p1_a_4,0) 
            + IFNULL(chungchi_a,0) + IFNULL(chungchi_b,0)
            + IFNULL(chungchi_c,0) + IFNULL(toeic,0)'));
        if ($tong1> 30){
            $tong1= 30;
        }
        $tong2 = bangdiem_chitiet::where('id_bangdiem','=',$bangdiem -> id)
            ->sum(DB::raw('IFNULL(p2_1,0) + IFNULL(p2_2_1,0) + IFNULL(p2_2_2,0)'));
        if ($tong2 > 25){
            $tong2 = 25;
        }
        $tong3 = bangdiem_chitiet::where('id_bangdiem','=',$bangdiem -> id)
            ->sum(DB::raw('IFNULL(p3_1,0) + IFNULL(p3_2_1,0) + IFNULL(p3_2_2,0) + IFNULL(p3_3_1,0)
            + IFNULL(p3_3_2,0) + IFNULL(p3_3_3,0)'));
        if ($tong3 > 20){
            $tong3 = 20;
        }
        $tong4 = bangdiem_chitiet::where('id_bangdiem','=',$bangdiem -> id)
            ->sum(DB::raw('IFNULL(p4_1,0) + IFNULL(p4_2,0) + IFNULL(p4_3,0)'));
        if ($tong4 > 15){
            $tong4 = 15;
        }
        $tong5 = bangdiem_chitiet::where('id_bangdiem','=',$bangdiem -> id)
            ->sum(DB::raw('IFNULL(p5_1,0) + IFNULL(p5_2,0) + IFNULL(p5_3,0)'));
        if ($tong5 > 10){
            $tong5 = 10;
        }

        /////////////////////////////////////////////////////////////////////////

        $tong1_lan1 = bangdiem_chitiet_lan1::where('id_bangdiem','=',$bangdiem_lan1 -> id)
            ->sum(DB::raw('IFNULL(p1_a_1,0) + IFNULL(p1_a_2,0) + IFNULL(p1_a_3,0) + IFNULL(p1_a_4,0) 
            + IFNULL(chungchi_a,0) + IFNULL(chungchi_b,0)
            + IFNULL(chungchi_c,0) + IFNULL(toeic,0)'));
        if ($tong1_lan1 > 30){
            $tong1_lan1 = 30;
        }
        $tong2_lan1 = bangdiem_chitiet_lan1::where('id_bangdiem','=',$bangdiem_lan1 -> id)
            ->sum(DB::raw('IFNULL(p2_1,0) + IFNULL(p2_2_1,0) + IFNULL(p2_2_2,0)'));
        if ($tong2_lan1 > 25){
            $tong2_lan1 = 25;
        }
        $tong3_lan1 = bangdiem_chitiet_lan1::where('id_bangdiem','=',$bangdiem_lan1 -> id)
            ->sum(DB::raw('IFNULL(p3_1,0) + IFNULL(p3_2_1,0) + IFNULL(p3_2_2,0) + IFNULL(p3_3_1,0)
            + IFNULL(p3_3_2,0) + IFNULL(p3_3_3,0)'));
        if ($tong3_lan1 > 20){
            $tong3_lan1 = 20;
        }
        $tong4_lan1 = bangdiem_chitiet_lan1::where('id_bangdiem','=',$bangdiem_lan1 -> id)
            ->sum(DB::raw('IFNULL(p4_1,0) + IFNULL(p4_2,0) + IFNULL(p4_3,0)'));
        if ($tong4_lan1 > 15){
            $tong4_lan1 = 15;
        }
        $tong5_lan1 = bangdiem_chitiet_lan1::where('id_bangdiem','=',$bangdiem_lan1 -> id)
            ->sum(DB::raw('IFNULL(p5_1,0) + IFNULL(p5_2,0) + IFNULL(p5_3,0)'));
        if ($tong5_lan1 > 10){
            $tong5_lan1 = 10;
        }
        return view('hocvien.quanly.xemchitiet_lan1',['bangdiem'=>$bangdiem,'tong1'=>$tong1,'tong2'=>$tong2,
            'tong3'=>$tong3,'tong4'=>$tong4,'tong5'=>$tong5,'lop'=>$lop,
            'bangdiem_lan1'=>$bangdiem_lan1,'tong1_lan1'=>$tong1_lan1,'tong2_lan1'=>$tong2_lan1,
            'tong3_lan1'=>$tong3_lan1,'tong4_lan1'=>$tong4_lan1,'tong5_lan1'=>$tong5_lan1,
            'bangdiem_chitiet_lan1'=>$bangdiem_chitiet_lan1,
            'bangdiem_chitiet'=>$bangdiem_chitiet]);
    }
    public function suaduyetlan1($idlop,$idbangdiem){
        $lop = lop::find($idlop);
        $bangdiem = bangdiem::find($idbangdiem);
        $xoa = bangdiem_lan1::where('id_hocvien','=',$bangdiem -> id_hocvien)->where('id_hocky','=',$bangdiem -> id_hocky)
            ->delete();
        $tong1 = bangdiem_chitiet::where('id_bangdiem','=',$bangdiem -> id)
            ->sum(DB::raw('IFNULL(p1_a_1,0) + IFNULL(p1_a_2,0) + IFNULL(p1_a_3,0) + IFNULL(p1_a_4,0) 
            + IFNULL(chungchi_a,0) + IFNULL(chungchi_b,0)
            + IFNULL(chungchi_c,0) + IFNULL(toeic,0)'));
        if ($tong1 > 30){
            $tong1 = 30;
        }
        $tong2 = bangdiem_chitiet::where('id_bangdiem','=',$bangdiem -> id)
            ->sum(DB::raw('IFNULL(p2_1,0) + IFNULL(p2_2_1,0) + IFNULL(p2_2_2,0)'));
        if ($tong2 > 25){
            $tong2 = 25;
        }
        $tong3 = bangdiem_chitiet::where('id_bangdiem','=',$bangdiem -> id)
            ->sum(DB::raw('IFNULL(p3_1,0) + IFNULL(p3_2_1,0) + IFNULL(p3_2_2,0) + IFNULL(p3_3_1,0)
            + IFNULL(p3_3_2,0) + IFNULL(p3_3_3,0)'));
        if ($tong3 > 20){
            $tong3 = 20;
        }
        $tong4 = bangdiem_chitiet::where('id_bangdiem','=',$bangdiem -> id)
            ->sum(DB::raw('IFNULL(p4_1,0) + IFNULL(p4_2,0) + IFNULL(p4_3,0)'));
        if ($tong4 > 15){
            $tong4 = 15;
        }
        $tong5 = bangdiem_chitiet::where('id_bangdiem','=',$bangdiem -> id)
            ->sum(DB::raw('IFNULL(p5_1,0) + IFNULL(p5_2,0) + IFNULL(p5_3,0)'));
        if ($tong5 > 10){
            $tong5 = 10;
        }
        return view('hocvien.quanly.suaduyet_lan1',['bangdiem'=>$bangdiem,'tong1'=>$tong1,'tong2'=>$tong2,
            'tong3'=>$tong3,'tong4'=>$tong4,'tong5'=>$tong5,'lop'=>$lop]);
    }

    public function postsuaduyetlan1(Request $request,$idlop,$idbangdiem){
        $hocvien = bangdiem::find($idbangdiem);
        $bangdiem = new bangdiem_lan1;
        $p1 = $request -> result1;
        $p2 = $request -> result2;
        $p3 = $request -> result3;
        $p4 = $request -> result4;
        $p5 = $request -> result5;
        $diemtong = $p1 + $p2 + $p3 + $p4 + $p5;
        $bangdiem -> diemtong = $diemtong;
        if ($diemtong >= 0 && $diemtong <= 30){
            $bangdiem -> xeploai = "Yếu";
        }
        elseif ($diemtong > 30 && $diemtong <= 50){
            $bangdiem -> xeploai = "Trung bình";
        }
        elseif ($diemtong > 50 && $diemtong <= 60){
            $bangdiem -> xeploai = "Trung bình - Khá";
        }
        elseif ($diemtong > 60 && $diemtong <= 70){
            $bangdiem -> xeploai = "Khá";
        }
        elseif ($diemtong > 70 && $diemtong <= 80){
            $bangdiem -> xeploai = "Khá - Giỏi";
        }
        elseif ($diemtong > 80 && $diemtong <= 90){
            $bangdiem -> xeploai = "Giỏi";
        }
        elseif ($diemtong > 90 && $diemtong <= 100){
            $bangdiem -> xeploai = "Xuất sắc";
        }
        $bangdiem -> id_hocky = $request -> hocky;
        $bangdiem -> id_hocvien = $hocvien -> hocvien -> id;
        $bangdiem -> save();

        $id_bangdiem = bangdiem_lan1::where('id_hocvien','=',$hocvien -> hocvien -> id)->where('id_hocky','=',$request -> hocky)->first();
        $bangdiem_chitiet = new bangdiem_chitiet_lan1;
        $bangdiem_chitiet -> p1_a_1 = $request -> p1_a_1;
        $bangdiem_chitiet -> p1_a_2 = $request -> p1_a_2;
        $bangdiem_chitiet -> p1_a_3 = $request -> p1_a_3;
        $bangdiem_chitiet -> p1_a_4 = $request -> p1_a_4;
        $bangdiem_chitiet -> chungchi_a = $request -> chungchi_a;
        $bangdiem_chitiet -> chungchi_b = $request -> chungchi_b;
        $bangdiem_chitiet -> chungchi_c = $request -> chungchi_c;
        $bangdiem_chitiet -> toeic = $request -> toeic;
        $bangdiem_chitiet -> p2_1 = $request -> p2_1;
        $bangdiem_chitiet -> p2_2_1 = $request -> p2_2_1;
        $bangdiem_chitiet -> p2_2_2 = $request -> p2_2_2;
        $bangdiem_chitiet -> p3_1 = $request -> p3_1;
        $bangdiem_chitiet -> p3_2_1 = $request -> p3_2_1;
        $bangdiem_chitiet -> p3_2_2 = $request -> p3_2_2;
        $bangdiem_chitiet -> p3_3_1 = $request -> p3_3_1;
        $bangdiem_chitiet -> p3_3_2 = $request -> p3_3_2;
        $bangdiem_chitiet -> p3_3_3 = $request -> p3_3_3;
        $bangdiem_chitiet -> p4_1 = $request -> p4_1;
        $bangdiem_chitiet -> p4_2 = $request -> p4_2;
        $bangdiem_chitiet -> p4_3 = $request -> p4_3;
        $bangdiem_chitiet -> p5_1 = $request -> p5_1;
        $bangdiem_chitiet -> p5_2 = $request -> p5_2;
        $bangdiem_chitiet -> p5_3 = $request -> p5_3;
        $bangdiem_chitiet -> id_bangdiem = $id_bangdiem -> id;
        $bangdiem_chitiet -> save();
        return redirect('hocvien/loptruong/bangdiemlan1/'.$idlop)->with('thongbao','Đã thêm bảng điểm lần 1');
    }

    public function duyetnhanh($idlop,$idbangdiem){
        $bangdiem = bangdiem::find($idbangdiem);
        $bangdiem_chitiet = bangdiem_chitiet::where('id_bangdiem','=',$bangdiem -> id)->first();
        DB::table('bangdiem_lan1')->insert(['diemtong'=>$bangdiem -> diemtong,'xeploai'=>$bangdiem -> xeploai,
            'id_hocky'=>$bangdiem -> id_hocky,'id_hocvien'=>$bangdiem -> id_hocvien]);
        $idbangdiem = bangdiem_lan1::where('id_hocvien','=',$bangdiem -> id_hocvien)
            ->where('id_hocky','=',$bangdiem -> id_hocky)->first();
        DB::table('bangdiem_chitiet_lan1')->insert([
            'p1_a_1' => $bangdiem_chitiet -> p1_a_1,
            'p1_a_2' => $bangdiem_chitiet -> p1_a_2,
            'p1_a_3' => $bangdiem_chitiet -> p1_a_3,
            'p1_a_4' => $bangdiem_chitiet -> p1_a_4,
            'chungchi_a' => $bangdiem_chitiet -> chungchi_a,
            'chungchi_b' => $bangdiem_chitiet -> chungchi_b,
            'chungchi_c' => $bangdiem_chitiet -> chungchi_c,
            'toeic' => $bangdiem_chitiet -> toeic,
            'p2_1' => $bangdiem_chitiet -> p2_1,
            'p2_2_1' => $bangdiem_chitiet -> p2_2_1,
            'p2_2_2' => $bangdiem_chitiet -> p2_2_2,
            'p3_1' => $bangdiem_chitiet -> p3_1,
            'p3_2_1' => $bangdiem_chitiet -> p3_2_1,
            'p3_2_2' => $bangdiem_chitiet -> p3_2_2,
            'p3_3_1' => $bangdiem_chitiet -> p3_3_1,
            'p3_3_2' => $bangdiem_chitiet -> p3_3_2,
            'p3_3_3' => $bangdiem_chitiet -> p3_3_3,
            'p4_1' => $bangdiem_chitiet -> p4_1,
            'p4_2' => $bangdiem_chitiet -> p4_2,
            'p4_3' => $bangdiem_chitiet -> p4_3,
            'p5_1' => $bangdiem_chitiet -> p5_1,
            'p5_2' => $bangdiem_chitiet -> p5_2,
            'p5_3' => $bangdiem_chitiet -> p5_3,
            'id_bangdiem' => $idbangdiem -> id
        ]);
        return redirect('hocvien/loptruong/bangdiemlan1/'.$idlop)->with('thongbao','Đã duyệt nhanh lần 1');
    }

    public function getchamlan1($idhocvien){
        $hocvien = hocvien::find($idhocvien);
        $chucvu_hk = chucnang_hk::where('id_chucnang','=',3)->first();
//        if ($chucvu_hk == null){
//            $phieu_dd = 0;
//            $hoatdong = 0;
//            $sum1 = 0;
//            $hoatdong_tt = 0;
//            $diem_tt = 0;
//            $test = 0;
//        }
//        else{
        $phieu_dd = phieu_dd::where('id_hocvien','=',$idhocvien)->get();
        $thanhtich = thanhtich::where('id_hocvien','=',$idhocvien)->get();
        if (count($phieu_dd) > 0) {
            foreach ($phieu_dd as $pd) {
                $hoatdong[] = hoatdong_hk_lop::where('id_hoatdong', '=', $pd->id_hoatdong)
                    ->where('id_hocky', '=', $chucvu_hk->id_hocky)->where('id_lop', '=', $hocvien->id_lop)->get();
            }
            $sum = 0;
            foreach ($hoatdong as $key => $hd) {
                foreach ($hd as $hd1) {
                    $sum += $hd1->hoatdong->diem;
                }
            }
            if ($sum > 12) {
                $sum1 = 12;
            } else {
                $sum1 = $sum;
            }
        }
        else{
            $sum1 = 0;
            $hoatdong = 0;
        }
        if (count(thanhtich::where('id_hocvien','=',$hocvien -> id)->get()) > 0){
            $test = thanhtich::where('id_hocvien','=',$hocvien -> id)->get();
        }
        else{
            $test = 0;
        }
        if (count($thanhtich)>0){
        foreach ($thanhtich as $tt){
            $hoatdong_tt[] = hoatdong_hk_lop::where('id_hoatdong','=',$tt -> id_hoatdong)
                ->where('id_hocky','=',$chucvu_hk -> id_hocky)->where('id_lop','=',$hocvien -> id_lop)->get();
        }
        foreach ($hoatdong_tt as $key => $hd){
            foreach ($hd as $hd1){
                $tt_check = thanhtich::where('id_hoatdong','=',$hd1 -> hoatdong -> id)
                    ->where('id_hocvien','=',$idhocvien)->count();
            }
        }
//        dd($tt -> hang);
//        dd($sum);
//        dd($hoatdong);
//        dd($hoatdong_tt);
        if ($tt_check > 0){
            $diem_tt = 6;
        }
        else {
            $diem_tt = 0;
        }
        }
        else{
            $diem_tt = 0;
            $hoatdong_tt = 0;
        }
//        }
        return view('hocvien.quanly.cham_lan1',['hocvien'=>$hocvien,'chucvu_hk'=>$chucvu_hk,'phieu_dd'=>$phieu_dd,
            'hoatdong'=>$hoatdong,'sum'=>$sum1,'hoatdong_tt'=>$hoatdong_tt,'diem_tt'=>$diem_tt,'test'=>$test]);

    }
    public function postchamlan1(Request $request,$idhocvien){
        $hocvien = hocvien::find($idhocvien);
        $bangdiem = new bangdiem_lan1;
        $p1 = $request -> result1;
        $p2 = $request -> result2;
        $p3 = $request -> result3;
        $p4 = $request -> result4;
        $p5 = $request -> result5;
        $diemtong = $p1 + $p2 + $p3 + $p4 + $p5;
        $bangdiem -> diemtong = $diemtong;
        if ($diemtong >= 0 && $diemtong <= 30){
            $bangdiem -> xeploai = "Yếu";
        }
        elseif ($diemtong > 30 && $diemtong <= 50){
            $bangdiem -> xeploai = "Trung bình";
        }
        elseif ($diemtong > 50 && $diemtong <= 60){
            $bangdiem -> xeploai = "Trung bình - Khá";
        }
        elseif ($diemtong > 60 && $diemtong <= 70){
            $bangdiem -> xeploai = "Khá";
        }
        elseif ($diemtong > 70 && $diemtong <= 80){
            $bangdiem -> xeploai = "Khá - Giỏi";
        }
        elseif ($diemtong > 80 && $diemtong <= 90){
            $bangdiem -> xeploai = "Giỏi";
        }
        elseif ($diemtong > 90 && $diemtong <= 100){
            $bangdiem -> xeploai = "Xuất sắc";
        }
        $bangdiem -> id_hocky = $request -> hocky;
        $bangdiem -> id_hocvien = $idhocvien;
        $bangdiem -> save();

        $id_bangdiem = bangdiem_lan1::where('id_hocvien','=',$idhocvien)->where('id_hocky','=',$request -> hocky)->first();
        $bangdiem_chitiet = new bangdiem_chitiet_lan1;
        $bangdiem_chitiet -> p1_a_1 = $request -> p1_a_1;
        $bangdiem_chitiet -> p1_a_2 = $request -> p1_a_2;
        $bangdiem_chitiet -> p1_a_3 = $request -> p1_a_3;
        $bangdiem_chitiet -> p1_a_4 = $request -> p1_a_4;
        $bangdiem_chitiet -> chungchi_a = $request -> chungchi_a;
        $bangdiem_chitiet -> chungchi_b = $request -> chungchi_b;
        $bangdiem_chitiet -> chungchi_c = $request -> chungchi_c;
        $bangdiem_chitiet -> toeic = $request -> toeic;
        $bangdiem_chitiet -> p2_1 = $request -> p2_1;
        $bangdiem_chitiet -> p2_2_1 = $request -> p2_2_1;
        $bangdiem_chitiet -> p2_2_2 = $request -> p2_2_2;
        $bangdiem_chitiet -> p3_1 = $request -> p3_1;
        $bangdiem_chitiet -> p3_2_1 = $request -> p3_2_1;
        $bangdiem_chitiet -> p3_2_2 = $request -> p3_2_2;
        $bangdiem_chitiet -> p3_3_1 = $request -> p3_3_1;
        $bangdiem_chitiet -> p3_3_2 = $request -> p3_3_2;
        $bangdiem_chitiet -> p3_3_3 = $request -> p3_3_3;
        $bangdiem_chitiet -> p4_1 = $request -> p4_1;
        $bangdiem_chitiet -> p4_2 = $request -> p4_2;
        $bangdiem_chitiet -> p4_3 = $request -> p4_3;
        $bangdiem_chitiet -> p5_1 = $request -> p5_1;
        $bangdiem_chitiet -> p5_2 = $request -> p5_2;
        $bangdiem_chitiet -> p5_3 = $request -> p5_3;
        $bangdiem_chitiet -> id_bangdiem = $id_bangdiem -> id;
        $bangdiem_chitiet -> save();
        return redirect('hocvien/loptruong/bangdiemlan1/'.$hocvien -> lop -> id)->with('thongbao','Đã thêm bảng điểm lần 1');
    }

    public function xemchamlan1($idhocvien){
        $hocvien = hocvien::find($idhocvien);
        $chucvu_hk = chucnang_hk::where('id_chucnang','=',3)->first();
        $bangdiem = bangdiem_lan1::where('id_hocvien','=',$hocvien->id)->where('id_hocky','=',
            $chucvu_hk->hocky->id)->first();
        $bangdiem_chitiet = bangdiem_chitiet_lan1::where('id_bangdiem','=',$bangdiem -> id)->first();

        $tong1 = bangdiem_chitiet_lan1::where('id_bangdiem','=',$bangdiem -> id)
            ->sum(DB::raw('IFNULL(p1_a_1,0) + IFNULL(p1_a_2,0) + IFNULL(p1_a_3,0) + IFNULL(p1_a_4,0) 
            + IFNULL(chungchi_a,0) + IFNULL(chungchi_b,0)
            + IFNULL(chungchi_c,0) + IFNULL(toeic,0)'));
        if ($tong1 > 30){
            $tong1 = 30;
        }
        $tong2 = bangdiem_chitiet_lan1::where('id_bangdiem','=',$bangdiem -> id)
            ->sum(DB::raw('IFNULL(p2_1,0) + IFNULL(p2_2_1,0) + IFNULL(p2_2_2,0)'));
        if ($tong2 > 25){
            $tong2 = 25;
        }
        $tong3 = bangdiem_chitiet_lan1::where('id_bangdiem','=',$bangdiem -> id)
            ->sum(DB::raw('IFNULL(p3_1,0) + IFNULL(p3_2_1,0) + IFNULL(p3_2_2,0) + IFNULL(p3_3_1,0)
            + IFNULL(p3_3_2,0) + IFNULL(p3_3_3,0)'));
        if ($tong3 > 20){
            $tong3 = 20;
        }
        $tong4 = bangdiem_chitiet_lan1::where('id_bangdiem','=',$bangdiem -> id)
            ->sum(DB::raw('IFNULL(p4_1,0) + IFNULL(p4_2,0) + IFNULL(p4_3,0)'));
        if ($tong4 > 15){
            $tong4 = 15;
        }
        $tong5 = bangdiem_chitiet_lan1::where('id_bangdiem','=',$bangdiem -> id)
            ->sum(DB::raw('IFNULL(p5_1,0) + IFNULL(p5_2,0) + IFNULL(p5_3,0)'));
        if ($tong5 > 10){
            $tong5 = 10;
        }
        return view('hocvien.quanly.xemcham_lan1',['hocvien'=>$hocvien,'chucvu_hk'=>$chucvu_hk,'tong1'=>$tong1,
            'tong2'=>$tong2,'tong3'=>$tong3,'tong4'=>$tong4,'tong5'=>$tong5,'bangdiem'=>$bangdiem,
            'bangdiem_chitiet'=>$bangdiem_chitiet]);
    }
    public function getsuachamlan1($idhocvien){
        $hocvien = hocvien::find($idhocvien);
        $chucvu_hk = chucnang_hk::where('id_chucnang','=',3)->first();
        $xoa = bangdiem_lan1::where('id_hocvien','=',$idhocvien)->where('id_hocky','=',$chucvu_hk -> hocky -> id)->delete();
//        dd($xoa);
        $phieu_dd = phieu_dd::where('id_hocvien','=',$idhocvien)->get();
        $thanhtich = thanhtich::where('id_hocvien','=',$idhocvien)->get();
        if (count($phieu_dd) > 0){
            foreach ($phieu_dd as $pd){
                $hoatdong[] = hoatdong_hk_lop::where('id_hoatdong','=',$pd -> id_hoatdong)
                    ->where('id_hocky','=',$chucvu_hk -> id_hocky)->where('id_lop','=',$hocvien -> id_lop)->get();
            }
            $sum = 0;
            foreach ($hoatdong as $key => $hd){
                foreach ($hd as $hd1){
                    $sum += $hd1 -> hoatdong -> diem;
                }
            }
            if ($sum > 12){
                $sum1 = 12;
            }
            else{
                $sum1 = $sum;
            }
        }
        else{
            $sum1 = 0;
            $hoatdong = 0;
        }
        if (count(thanhtich::where('id_hocvien','=',$hocvien -> id)->get()) > 0){
            $test = thanhtich::where('id_hocvien','=',$hocvien -> id)->get();
        }
        else{
            $test = 0;
        }
        if (count($thanhtich) > 0){
            foreach ($thanhtich as $tt){
                $hoatdong_tt[] = hoatdong_hk_lop::where('id_hoatdong','=',$tt -> id_hoatdong)
                    ->where('id_hocky','=',$chucvu_hk -> id_hocky)->where('id_lop','=',$hocvien -> id_lop)->get();
            }
            foreach ($hoatdong_tt as $key => $hd){
                foreach ($hd as $hd1){
                    $tt_check = thanhtich::where('id_hoatdong','=',$hd1 -> hoatdong -> id)
                        ->where('id_hocvien','=',$idhocvien)->count();
                }
            }
//        dd($tt -> hang);
//        dd($sum);
//        dd($hoatdong);
//        dd($hoatdong_tt);
            if ($tt_check > 0){
                $diem_tt = 6;
            }
            else {
                $diem_tt = 0;
            }
        }
        else{
            $diem_tt = 0;
            $hoatdong_tt = 0;
        }
        return view('hocvien.quanly.suacham_lan1',['hocvien'=>$hocvien,'chucvu_hk'=>$chucvu_hk,'phieu_dd'=>$phieu_dd,
            'hoatdong'=>$hoatdong,'sum'=>$sum1,'hoatdong_tt'=>$hoatdong_tt,'diem_tt'=>$diem_tt,'test'=>$test]);
    }

    public function postsuachamlan1(Request $request,$idhocvien){
        $hocvien = hocvien::find($idhocvien);
        $bangdiem = new bangdiem_lan1;
        $p1 = $request -> result1;
        $p2 = $request -> result2;
        $p3 = $request -> result3;
        $p4 = $request -> result4;
        $p5 = $request -> result5;
        $diemtong = $p1 + $p2 + $p3 + $p4 + $p5;
        $bangdiem -> diemtong = $diemtong;
        if ($diemtong >= 0 && $diemtong <= 30){
            $bangdiem -> xeploai = "Yếu";
        }
        elseif ($diemtong > 30 && $diemtong <= 50){
            $bangdiem -> xeploai = "Trung bình";
        }
        elseif ($diemtong > 50 && $diemtong <= 60){
            $bangdiem -> xeploai = "Trung bình - Khá";
        }
        elseif ($diemtong > 60 && $diemtong <= 70){
            $bangdiem -> xeploai = "Khá";
        }
        elseif ($diemtong > 70 && $diemtong <= 80){
            $bangdiem -> xeploai = "Khá - Giỏi";
        }
        elseif ($diemtong > 80 && $diemtong <= 90){
            $bangdiem -> xeploai = "Giỏi";
        }
        elseif ($diemtong > 90 && $diemtong <= 100){
            $bangdiem -> xeploai = "Xuất sắc";
        }
        $bangdiem -> id_hocky = $request -> hocky;
        $bangdiem -> id_hocvien = $idhocvien;
        $bangdiem -> save();

        $id_bangdiem = bangdiem_lan1::where('id_hocvien','=',$idhocvien)->where('id_hocky','=',$request -> hocky)->first();
        $bangdiem_chitiet = new bangdiem_chitiet_lan1;
        $bangdiem_chitiet -> p1_a_1 = $request -> p1_a_1;
        $bangdiem_chitiet -> p1_a_2 = $request -> p1_a_2;
        $bangdiem_chitiet -> p1_a_3 = $request -> p1_a_3;
        $bangdiem_chitiet -> p1_a_4 = $request -> p1_a_4;
        $bangdiem_chitiet -> chungchi_a = $request -> chungchi_a;
        $bangdiem_chitiet -> chungchi_b = $request -> chungchi_b;
        $bangdiem_chitiet -> chungchi_c = $request -> chungchi_c;
        $bangdiem_chitiet -> toeic = $request -> toeic;
        $bangdiem_chitiet -> p2_1 = $request -> p2_1;
        $bangdiem_chitiet -> p2_2_1 = $request -> p2_2_1;
        $bangdiem_chitiet -> p2_2_2 = $request -> p2_2_2;
        $bangdiem_chitiet -> p3_1 = $request -> p3_1;
        $bangdiem_chitiet -> p3_2_1 = $request -> p3_2_1;
        $bangdiem_chitiet -> p3_2_2 = $request -> p3_2_2;
        $bangdiem_chitiet -> p3_3_1 = $request -> p3_3_1;
        $bangdiem_chitiet -> p3_3_2 = $request -> p3_3_2;
        $bangdiem_chitiet -> p3_3_3 = $request -> p3_3_3;
        $bangdiem_chitiet -> p4_1 = $request -> p4_1;
        $bangdiem_chitiet -> p4_2 = $request -> p4_2;
        $bangdiem_chitiet -> p4_3 = $request -> p4_3;
        $bangdiem_chitiet -> p5_1 = $request -> p5_1;
        $bangdiem_chitiet -> p5_2 = $request -> p5_2;
        $bangdiem_chitiet -> p5_3 = $request -> p5_3;
        $bangdiem_chitiet -> id_bangdiem = $id_bangdiem -> id;
        $bangdiem_chitiet -> save();
        return redirect('hocvien/loptruong/bangdiemlan1/'.$hocvien -> lop -> id)->with('thongbao','Đã thêm bảng chấm lần 1');
    }

    public function getyeucau($idbangdiem){
        $bangdiem_lan1 = bangdiem_lan1::find($idbangdiem);
        $namhoc = hocky::find($bangdiem_lan1 -> id_hocky);
        $hocvien = hocvien::find($bangdiem_lan1 -> id_hocvien);
        $chucvu_hk = chucnang_hk::find($hocvien -> chucvu -> id_chucnang_hk);
        $bangdiem_chitiet_lan1 = bangdiem_chitiet_lan1::where('id_bangdiem','=',$bangdiem_lan1 -> id)->first();
        $tong1_lan1 = bangdiem_chitiet_lan1::where('id_bangdiem','=',$idbangdiem)
            ->sum(DB::raw('IFNULL(p1_a_1,0) + IFNULL(p1_a_2,0) + IFNULL(p1_a_3,0) + IFNULL(p1_a_4,0) 
            + IFNULL(chungchi_a,0) + IFNULL(chungchi_b,0)
            + IFNULL(chungchi_c,0) + IFNULL(toeic,0)'));
        if ($tong1_lan1 > 30){
            $tong1_lan1 = 30;
        }
        $tong2_lan1 = bangdiem_chitiet_lan1::where('id_bangdiem','=',$idbangdiem)
            ->sum(DB::raw('IFNULL(p2_1,0) + IFNULL(p2_2_1,0) + IFNULL(p2_2_2,0)'));
        if ($tong2_lan1 > 25){
            $tong2_lan1 = 25;
        }
        $tong3_lan1 = bangdiem_chitiet_lan1::where('id_bangdiem','=',$idbangdiem)
            ->sum(DB::raw('IFNULL(p3_1,0) + IFNULL(p3_2_1,0) + IFNULL(p3_2_2,0) + IFNULL(p3_3_1,0)
            + IFNULL(p3_3_2,0) + IFNULL(p3_3_3,0)'));
        if ($tong3_lan1 > 20){
            $tong3_lan1 = 20;
        }
        $tong4_lan1 = bangdiem_chitiet_lan1::where('id_bangdiem','=',$idbangdiem)
            ->sum(DB::raw('IFNULL(p4_1,0) + IFNULL(p4_2,0) + IFNULL(p4_3,0)'));
        if ($tong4_lan1 > 15){
            $tong4_lan1 = 15;
        }
        $tong5_lan1 = bangdiem_chitiet_lan1::where('id_bangdiem','=',$idbangdiem)
            ->sum(DB::raw('IFNULL(p5_1,0) + IFNULL(p5_2,0) + IFNULL(p5_3,0)'));
        if ($tong5_lan1 > 10){
            $tong5_lan1 = 10;
        }
        $phieu_dd = phieu_dd::where('id_hocvien','=',$hocvien -> id)->get();
        $thanhtich = thanhtich::where('id_hocvien','=',$hocvien -> id)->get();
        if (count($phieu_dd) > 0){
            foreach ($phieu_dd as $pd){
                $hoatdong[] = hoatdong_hk_lop::where('id_hoatdong','=',$pd -> id_hoatdong)
                    ->where('id_hocky','=',$chucvu_hk -> id_hocky)->where('id_lop','=',$hocvien -> id_lop)->get();
            }
            $sum = 0;
            foreach ($hoatdong as $key => $hd){
                foreach ($hd as $hd1){
                    $sum += $hd1 -> hoatdong -> diem;
                }
            }
            if ($sum > 12){
                $sum1 = 12;
            }
            else{
                $sum1 = $sum;
            }
        }
        else{
            $sum1 = 0;
            $hoatdong = 0;
        }
        if (count(thanhtich::where('id_hocvien','=',$hocvien -> id)->get()) > 0){
            $test = thanhtich::where('id_hocvien','=',$hocvien -> id)->get();
        }
        else{
            $test = 0;
        }
        if (count($thanhtich) > 0){
            foreach ($thanhtich as $tt){
                $hoatdong_tt[] = hoatdong_hk_lop::where('id_hoatdong','=',$tt -> id_hoatdong)
                    ->where('id_hocky','=',$chucvu_hk -> id_hocky)->where('id_lop','=',$hocvien -> id_lop)->get();
            }
            foreach ($hoatdong_tt as $key => $hd){
                foreach ($hd as $hd1){
                    $tt_check = thanhtich::where('id_hoatdong','=',$hd1 -> hoatdong -> id)
                        ->where('id_hocvien','=',$hocvien -> id)->count();
                }
            }
//        dd($test);
//        dd($sum);
//        dd($hoatdong);
//        dd($hoatdong_tt);
            if ($tt_check > 0){
                $diem_tt = 6;
            }
            else {
                $diem_tt = 0;
            }
        }
        else{
            $diem_tt = 0;
            $hoatdong_tt = 0;
        }
        return view('hocvien.bangdiem_yeucau',['bangdiem_lan1'=>$bangdiem_lan1,'namhoc'=>$namhoc,'hocvien'=>$hocvien,
            'tong1_lan1'=>$tong1_lan1,'tong2_lan1'=>$tong2_lan1,'tong3_lan1'=>$tong3_lan1,'tong4_lan1'=>$tong4_lan1,
            'tong5_lan1'=>$tong5_lan1,
            'bangdiem_chitiet_lan1'=>$bangdiem_chitiet_lan1,
            'chucvu_hk' => $chucvu_hk,'hoatdong'=>$hoatdong,'hoatdong_tt'=>$hoatdong_tt,'test'=>$test]);
    }

    public function postyeucau(Request $request,$idbangdiem){
//        dd($request);
        $id_bangdiem_lan1 = bangdiem_lan1::find($idbangdiem);
        $id_bangdiem = bangdiem::where('id_hocky','=',$id_bangdiem_lan1 -> id_hocky)
            ->where('id_hocvien','=',$id_bangdiem_lan1 -> id_hocvien)-> first();
        $bangdiem_yeucau = new bangdiem_yeucau;
        $bangdiem_yeucau  -> p1_a_1 = $request -> p1_a_1_cb;
        $bangdiem_yeucau  -> p1_a_2 = $request -> p1_a_2_cb;
        $bangdiem_yeucau  -> p1_a_3 = $request -> p1_a_3_cb;
        $bangdiem_yeucau  -> p1_a_4 = $request -> p1_a_4_cb;
        $bangdiem_yeucau  -> chungchi_a = $request -> chungchi_a_cb;
        $bangdiem_yeucau  -> chungchi_b = $request -> chungchi_b_cb;
        $bangdiem_yeucau  -> chungchi_c = $request -> chungchi_c_cb;
        $bangdiem_yeucau  -> toeic = $request -> toeic_cb;
        $bangdiem_yeucau  -> p2_1 = $request -> p2_1_cb;
        $bangdiem_yeucau  -> p2_2_1 = $request -> p2_2_1_cb;
        $bangdiem_yeucau  -> p2_2_2 = $request -> p2_2_2_cb;
        $bangdiem_yeucau  -> p3_1 = $request -> p3_1_cb;
        $bangdiem_yeucau  -> p3_2_1 = $request -> p3_2_1_cb;
        $bangdiem_yeucau  -> p3_2_2 = $request -> p3_2_2_cb;
        $bangdiem_yeucau  -> p3_3_1 = $request -> p3_3_1_cb;
        $bangdiem_yeucau  -> p3_3_2 = $request -> p3_3_2_cb;
        $bangdiem_yeucau  -> p3_3_3 = $request -> p3_3_3_cb;
        $bangdiem_yeucau  -> p4_1 = $request -> p4_1_cb;
        $bangdiem_yeucau  -> p4_2 = $request -> p4_2_cb;
        $bangdiem_yeucau  -> p4_3 = $request -> p4_3_cb;
        $bangdiem_yeucau  -> p5_1 = $request -> p5_1_cb;
        $bangdiem_yeucau  -> p5_2 = $request -> p5_2_cb;
        $bangdiem_yeucau  -> p5_3 = $request -> p5_3_cb;
        $bangdiem_yeucau -> id_bangdiem = $id_bangdiem -> id;
        $bangdiem_yeucau  -> id_bangdiem_lan1 = $id_bangdiem_lan1 -> id;
        $bangdiem_yeucau  -> save();

        $id_bangdiem_yeucau = bangdiem_yeucau::where('id_bangdiem','=',$id_bangdiem -> id)
            ->where('id_bangdiem_lan1','=',$id_bangdiem_lan1 -> id)->first();
        $lydo_yeucau = new lydo_yeucau;
        $lydo_yeucau   -> p1_a_1 = $request -> p1_a_1;
        $lydo_yeucau   -> p1_a_2 = $request -> p1_a_2;
        $lydo_yeucau   -> p1_a_3 = $request -> p1_a_3;
        $lydo_yeucau   -> p1_a_4 = $request -> p1_a_4;
        $lydo_yeucau   -> chungchi_a = $request -> chungchi_a;
        $lydo_yeucau   -> chungchi_b = $request -> chungchi_b;
        $lydo_yeucau   -> chungchi_c = $request -> chungchi_c;
        $lydo_yeucau   -> toeic = $request -> toeic;
        $lydo_yeucau   -> p2_1 = $request -> p2_1;
        $lydo_yeucau   -> p2_2_1 = $request -> p2_2_1;
        $lydo_yeucau   -> p2_2_2 = $request -> p2_2_2;
        $lydo_yeucau   -> p3_1 = $request -> p3_1;
        $lydo_yeucau   -> p3_2_1 = $request -> p3_2_1;
        $lydo_yeucau   -> p3_2_2 = $request -> p3_2_2;
        $lydo_yeucau   -> p3_3_1 = $request -> p3_3_1;
        $lydo_yeucau   -> p3_3_2 = $request -> p3_3_2;
        $lydo_yeucau   -> p3_3_3 = $request -> p3_3_3;
        $lydo_yeucau   -> p4_1 = $request -> p4_1;
        $lydo_yeucau   -> p4_2 = $request -> p4_2;
        $lydo_yeucau   -> p4_3 = $request -> p4_3;
        $lydo_yeucau   -> p5_1 = $request -> p5_1;
        $lydo_yeucau   -> p5_2 = $request -> p5_2;
        $lydo_yeucau   -> p5_3 = $request -> p5_3;
        $lydo_yeucau  -> id_bangdiem_yeucau = $id_bangdiem_yeucau -> id;
        $lydo_yeucau   -> save();

        return redirect('hocvien/bangdiem/xemyeucau/'.$id_bangdiem_lan1 -> id)->with('thongbao','Đã thêm yêu cầu thành công');
    }

    public function getxemyeucau($idbangdiem){
        $bangdiem_yeucau = bangdiem_yeucau::where('id_bangdiem_lan1','=',$idbangdiem)->first();
        $bangdiem_lan1 = bangdiem_lan1::find($bangdiem_yeucau -> id_bangdiem_lan1);
        $bangdiem_chitiet_lan1 = bangdiem_chitiet_lan1::where('id_bangdiem','=',$bangdiem_lan1 -> id)->first();
        $lydo_yeucau = lydo_yeucau::where('id_bangdiem_yeucau','=',$bangdiem_yeucau -> id)->first();
        return view('hocvien.xemyeucau',['bangdiem_yeucau'=>$bangdiem_yeucau,
            'bangdiem_lan1'=>$bangdiem_lan1,
            'bangdiem_chitiet_lan1'=>$bangdiem_chitiet_lan1,
            'lydo_yeucau'=>$lydo_yeucau]);
    }
    public function getsuayeucau($idbangdiem){
        $xoa = bangdiem_yeucau::where('id_bangdiem_lan1','=',$idbangdiem)->first()->delete();
        $bangdiem_lan1 = bangdiem_lan1::find($idbangdiem);
        $namhoc = hocky::find($bangdiem_lan1 -> id_hocky);
        $hocvien = hocvien::find($bangdiem_lan1 -> id_hocvien);
        $chucvu_hk = chucnang_hk::find($hocvien -> chucvu -> id_chucnang_hk);
        $bangdiem_chitiet_lan1 = bangdiem_chitiet_lan1::where('id_bangdiem','=',$bangdiem_lan1 -> id)->first();
        $tong1_lan1 = bangdiem_chitiet_lan1::where('id_bangdiem','=',$idbangdiem)
            ->sum(DB::raw('IFNULL(p1_a_1,0) + IFNULL(p1_a_2,0) + IFNULL(p1_a_3,0) + IFNULL(p1_a_4,0) 
            + IFNULL(chungchi_a,0) + IFNULL(chungchi_b,0)
            + IFNULL(chungchi_c,0) + IFNULL(toeic,0)'));
        if ($tong1_lan1 > 30){
            $tong1_lan1 = 30;
        }
        $tong2_lan1 = bangdiem_chitiet_lan1::where('id_bangdiem','=',$idbangdiem)
            ->sum(DB::raw('IFNULL(p2_1,0) + IFNULL(p2_2_1,0) + IFNULL(p2_2_2,0)'));
        if ($tong2_lan1 > 25){
            $tong2_lan1 = 25;
        }
        $tong3_lan1 = bangdiem_chitiet_lan1::where('id_bangdiem','=',$idbangdiem)
            ->sum(DB::raw('IFNULL(p3_1,0) + IFNULL(p3_2_1,0) + IFNULL(p3_2_2,0) + IFNULL(p3_3_1,0)
            + IFNULL(p3_3_2,0) + IFNULL(p3_3_3,0)'));
        if ($tong3_lan1 > 20){
            $tong3_lan1 = 20;
        }
        $tong4_lan1 = bangdiem_chitiet_lan1::where('id_bangdiem','=',$idbangdiem)
            ->sum(DB::raw('IFNULL(p4_1,0) + IFNULL(p4_2,0) + IFNULL(p4_3,0)'));
        if ($tong4_lan1 > 15){
            $tong4_lan1 = 15;
        }
        $tong5_lan1 = bangdiem_chitiet_lan1::where('id_bangdiem','=',$idbangdiem)
            ->sum(DB::raw('IFNULL(p5_1,0) + IFNULL(p5_2,0) + IFNULL(p5_3,0)'));
        if ($tong5_lan1 > 10){
            $tong5_lan1 = 10;
        }
        $phieu_dd = phieu_dd::where('id_hocvien','=',$hocvien -> id)->get();
        $thanhtich = thanhtich::where('id_hocvien','=',$hocvien -> id)->get();
        if (count($phieu_dd) > 0){
            foreach ($phieu_dd as $pd){
                $hoatdong[] = hoatdong_hk_lop::where('id_hoatdong','=',$pd -> id_hoatdong)
                    ->where('id_hocky','=',$chucvu_hk -> id_hocky)->where('id_lop','=',$hocvien -> id_lop)->get();
            }
            $sum = 0;
            foreach ($hoatdong as $key => $hd){
                foreach ($hd as $hd1){
                    $sum += $hd1 -> hoatdong -> diem;
                }
            }
            if ($sum > 12){
                $sum1 = 12;
            }
            else{
                $sum1 = $sum;
            }
        }
        else{
            $sum1 = 0;
            $hoatdong = 0;
        }
        if (count(thanhtich::where('id_hocvien','=',$hocvien -> id)->get()) > 0){
            $test = thanhtich::where('id_hocvien','=',$hocvien -> id)->get();
        }
        else{
            $test = 0;
        }
        if (count($thanhtich) > 0){
            foreach ($thanhtich as $tt){
                $hoatdong_tt[] = hoatdong_hk_lop::where('id_hoatdong','=',$tt -> id_hoatdong)
                    ->where('id_hocky','=',$chucvu_hk -> id_hocky)->where('id_lop','=',$hocvien -> id_lop)->get();
            }
            foreach ($hoatdong_tt as $key => $hd){
                foreach ($hd as $hd1){
                    $tt_check = thanhtich::where('id_hoatdong','=',$hd1 -> hoatdong -> id)
                        ->where('id_hocvien','=',$hocvien -> id)->count();
                }
            }
//        dd($test);
//        dd($sum);
//        dd($hoatdong);
//        dd($hoatdong_tt);
            if ($tt_check > 0){
                $diem_tt = 6;
            }
            else {
                $diem_tt = 0;
            }
        }
        else{
            $diem_tt = 0;
            $hoatdong_tt = 0;
        }
        return view('hocvien.suabang_yeucau',['bangdiem_lan1'=>$bangdiem_lan1,'namhoc'=>$namhoc,'hocvien'=>$hocvien,
            'tong1_lan1'=>$tong1_lan1,'tong2_lan1'=>$tong2_lan1,'tong3_lan1'=>$tong3_lan1,'tong4_lan1'=>$tong4_lan1,
            'tong5_lan1'=>$tong5_lan1,
            'bangdiem_chitiet_lan1'=>$bangdiem_chitiet_lan1,
            'chucvu_hk' => $chucvu_hk,'hoatdong'=>$hoatdong,'hoatdong_tt'=>$hoatdong_tt,'test'=>$test]);
    }

    public function postsuayeucau(Request $request,$idbangdiem){
//        dd($request);
        $id_bangdiem_lan1 = bangdiem_lan1::find($idbangdiem);
        $id_bangdiem = bangdiem::where('id_hocky','=',$id_bangdiem_lan1 -> id_hocky)
            ->where('id_hocvien','=',$id_bangdiem_lan1 -> id_hocvien)-> first();
        $bangdiem_yeucau = new bangdiem_yeucau;
        $bangdiem_yeucau  -> p1_a_1 = $request -> p1_a_1_cb;
        $bangdiem_yeucau  -> p1_a_2 = $request -> p1_a_2_cb;
        $bangdiem_yeucau  -> p1_a_3 = $request -> p1_a_3_cb;
        $bangdiem_yeucau  -> p1_a_4 = $request -> p1_a_4_cb;
        $bangdiem_yeucau  -> chungchi_a = $request -> chungchi_a_cb;
        $bangdiem_yeucau  -> chungchi_b = $request -> chungchi_b_cb;
        $bangdiem_yeucau  -> chungchi_c = $request -> chungchi_c_cb;
        $bangdiem_yeucau  -> toeic = $request -> toeic_cb;
        $bangdiem_yeucau  -> p2_1 = $request -> p2_1_cb;
        $bangdiem_yeucau  -> p2_2_1 = $request -> p2_2_1_cb;
        $bangdiem_yeucau  -> p2_2_2 = $request -> p2_2_2_cb;
        $bangdiem_yeucau  -> p3_1 = $request -> p3_1_cb;
        $bangdiem_yeucau  -> p3_2_1 = $request -> p3_2_1_cb;
        $bangdiem_yeucau  -> p3_2_2 = $request -> p3_2_2_cb;
        $bangdiem_yeucau  -> p3_3_1 = $request -> p3_3_1_cb;
        $bangdiem_yeucau  -> p3_3_2 = $request -> p3_3_2_cb;
        $bangdiem_yeucau  -> p3_3_3 = $request -> p3_3_3_cb;
        $bangdiem_yeucau  -> p4_1 = $request -> p4_1_cb;
        $bangdiem_yeucau  -> p4_2 = $request -> p4_2_cb;
        $bangdiem_yeucau  -> p4_3 = $request -> p4_3_cb;
        $bangdiem_yeucau  -> p5_1 = $request -> p5_1_cb;
        $bangdiem_yeucau  -> p5_2 = $request -> p5_2_cb;
        $bangdiem_yeucau  -> p5_3 = $request -> p5_3_cb;
        $bangdiem_yeucau -> id_bangdiem = $id_bangdiem -> id;
        $bangdiem_yeucau  -> id_bangdiem_lan1 = $id_bangdiem_lan1 -> id;
        $bangdiem_yeucau  -> save();

        $id_bangdiem_yeucau = bangdiem_yeucau::where('id_bangdiem','=',$id_bangdiem -> id)
            ->where('id_bangdiem_lan1','=',$id_bangdiem_lan1 -> id)->first();
        $lydo_yeucau = new lydo_yeucau;
        $lydo_yeucau   -> p1_a_1 = $request -> p1_a_1;
        $lydo_yeucau   -> p1_a_2 = $request -> p1_a_2;
        $lydo_yeucau   -> p1_a_3 = $request -> p1_a_3;
        $lydo_yeucau   -> p1_a_4 = $request -> p1_a_4;
        $lydo_yeucau   -> chungchi_a = $request -> chungchi_a;
        $lydo_yeucau   -> chungchi_b = $request -> chungchi_b;
        $lydo_yeucau   -> chungchi_c = $request -> chungchi_c;
        $lydo_yeucau   -> toeic = $request -> toeic;
        $lydo_yeucau   -> p2_1 = $request -> p2_1;
        $lydo_yeucau   -> p2_2_1 = $request -> p2_2_1;
        $lydo_yeucau   -> p2_2_2 = $request -> p2_2_2;
        $lydo_yeucau   -> p3_1 = $request -> p3_1;
        $lydo_yeucau   -> p3_2_1 = $request -> p3_2_1;
        $lydo_yeucau   -> p3_2_2 = $request -> p3_2_2;
        $lydo_yeucau   -> p3_3_1 = $request -> p3_3_1;
        $lydo_yeucau   -> p3_3_2 = $request -> p3_3_2;
        $lydo_yeucau   -> p3_3_3 = $request -> p3_3_3;
        $lydo_yeucau   -> p4_1 = $request -> p4_1;
        $lydo_yeucau   -> p4_2 = $request -> p4_2;
        $lydo_yeucau   -> p4_3 = $request -> p4_3;
        $lydo_yeucau   -> p5_1 = $request -> p5_1;
        $lydo_yeucau   -> p5_2 = $request -> p5_2;
        $lydo_yeucau   -> p5_3 = $request -> p5_3;
        $lydo_yeucau  -> id_bangdiem_yeucau = $id_bangdiem_yeucau -> id;
        $lydo_yeucau   -> save();

        return redirect('hocvien/bangdiem/xemyeucau/'.$id_bangdiem_lan1 -> id)->with('thongbao','Đã thêm yêu cầu thành công');
    }

    public function getsuathanhtich($idhoatdong){
        $xoa = thanhtich::where('id_hoatdong','=',$idhoatdong)->delete();

        return redirect('hocvien/loptruong/themthanhtich/'.$idhoatdong);
    }
}
