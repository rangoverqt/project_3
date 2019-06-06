<?php

namespace App\Http\Controllers;

use App\hoatdong_hk_lop;
use Illuminate\Http\Request;
use App\hoatdong;
use App\lop;
use App\nganh;
use App\namhoc;
use App\lop_nh;
class BithuController extends Controller
{
    //Phần lớp
    public function lop()
    {
        $lop = lop::all();
        $nganh = nganh::all();
        $lop_nh = lop_nh::all();
        $namhoc = namhoc::all();
        return view('bithu.quanlylop',[
            'lop'=>$lop,
            'nganh'=>$nganh,
            'lop_nh'=>$lop_nh,
            'namhoc'=>$namhoc
        ]);

    }
    public function themlop()
    {
        $nganh  = nganh::all();
        $namhoc = namhoc::all();
        return view('bithu.themlop',[
            'nganh'=>$nganh,
            'namhoc'=>$namhoc
        ]);
    }

    public function insertlop(Request $request)
    {
        $lop = new lop;
        $lop->ten_lop = $request->input('tenlop');
        $lop->soluong = $request->input('soluong');
        $lop->id_nganh = $request->input('nganh');
        $lop->save();
        $lop_id = $lop->id;
        // $lop_nh->id_lop = $lop->id;
        // $lop_nh->id_nh = $request->input('namhoc');
        //$lop_nh->save();
        $namhoc_bd = $request->input('namhoc_bd');
        $namhoc_kt = $request->input('namhoc_kt');
        for ($i=0; $i =(($namhoc_kt - $namhoc_bd)+1); $i++) { 
            $lop_nh = new lop_nh;
            $lop_nh->id_lop = $lop_id;
            $lop_nh->id_nh = $namhoc_bd;
            $lop_nh->save();
            $namhoc_bd++;
        }
        return redirect('bithu/themlop')->with('success', 'Lớp mới của bạn đã thêm thành công!');
    }
    public function lopcansua($id)
    {   
        // Lấy các thông tin theo id
        $lop = lop::find($id);
        $nganh_id = nganh::where('id',$lop->id_nganh)->first();
        $lop_nh_id_bd = lop_nh::where('id_lop',$lop->id)->first();
        $lop_nh_id_kt = lop_nh::where('id_lop',$lop->id)->get();
        $namhoc_id_bd = namhoc::where('id',$lop_nh_id_bd->id_nh)->first();
        foreach ($lop_nh_id_kt as $lop_nh_id_kt) {
            $namhoc_id_kt = namhoc::where('id',$lop_nh_id_kt->id_nh)->first();
        }
        //Lấy tất cả các thông tin để so sánh
        $nganh = nganh::all();
        $namhoc = namhoc::all();
        return view('bithu/sualop',[
            'lop'=>$lop,
            'nganh_id'=>$nganh_id,
            'namhoc_id_bd'=>$namhoc_id_bd,
            'namhoc_id_kt'=>$namhoc_id_kt,
            'nganh'=>$nganh,
            'namhoc'=>$namhoc
        ]);
    }
    public function updatelop(Request $request, $id)
    {
        $lop = lop::find($id);
        $lop->ten_lop = $request->input('tenlop');
        $lop->soluong = $request->input('soluong');
        $lop->id_nganh = $request->input('nganh');
        $lop->save();
        $lop_id = $lop->id;
        //Xóa xong insert lại
        $lop_nh = lop_nh::where('id_lop',$id)->delete();
        $namhoc_bd = $request->input('namhoc_bd');
        $namhoc_kt = $request->input('namhoc_kt');
        for ($i=0; $i =(($namhoc_kt - $namhoc_bd)+1); $i++) { 
            $lop_nh = new lop_nh;
            $lop_nh->id_lop = $lop_id;
            $lop_nh->id_nh = $namhoc_bd;
            $lop_nh->save();
            $namhoc_bd++;
        }
        return redirect('bithu/sualop/'.$id)->with('success', 'Cập nhật lớp thành công!');   
    }
    public function xoalop($id)
    {
        $lop_nh = lop_nh::where('id_lop',$id)->delete();
        $lop = lop::find($id);
        $lop->delete();
        return redirect('bithu/quanlylop')->with('success', 'Xóa lớp thành công!');
    }

    //Phần hoạt động
    public function hoatdong()
    {
        $hoatdong = hoatdong::all();
        return view('bithu.hoatdong',['hoatdong'=>$hoatdong]);
    }
    public function addhoatdong(Request $request)
    {
        $hoatdong = new hoatdong;
        $hoatdong->ten_hoatdong = $request->input('tenhoatdong');
        $hoatdong->diem = $request->input('diem');
        $hoatdong->thanh_tich= $request->input('thanhtich');
        $hoatdong->soluong = $request->input('soluong');
        $hoatdong->ngay_bd = $request->input('ngaybatdau');
        $hoatdong->ngay_kt = $request->input('ngayketthuc');
        $hoatdong->thoigian_bd = $request->input('thoigianbatdau');
        $hoatdong->thoigian_kt = $request->input('thoigianketthuc');
        $hoatdong_hk = new hoatdong_hk_lop;
        $hoatdong_hk -> id_hocky = 1;
        $hoatdong_hk -> id_lop = 1;
        $hoatdong->save();
        return redirect('bithu/suahoatdong/'.$hoatdong -> id)->with('thongbao','Đã thêm thành công');
    }
    public function hoatdongcansua($id)
    {
        $hoatdong = hoatdong::find($id);
        return view('bithu.suahoatdong',['hoatdong'=>$hoatdong]);
    }
    public function updatehoatdong(Request $request, $id)
    {
        $hoatdong = hoatdong::find($id);
        $hoatdong->ten_hoatdong = $request->input('tenhoatdong');
        $hoatdong->diem = $request->input('diem');
        $hoatdong->thanh_tich= $request->input('thanhtich');
        $hoatdong->soluong = $request->input('soluong');
        $hoatdong->ngay_bd = $request->input('ngaybatdau');
        $hoatdong->ngay_kt = $request->input('ngayketthuc');
        $hoatdong->thoigian_bd = $request->input('thoigianbatdau');
        $hoatdong->thoigian_kt = $request->input('thoigianketthuc');
        $hoatdong->save();

        return redirect('bithu/suahoatdong/'.$hoatdong -> id)->with('thongbao','Đã sửa thành công');
    }
    public function xoahoatdong($id)
    {
        $hoatdong = hoatdong::find($id);
        $hoatdong->delete();
        return redirect('bithu/hoatdong/'.$hoatdong -> id)->with('thongbao','Đã xóa thành công');
    }
}
