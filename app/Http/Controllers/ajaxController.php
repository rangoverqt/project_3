<?php

namespace App\Http\Controllers;

use App\cvht;
use App\hoatdong;
use App\hoatdong_hk_lop;
use App\hocky;
use App\hocvien;
use App\lop;
use App\nganh;
use App\phieu_dd;
use Illuminate\Http\Request;

class ajaxController extends Controller
{
    //
    public function gethocky($idnamhoc)
    {
        $hocky = hocky::where('id_namhoc','=',$idnamhoc)->get();
        echo '<h5>Chọn học kỳ</h5>';
        echo '<option value="0">Chọn</option>';
        foreach ($hocky as $hk){
            echo '<option value="'.$hk -> id.'">'.$hk -> hocky.'</option>';
        }
    }
    public function gethoatdong($idhocky)
    {
        $hd_nh = hoatdong_hk_lop::where('id_hocky','=',$idhocky)->get();
        $no = 1;
    echo '<table class="table table-hover table-striped table-bordered">
            <thead>
            <tr>
            <th>STT</th>
            <th>Tên hoạt động</th>
            <th>Điểm</th>
            <th>Ngày bắt đầu</th>
            <th>Ngày kết thúc</th>
            <th>Số lượng</th>
            <th>Điểm danh</th>
            </tr>
            </thead>
            <tbody>
            ';
            foreach ($hd_nh as $hd){
    echo    '<tr><td>'. $no++ .'</td>';
    echo    '<td>'. $hd -> hoatdong -> ten_hoatdong . '</td>';
    echo    '<td>'. $hd -> hoatdong -> diem . '</td>';
        echo    '<td>'. $hd -> hoatdong  -> ngay_bd. '</td>';
        echo    '<td>'. $hd -> hoatdong  -> ngay_kt . '</td>';
        echo    '<td>'. $hd -> hoatdong  -> soluong . '</td>';
        if (phieu_dd::where('id_hoatdong','=',$hd -> hoatdong  -> id)->count()>0){
            echo    '<td><a href="/doan3/public/hocvien/loptruong/xemdiemdanh/'. $hd -> hoatdong -> id .'">Xem</a></td>';
        }
else{
    echo    '<td><a href="/doan3/public/hocvien/loptruong/diemdanh/'
        .$hd -> hoatdong -> id.'">Điểm danh</a></td></tr>';
}
}
echo   '
            </tbody>
            </table>';
}

    public function getnganh($idkhoa){
        $nganh = nganh::where('id_khoa','=',$idkhoa)->get();
        echo '<h5>Chọn ngành</h5>';
        echo '<option value="0">Chọn</option>';
        foreach ($nganh as $ng){
            echo '<option value="'.$ng -> id.'">'.$ng -> ten_nganh.'</option>';
        }
    }
    public function getlop($idnganh)
    {
        $lop = lop::where('id_nganh','=',$idnganh)->get();
        $no = 1;
        echo '<table class="table table-hover table-striped table-bordered">
            <thead>
            <tr>
            <th>STT</th>
            <th>Tên lớp</th>
            <th>Số lượng</th>
            <th>Xem chi tiết</th>
            </tr>
            </thead>
            <tbody>
            ';
        foreach ($lop as $lp){
            echo    '<tr><td>'. $no++ .'</td>';
            echo    '<td>'. $lp -> ten_lop. '</td>';
            echo    '<td>'. hocvien::where('id_lop','=',$lp -> id)->count(). '</td>';
                echo    '<td><a href="/doan3/public/admin/quanly/nguoidung_lop/'
                    .$lp -> id.'">Xem chi tiết</a></td></tr>';
            }
        echo   '
            </tbody>
            </table>';
    }

    public function getcvht($idcvht){
        $cvht_kl = cvht::find($idcvht);
        echo '
<h5>Thông tin giảng viên</h5>
<input name="idcvht" value="'. $cvht_kl -> id .'" hidden>
<label>Họ tên: </label>
<input class="form-control" name="hoten" value=" '. $cvht_kl -> hoten .' " disabled>
<br>
<label>Tên đăng nhập: </label>
<input class="form-control" name="tendn" value=" '. $cvht_kl -> ten_dn .' " disabled>
<br>
<label>Email: </label>
<input class="form-control" name="email" value="'. $cvht_kl -> email .'" disabled>
<br>
<label>SĐT: </label>
<input class="form-control" name="sdt" value="'. $cvht_kl -> sdt .'" disabled>
<br>
<label>Ngày sinh: </label>
<input class="form-control" name="ngaysinh" value="'. $cvht_kl -> ngay_sinh .'" disabled>
<br>
<button type="submit" class="btn btn-default">Thêm</button> 
';
    }

    public function chonhocky($idnamhoc)
    {
        $hocky = hocky::where('id_namhoc', '=', $idnamhoc)->get();
        echo '<option value="0">Chọn</option>';
        foreach ($hocky as $hk){
            echo '
        <option value="'. $hk -> id .'">'. $hk -> hocky .'</option>
        ';
        }
    }

    public function xacnhan($idhocky){
        $hocky = hocky::find($idhocky);
        echo '
<h4>Thông tin đã chọn: </h4>
<p><strong>Học kỳ: </strong>'. $hocky -> hocky .'</p>
<p><strong>Năm học: </strong>'. $hocky -> namhoc -> namhoc .'</p>
<div class="turnback">
<a href="/doan3/public/admin/quanly/chuyentrang/'. $hocky -> id .'">Tiến hành phân quyền</a>
</div>
';
    }
}
