<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 26/11/18
 * Time: 4:12 AM
 */
?>
@include('layout/header')
<div class="container">
    <div class="turnback"><a href="/doan3/public/hocvien/trangchu/{{$loptruong -> id}}">Trở về</a></div>
    <div class="tt_lt">
    <h4>Trang quản lý: Lớp trưởng</h4>
        <h5>Họ tên: {{$loptruong -> hoten}}</h5>
        <h5>Lớp: {{$loptruong -> lop -> ten_lop}}</h5>
    </div>
    <div class="chucnang">
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="margin-top: 10px">
        <div class="hovereffect">
            <img class="img-responsive" src="{{asset('img/704532.jpg')}}" alt="">
            <div class="overlay">
                <h2>Danh sách học viên</h2>
                <a class="info" href="/doan3/public/hocvien/loptruong/danhsach/{{$loptruong -> id_lop}}">Truy cập</a>
            </div>
        </div>
    </div>
        @if($chucvu_hk == null)

        @elseif($loptruong -> id_chucvu == 2 && $chucvu_hk -> id_chucnang == 3)
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="margin-top: 10px">
        <div class="hovereffect">
            <img class="img-responsive" src="{{asset('img/704532.jpg')}}" alt="">
            <div class="overlay">
                <h2>Bảng điểm chờ duyệt lần 1</h2>
                <a class="info" href="/doan3/public/hocvien/loptruong/bangdiemlan1/{{$loptruong -> id_lop}}">Truy cập</a>
            </div>
        </div>
    </div>
        @endif
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="margin-top: 10px">
        <div class="hovereffect">
            <img class="img-responsive" src="{{asset('img/704532.jpg')}}" alt="">
            <div class="overlay">
                <h2>Thống kê kết quả</h2>
                <a class="info" href="/doan3/public/hocvien/loptruong/thongke/{{$loptruong->id_lop}}">Truy cập</a>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="margin-top: 10px">
        <div class="hovereffect">
            <img class="img-responsive" src="{{asset('img/704532.jpg')}}" alt="">
            <div class="overlay">
                <h2>Quản lý hoạt động</h2>
                <a class="info" href="/doan3/public/hocvien/loptruong/hoatdong/{{$loptruong->id_lop}}">Truy cập</a>
            </div>
        </div>
    </div>
</div>
</div>
<div class="container-fluid footer">
    <h5>Copyright &copy; 2015</h5>
</div>