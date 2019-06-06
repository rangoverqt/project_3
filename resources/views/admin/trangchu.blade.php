<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 29/12/18
 * Time: 2:05 PM
 */
?>
@include('layout/header_admin')
<div class="container">
<div class="tt_sv">
    <h4>Thông tin admin</h4>
    <p><strong>Họ tên: </strong>{{$admin -> hoten}}</p>
    <p><strong>Email: </strong>{{$admin -> email}}</p>
    <p><strong>Ngày sinh: </strong>{{$admin -> ngay_sinh}}</p>
</div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="margin-top: 10px">
        <div class="hovereffect">
            <img class="img-responsive" src="{{asset('img/704532.jpg')}}" alt="">
            <div class="overlay">
                <h2>Quản lý người dùng</h2>
                <a class="info" href="/doan3/public/admin/quanly/quanly_nguoidung/{{$admin -> id}}">Truy cập</a>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="margin-top: 10px">
        <div class="hovereffect">
            <img class="img-responsive" src="{{asset('img/704532.jpg')}}" alt="">
            <div class="overlay">
                <h2>Phân quyền người dùng</h2>
                <a class="info" href="/doan3/public/admin/quanly/phienphanquyen/{{$admin -> id}}">Truy cập</a>
            </div>
        </div>
    </div>
</div>
</div>
<div class="container-fluid footer">
    <h5>Copyright &copy; 2015</h5>
</div>
