<?php

namespace App\Http\Controllers;

use App\bangdiem;
use Illuminate\Http\Request;
use App\lop;
use App\namhoc;
use App\hocky;
use App\lop_nh;
use App\hocvien;
use App\bangdiem_lan1;
use App\bangdiem_chitiet_lan1;
use App\bangdiem_yeucau;
use App\chucvu;
use App\chucnang;
use App\chucnang_hk;
use App\lydo_yeucau;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
class CovanController extends Controller
{
	public function showtrangchucovan()
	{
		$covan_chucvu = Auth::guard('cvht')->user()->id_chucvu;
		$chucvu = chucvu::where('id',$covan_chucvu)->first();
		$chucnang_hk = chucnang_hk::where('id',$chucvu->id_chucnang_hk)->first();
		return view('covan.trangcovan',['chucnang_hk'=>$chucnang_hk]);
		//View::share('chucnang_hk', $chucnang_hk);
	}
    public function showthongke()
    {
    	$lop_cv = Auth::guard('cvht')->user()->id_lop;
    	$lop = lop::where('id',$lop_cv)->first();
    	$lop_nh = lop_nh::where('id_lop',$lop->id)->get();
    	$namhoc = namhoc::all();
    	
    	$hocky = hocky::all();
    	return view('covan.thongke',[
    		'lop' => $lop,
    		'lop_nh' => $lop_nh,
    		'namhoc' =>$namhoc,
    		'hocky' => $hocky
    	]);
    }
    public function shownamhoclopthongke($id)
    {
    	$hocky = hocky::where('id_namhoc',$id)->get();
    	foreach ($hocky as $hocky) {
    		//$namhoc = namhoc::where('id',$lop_nh->id_nh)->first();
    		echo "<option value='$hocky->id'>" .$hocky->hocky. "</option>";
    	}

    }

    public function showketquathongke($lop,$hocky)
    {
    	$soluongyeu = 0;
    	$soluongtrungbinh = 0;
    	$soluongkha = 0;
    	$soluonggioi = 0;

    	$soluong_chungchi_a = 0;
    	$soluong_chungchi_b = 0;
    	$soluong_chungchi_c = 0;
    	$soluong_chungchi_toeic = 0;
    	//$lop = $request->input('lop');
    	// $namhoc = $request->input('namhoc');
    	//$hocky = $request->input('hocky');
    	$tonglop = lop::where('id',$lop)->first();
    	$hocvien = hocvien::where('id_lop',$lop)->get();
    	// echo "$hocvien";
    	foreach ($hocvien as $hocvien) {
			$tk_hocvien_yeu = bangdiem_lan1::where(['id_hocvien'=>$hocvien->id,'id_hocky'=>$hocky,'xeploai'=>'Yếu'])->count();
			$soluongyeu=$soluongyeu + $tk_hocvien_yeu;

			$tk_hocvien_trungbinh = bangdiem_lan1::where(['id_hocvien'=>$hocvien->id,'id_hocky'=>$hocky,'xeploai'=>'Trung bình'])->count();
			$soluongtrungbinh = $soluongtrungbinh + $tk_hocvien_trungbinh;	

			$tk_hocvien_kha = bangdiem_lan1::where(['id_hocvien'=>$hocvien->id,'id_hocky'=>$hocky,'xeploai'=>'Khá'])->count();
			$soluongkha = $soluongkha + $tk_hocvien_kha;
			
			$tk_hocvien_gioi = bangdiem_lan1::where(['id_hocvien'=>$hocvien->id,'id_hocky'=>$hocky,'xeploai'=>'Giỏi'])->count();
			$soluonggioi = $soluonggioi+$tk_hocvien_gioi;
			//Xử lý phần chứng chỉ
			$tk_hocvien = bangdiem_lan1::where(['id_hocvien'=>$hocvien->id,'id_hocky'=>$hocky])->get();
			foreach ($tk_hocvien as $tk_hocvien) {
				$chungchi_a = bangdiem_chitiet_lan1::where(['id_bangdiem'=>$tk_hocvien->id,'chungchi_a'=>'4'])->count();
				$soluong_chungchi_a = $soluong_chungchi_a + $chungchi_a;
				$chungchi_b = bangdiem_chitiet_lan1::where(['id_bangdiem'=>$tk_hocvien->id,'chungchi_b'=>'5'])->count();
				$soluong_chungchi_b = $soluong_chungchi_b + $chungchi_b;
				$chungchi_c = bangdiem_chitiet_lan1::where(['id_bangdiem'=>$tk_hocvien->id,'chungchi_c'=>'6'])->count();
				$soluong_chungchi_c = $soluong_chungchi_c + $chungchi_c;
				$chungchi_toeic = bangdiem_chitiet_lan1::where(['id_bangdiem'=>$tk_hocvien->id,'toeic'=>'10'])->count();
				$soluong_chungchi_toeic = $soluong_chungchi_toeic + $chungchi_toeic;
			}
    	}
    	//Tính phần trăm số lượng điểm rèn luyện
    	$phantramyeu = round(($soluongyeu*100)/$tonglop->soluong,2);
    	$phantramtrungbinh = round(($soluongtrungbinh*100)/$tonglop->soluong,2);
    	$phantramkha = round(($soluongkha*100)/$tonglop->soluong,2);
    	$phantramgioi = round(($soluonggioi*100)/$tonglop->soluong,2);
    	//Tính phần trăm số lượng bằng cấp
    	$phantram_chungchi_a = round(($soluong_chungchi_a*100)/$tonglop->soluong,2);
    	$phantram_chungchi_b = round(($soluong_chungchi_b*100)/$tonglop->soluong,2);
    	$phantram_chungchi_c = round(($soluong_chungchi_c*100)/$tonglop->soluong,2);
    	$phantram_chungchi_toeic = round(($soluong_chungchi_toeic*100)/$tonglop->soluong,2);
    	//In ra dữ liệu
    	echo "<div class='table-responsive'>
			<table class='table table-hover'>
				<thead>
					<tr style='background-color: #014c7f;color: white;'>
						<th scope='col'>Loại</th>
						<th scope='col' class='text-center'>Số lượng</th>
						<th scope='col' class='text-center'>Tỉ lệ %</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope='row'>Giỏi</th>
						<td class='text-center'>".$soluonggioi."</td>
						<td class='text-center'>".$phantramgioi."</td>
					</tr>
					<tr>
						<th scope='row'>Khá</th>
						<td class='text-center'>".$soluongkha."</td>
						<td class='text-center'>".$phantramkha."</td>
					</tr>
					<tr>
						<th scope='row'>Trung bình</th>
						<td class='text-center'>".$soluongtrungbinh."</td>
						<td class='text-center'>".$phantramtrungbinh."</td>
					</tr>
					<tr>
						<th scope='row'>Yếu</th>
						<td class='text-center'>".$soluongyeu."</td>
						<td class='text-center'>".$phantramyeu."</td>
					</tr>
				</tbody>

				<thead>
					<tr style='background-color: #014c7f;color: white;'>
						<th scope='col'>Chứng chỉ</th>
						<th scope='col' class='text-center'>Số lượng</th>
						<th scope='col' class='text-center'>Tỉ lệ %</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope='row'>Chứng chỉ A(và tương đương)</th>
						<td class='text-center'>".$soluong_chungchi_a."</td>
						<td class='text-center'>".$phantram_chungchi_a."</td>
					</tr>
					<tr>
						<th scope='row'>Chứng chỉ B(và tương đương)</th>
						<td class='text-center'>".$soluong_chungchi_b."</td>
						<td class='text-center'>".$phantram_chungchi_b."</td>
					</tr>
					<tr>
						<th scope='row'>Chứng chỉ C(và tương đương)</th>
						<td class='text-center'>".$soluong_chungchi_c."</td>
						<td class='text-center'>".$phantram_chungchi_c."</td>
					</tr>
					<tr>
						<th scope='row'>Chứng nhận Toefl  ≥ 450 điểm; IELTS ≥ 4,5; TOEIC ≥ 450 điểm</th>
						<td class='text-center'>".$soluong_chungchi_toeic."</td>
						<td class='text-center'>".$phantram_chungchi_toeic."</td>
					</tr>
				</tbody>
			</table>
		</div>";
    }
    //Phần yêu cầu xem xét
    public function showtrangyeucau($hocky)
    {
    	$lop_cv = Auth::guard('cvht')->user()->id_lop;
    	$lop = lop::where('id',$lop_cv)->first();
    	$hocky = hocky::find($hocky);
    	//$lop_nh = lop_nh::where('id_lop',$lop->id)->get();
    	//$namhoc = namhoc::all();
    	
    		return view('covan.yeucau',[
    			'lop'=>$lop,
    			'hocky'=>$hocky,
    			//'lop_nh'=>$lop_nh,
    			//'namhoc'=>$namhoc
    		]);
    	
    }
    public function showdanhsachcacyeucau($lop,$hocky)
    {
    	
    	$hocvien = hocvien::where('id_lop',$lop)->get();
    	foreach ($hocvien as $hocvien) {
    		$hocvien_bangdiem_lan1 = bangdiem_lan1::where(['id_hocvien'=>$hocvien->id,'id_hocky'=>$hocky])->get();
    		foreach ($hocvien_bangdiem_lan1 as $hocvien_bangdiem_lan1) {
    			$yeucau = bangdiem_yeucau::where('id_bangdiem_lan1',$hocvien_bangdiem_lan1->id)->get();
    			foreach ($yeucau as $yeucau) {
    				$id_bangdiem_lan1 = bangdiem_lan1::where('id',$yeucau->id_bangdiem_lan1)->first();
    				$hocvien_hocky = hocvien::where('id',$id_bangdiem_lan1->id_hocvien)->first();
		    		echo "<tr>
							<th scope='row'>".$hocvien_hocky->hoten."</th>
							<td class='text-center'>".$hocvien_hocky->mssv."</td>
							<td class='text-center'>".$hocvien_bangdiem_lan1->diemtong."</td>
							<td class='text-center'>".$hocvien_bangdiem_lan1->xeploai."</td>
							<td class='text-center'><a href='".asset("covan/bangdiemchitiettheoyeucau/".$hocvien_bangdiem_lan1->id)."' target='_blank' class='btn btn-block btn-outline-info'><i class='fas fa-file-alt'></i> Chi tiết</a></td>
						</tr>";
    			}	
    		}
    	}	
    }
    public function showyeucauchitiet($id)
    {
    	$bangdiem_chitiet_lan1 = bangdiem_chitiet_lan1::where('id_bangdiem',$id)->first();
    	$bangdiem_yeucau = bangdiem_yeucau::where('id_bangdiem_lan1',$id)->first();
    	$lydo_yeucau = lydo_yeucau::where('id_bangdiem_yeucau',$bangdiem_yeucau->id)->first();
    	$bangdiem_lan1 = bangdiem_lan1::where('id',$id)->first();
    	$hocvien = hocvien::where('id',$bangdiem_lan1->id_hocvien)->first();
    	return view('covan/bangdiemyeucauchitiet',[
    		'hocvien'=>$hocvien,
    		'bangdiem_chitiet_hocvien'=>$bangdiem_chitiet_lan1,
    		'bangdiem_yeucau'=>$bangdiem_yeucau,
    		'lydo_yeucau' =>$lydo_yeucau
    	]);
    }

    //Duyệt bảng điểm lần 2
    public function showdanhsachhocvien($hocky)
    {
    	$lop_cv = Auth::guard('cvht')->user()->id_lop;
    	$lop = lop::where('id',$lop_cv)->first();
    	//$lop_nh = lop_nh::where('id_lop',$lop->id)->get();
    	$hocky = hocky::find($hocky);
    	//$namhoc = namhoc::all();
		return view('covan.duyetlan2',[
			'lop'=>$lop,
			//'lop_nh'=>$lop_nh,
			'hocky' => $hocky,
			//'namhoc'=>$namhoc
		]);
    }
    public function showdanhsachchamlan2($lop,$hocky)
    {
    	$hocvien = hocvien::where('id_lop',$lop)->get();
    	foreach ($hocvien as $hocvien) {
    		$hocvien_bangdiem_lan1 = bangdiem_lan1::where(['id_hocvien'=>$hocvien->id,'id_hocky'=>$hocky])->get();
    		foreach ($hocvien_bangdiem_lan1 as $hocvien_bangdiem_lan1) {
    			$hocvien_hocky = hocvien::where('id',$hocvien_bangdiem_lan1->id_hocvien)->first();
                if ($hocvien_bangdiem_lan1->lan_2 == 1) {
                    echo "<tr>
                            <th scope='row'>".$hocvien_hocky->hoten."</th>
                            <td class='text-center'>".$hocvien_hocky->mssv."</td>
                            <td class='text-center'></td>
                            <td class='text-center'>".$hocvien_bangdiem_lan1->diemtong."</td>
                            <td class='text-center'><i class='fas fa-check'></i></td>
                            <td class='text-center'>".$hocvien_bangdiem_lan1->xeploai."</td>
                            <td class='text-center'><a href='".asset("covan/chitiet_hocvien_lan2/".$hocvien_bangdiem_lan1->id)."' target='_blank' class='btn btn-block btn-outline-info'><i class='fas fa-file-alt'></i> Chi tiết</a></td>
                        </tr>";
                }
                else{
                   echo "<tr>
                            <th scope='row'>".$hocvien_hocky->hoten."</th>
                            <td class='text-center'>".$hocvien_hocky->mssv."</td>
                            <td class='text-center'>".$hocvien_bangdiem_lan1->diemtong."</td>
                            <td class='text-center'></td>
                            <td class='text-center'></td>
                            <td class='text-center'>".$hocvien_bangdiem_lan1->xeploai."</td>
                            <td class='text-center'><a href='".asset("covan/chitiet_hocvien_lan2/".$hocvien_bangdiem_lan1->id)."' target='_blank' class='btn btn-block btn-outline-info'><i class='fas fa-file-alt'></i> Chi tiết</a></td>
                        </tr>"; 
		    		
		        }
            }
    		
    	}
    }
    public function showchitietdiemdachamlan1($id)
    {
        $bangdiem_chitiet_hocvien = bangdiem_chitiet_lan1::where('id_bangdiem',$id)->first();
    	$id_hocvien = bangdiem_lan1::find($id);
    	$hocvien = hocvien::where('id',$id_hocvien->id_hocvien)->first();
    	return view('covan.duyetlan2_chitiet',[
    		'bangdiem_chitiet_hocvien'=>$bangdiem_chitiet_hocvien,
    		'hocvien'=>$hocvien,
    	]);
    }
    public function updatediemlan2(Request $request)
    {
    	$id = $request->input('id_bangdiem_chitiet_lan2');
    	$diemchitiet = bangdiem_chitiet_lan1::find($id);
    	//Lưu điểm vào bangdiem_chitiet_lan1
    	$diemchitiet->p1_a_1 = $request->input('p1_a_1');
    	$diemchitiet->p1_a_2 = $request->input('p1_a_2');
    	$diemchitiet->p1_a_3 = $request->input('a');
    	$diemchitiet->p1_a_4 = $request->input('p1_a_4');
    	$diemchitiet->chungchi_a = $request->input('chungchi_a');
    	$diemchitiet->chungchi_b = $request->input('chungchi_b');
    	$diemchitiet->chungchi_c = $request->input('chungchi_c');
    	$diemchitiet->toeic = $request->input('toeic');
    	$diemchitiet->p2_1 = $request->input('p2_1');
    	$diemchitiet->p2_2_1 = $request->input('p2_2_1');
    	$diemchitiet->p2_2_2 = $request->input('p2_2_2');
    	$diemchitiet->p3_1 = $request->input('p3_1');
    	$diemchitiet->p3_2_1 = $request->input('p3_2_1');
    	$diemchitiet->p3_2_2 = $request->input('p3_2_2');
    	$diemchitiet->p3_3_1 = $request->input('p3_3_1');
    	$diemchitiet->p3_3_2 = $request->input('p3_3_2');
    	$diemchitiet->p3_3_3 = $request->input('p3_3_3');
    	$diemchitiet->p4_1 = $request->input('p4_1');
    	$diemchitiet->p4_2 = $request->input('p4_2');
    	$diemchitiet->p4_3 = $request->input('p4_3');
    	$diemchitiet->p5_1 = $request->input('p5_1');
    	$diemchitiet->p5_2 = $request->input('p5_2');
    	$diemchitiet->p5_3 = $request->input('p5_3');
    	$diemchitiet->save();
    	//Lưu điểm tổng vào bangdiem_lan1
    	$diemtong_lan2 = bangdiem_lan1::where('id',$diemchitiet->id_bangdiem)->first();
    	$diemtong = $request->input('tongcacmuc');
        $diemtong_lan2->diemtong = $diemtong;
    	$diemtong_lan2->lan_2 = 1;
    	if($diemtong >= 90){
    		$diemtong_lan2->xeploai = 'Xuất sắc';
    	}
		elseif(($diemtong >= 80) && ($diemtong <= 89)){
			$diemtong_lan2->xeploai = 'Tốt';
		}
		elseif(($diemtong >= 65) && ($diemtong <= 79)){
			$diemtong_lan2->xeploai = 'Khá';
		}
		elseif(($diemtong >= 50) && ($diemtong <= 64)){
			$diemtong_lan2->xeploai = 'Trung bình';
		}
		elseif(($diemtong >= 35) && ($diemtong <= 49)){
			$diemtong_lan2->xeploai = 'Yếu';
		}		
		else{
			$diemtong_lan2->xeploai = 'Kém';
		}
    	$diemtong_lan2->save();
		$chucnang_hk = chucnang_hk::first();
		return redirect('covan/duyetlan2/'.$chucnang_hk -> id_hocky)->with('thongbao','Đã duyệt lần 2');
    }
}
