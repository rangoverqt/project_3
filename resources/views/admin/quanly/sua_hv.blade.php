<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 01/01/19
 * Time: 11:07 AM
 */
?>
@include('layout/header_admin')
<div class="container">
    <div class="turnback">
        <a href="/doan3/public/admin/quanly/nguoidung_lop/{{$hocvien -> lop -> id}}">Trở về</a>
    </div>
    <div class="tt_sv">
        <h4>Thông tin học viên</h4>
        <p><strong>Họ tên: </strong>{{$hocvien -> hoten}}</p>
        <p><strong>MSSV: </strong>{{$hocvien -> mssv}}</p>
        <p><strong>Lớp: </strong>{{$hocvien -> lop -> ten_lop}}</p>
    </div>
    <form action="" method="post">
        @csrf
    <div class="form-group">
        <label>Chức vụ</label>
        <select name="chucvu" class="form-control">
            <option value="{{$hocvien -> id_chucvu}}">
                @if($hocvien -> id_chucvu == 2)
                    Lớp trưởng
                    @else
                    Sinh viên
                    @endif
            </option>
            @if($hocvien -> id_chucvu == 2)
            <option class="form-control" value="1">
                Sinh viên
            </option>
                @else
                <option class="form-control" value="2">
                    Lớp trưởng
                </option>
            @endif
        </select>
        <label>Họ tên</label>
        <input type="text" name="hoten" value="{{$hocvien -> hoten}}" class="form-control">
        <br>
        <label>Email</label>
        <input type="text" name="email" value="{{$hocvien -> email}}" class="form-control">
        <br>
        <label>SĐT</label>
        <input type="text" name="sdt" value="{{$hocvien -> sdt}}" class="form-control">
        <br>
        <label>Ngày sinh: </label>
        <input class="form-control" name="ngaysinh" type="date" id="example-date-input" value="{{$hocvien -> ngay_sinh}}">
        <br>
        <button type="submit" class="btn btn-default">Thêm</button>
    </div>
    </form>
</div>
<div class="container-fluid footer">
    <h5>Copyright &copy; 2015</h5>
</div>
