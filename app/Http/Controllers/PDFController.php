<?php

namespace App\Http\Controllers;

use App\bangdiem;
use App\bangdiem_chitiet;
use App\bangdiem_chitiet_lan1;
use App\bangdiem_lan1;
use App\bangdiem_yeucau;
use App\chucnang_hk;
use App\hocky;
use App\hocvien;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PDFController extends Controller
{
    //
    public function getPDF(Request $request,$idhocvien){
        $hocvien = hocvien::find($idhocvien);
        $chucvu_hk = chucnang_hk::find($hocvien-> chucvu ->id_chucnang_hk);
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
        view()->share(['hocvien'=>$hocvien,'chucvu_hk'=>$chucvu_hk,'bangdiem'=>$bangdiem,'tong1'=>$tong1,
            'tong2'=>$tong2,'tong3'=>$tong3,'tong4'=>$tong4,'tong5'=>$tong5,'bangdiem_chitiet'=>$bangdiem_chitiet]);
        if($request->has('download')){
            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            $pdf = PDF::loadView('hocvien.xemtucham');
            return $pdf->download('bangtucham.pdf');
        }
        return view('hocvien.xemtucham',['hocvien'=>$hocvien,'chucvu_hk'=>$chucvu_hk,'tong1'=>$tong1,
            'tong2'=>$tong2,'tong3'=>$tong3,'tong4'=>$tong4,'tong5'=>$tong5,'bangdiem'=>$bangdiem,
            'bangdiem_chitiet'=>$bangdiem_chitiet]);

    }

    public function getPDF_chitiet(Request $request,$idbangdiem){
        $bangdiem_lan1 = bangdiem_lan1::find($idbangdiem);
        $namhoc = hocky::find($bangdiem_lan1 -> id_hocky);
        $bangdiem_yeucau = bangdiem_yeucau::where('id_bangdiem_lan1','=',$idbangdiem)->count();
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
        view()->share(['bangdiem_lan1'=>$bangdiem_lan1,'namhoc'=>$namhoc,'hocvien'=>$hocvien,
            'tong1_lan1'=>$tong1_lan1,'tong2_lan1'=>$tong2_lan1,'tong3_lan1'=>$tong3_lan1,'tong4_lan1'=>$tong4_lan1,
            'tong5_lan1'=>$tong5_lan1,
            'tong1'=>$tong1,'tong2'=>$tong2,'tong3'=>$tong3,'tong4'=>$tong4,'tong5'=>$tong5,
            'bangdiem_chitiet_lan1'=>$bangdiem_chitiet_lan1,
            'bangdiem_chitiet'=>$bangdiem_chitiet,
            'chucvu_hk' => $chucvu_hk,'bangdiem_yeucau'=>$bangdiem_yeucau]);
        if($request->has('download')){
                    PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
                    $pdf = PDF::loadView('hocvien.xemchitiet');
                    return $pdf->download('bangdiem_chitiet.pdf');
                }
        return view('hocvien.xemchitiet',['bangdiem_lan1'=>$bangdiem_lan1,'namhoc'=>$namhoc,'hocvien'=>$hocvien,
            'tong1_lan1'=>$tong1_lan1,'tong2_lan1'=>$tong2_lan1,'tong3_lan1'=>$tong3_lan1,'tong4_lan1'=>$tong4_lan1,
            'tong5_lan1'=>$tong5_lan1,
            'tong1'=>$tong1,'tong2'=>$tong2,'tong3'=>$tong3,'tong4'=>$tong4,'tong5'=>$tong5,
            'bangdiem_chitiet_lan1'=>$bangdiem_chitiet_lan1,
            'bangdiem_chitiet'=>$bangdiem_chitiet,
            'chucvu_hk' => $chucvu_hk,'bangdiem_yeucau'=>$bangdiem_yeucau]);
    }
}
