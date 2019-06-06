<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 26/11/18
 * Time: 5:14 AM
 */
?>
@include('layout/header')
@if(session('thongbao'))
    <div class="alert alert-success">
        {{session('thongbao')}}
    </div>
@endif
<div class="container">
    <div class="turnback"><a href="/doan3/public/hocvien/loptruong/trangchu/{{$hocvien -> id}}">Trở về</a></div>
    <div class="tt_hk">
        <p><strong>Lớp: </strong>{{$lop -> ten_lop}}</p>
        <p><strong>Ngành: </strong>{{$lop -> nganh -> ten_nganh}}</p>
        <p><strong>Khoa: </strong>{{$lop -> nganh -> khoa -> ten_khoa}}</p>
        <p><strong>Năm học: </strong>{{$chucvu_hk -> hocky -> namhoc -> namhoc}}</p>
        <p><strong>Học kỳ: </strong>{{$chucvu_hk -> hocky -> hocky}}</p>
    </div>
    <div class="bang">
        <table class="table table-hover table-striped table-bordered">
            <thead>
            <tr>
                <th>STT</th>
                <th>MSSV</th>
                <th>Họ tên</th>
                <th>Điểm tổng</th>
                <th>Xếp loại</th>
                <th>Xem bảng điểm</th>
                <th>Duyệt nhanh</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            ?>
            @foreach($hocvien_l as $hl)
                @if($hl -> hocvien -> lop -> id == $lop -> id)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$hl -> hocvien -> mssv}}</td>
                <td>{{$hl -> hocvien -> hoten}}</td>
                @if(count($lan1 =\App\bangdiem_lan1::where('id_hocvien','=',$hl -> hocvien -> id)->where('id_hocky','=',
                $chucvu_hk -> hocky -> id)->get()) > 0)
                    @foreach($lan1 as $l1)
                        <td>{{$l1 -> diemtong}}</td>
                    <td>{{$l1 -> xeploai}}</td>
                    <td><a href="/doan3/public/hocvien/loptruong/bangdiem/{{$lop -> id}}/xemchitiet_lan1/{{$hl -> id}}">Xem chi tiết</a></td>
                        <td><strong>Đã duyệt</strong></td>
                    @endforeach
                    @else
                    <td>{{$hl -> diemtong}}</td>
                    <td>{{$hl -> xeploai}}</td>
                <td><a href="/doan3/public/hocvien/loptruong/bangdiem/{{$lop -> id}}/duyet_lan1/{{$hl -> id}}">Xem</a></td>
                <td><a href="/doan3/public/hocvien/loptruong/bangdiem/{{$lop -> id}}/duyetnhanh/{{$hl -> id}}">Duyệt</a></td>
                    @endif
            </tr>
            @endif
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="bang">
        <h4>Các học viên không tự chấm</h4>
        <table class="table table-hover table-striped table-bordered">
            <thead>
            <tr>
                <th>STT</th>
                <th>MSSV</th>
                <th>Họ tên</th>
                <th>Chấm</th>
                <th>Trạng thái</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            ?>
            @foreach($hocvien_ktc as $hl)
                @if($hl -> lop -> id == $lop -> id)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$hl -> mssv}}</td>
                        <td>{{$hl -> hoten}}</td>
                        @if(count(\App\bangdiem_lan1::where('id_hocvien','=',$hl -> id)
                        ->where('id_hocky','=',$chucvu_hk -> hocky -> id)->get()) > 0 &&
                        count(\App\bangdiem::where('id_hocvien','=',$hl -> id)
                        ->where('id_hocky','=',$chucvu_hk -> hocky -> id)->get()) == 0)
                        <td><a href="/doan3/public/hocvien/loptruong/xemcham_lan1/{{$hl -> id}}">Xem chi tiết</a></td>
                            <td><strong>Đã chấm</strong></td>
                            @else
                        <td><a href="/doan3/public/hocvien/loptruong/cham_lan1/{{$hl -> id}}">Chấm</a></td>
                            <td><strong>Chưa chấm</strong></td>
                            @endif
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="container-fluid footer">
    <h5>Copyright &copy; 2015</h5>
</div>
