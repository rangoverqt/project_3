<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 26/11/18
 * Time: 1:05 AM
 */
?>
@include('layout/header')
<div class="container">

    @if(session('thongbao'))
        <div class="alert alert-success">
            {{session('thongbao')}}
        </div>
    @endif
    @if($chucvu_hk == null)

        @elseif($hocvien -> id_chucvu == 1 && $chucvu_hk -> id_chucnang == 2 || $hocvien -> id_chucvu == 2 && $chucvu_hk -> id_chucnang == 2)
        @if(count($bangdiem_tc) > 0)
            <div class="turnback">
                <a href="/doan3/public/hocvien/bangdiem/xemtucham/{{$hocvien -> id}}">Xem bảng đã tự chấm</a>
            </div>
        @else
    <div class="turnback">
        <a href="/doan3/public/hocvien/bangdiem/tucham/{{$hocvien -> id}}">Tự chấm điểm</a>
    </div>
            @endif
    @endif
        @if($hocvien -> id_chucvu == 2)
    <div class="turnback">
        <a style="margin-right: 20px" href="/doan3/public/hocvien/loptruong/trangchu/{{$hocvien -> id}}">Quản lý</a>
    </div>
        @endif
    <div class="tt_sv">
    <h4>Thông tin sinh viên:</h4>
    <p><strong>Mã số sinh viên:</strong>{{$hocvien -> mssv}}</p>
    <p><strong>Họ tên:</strong>{{$hocvien -> hoten}}</p>
    <p><strong>Lớp:</strong>{{$hocvien -> lop -> ten_lop}}</p>
    </div>
        @if(isset($bangdiem))
    <div class="bang">
        @foreach ($namhoc as $ch)
        <table class="element table table-striped table-bordered table-hover" style="border: solid black 2px">
            <tr align="center">
                <thead>
                <tr><th style="">Năm học</th>
                </tr>
                </thead>
                <tbody>
                <tr><td>{{$ch -> namhoc}}</td>
                <thead><tr><th>Học kỳ</th><th>Điểm</th><th>Xếp loại</th><th>Xem chi tiết</th>
                </tr></thead>
                @foreach ($bangdiem as $dp)
            </tr>
            <tbody>
                <tr>
                    <td>{{$dp -> hocky -> hocky}}</td>
                    <td>{{$dp -> diemtong}}</td>
                    <td>{{$dp -> xeploai}}</td>
                    <td style="background-color: #d2dcf9"><a href="/doan3/public/hocvien/bangdiem/xemchitiet/{{$dp -> id}}">Xem</a></td></tr>
            </tbody>
            @endforeach
        </table>
            @endforeach
    </div>
            @else
            <table class="table table-hover table-striped table-bordered">
                <thead>
                <tr>
                    <th>Thông báo</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Chưa cập nhật</td>
                </tr>
                </tbody>
            </table>
        @endif
</div>
<div class="container-fluid footer">
    <h5>Copyright &copy; 2015</h5>
</div>
