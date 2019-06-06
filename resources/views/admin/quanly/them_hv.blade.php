<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 01/01/19
 * Time: 11:38 AM
 */
?>
@include('layout/header_admin')
<div class="container">
    @if(count($errors)>0)
        <div class="alert alert-danger">
            @foreach($errors -> all() as $err)
                {{$err}} <br>
            @endforeach
        </div>
    @endif
    <div class="turnback">
        <a href="/doan3/public/admin/quanly/nguoidung_lop/{{$lop -> id}}">Trở về</a>
    </div>
    <div class="tt_lt">
        <h4>Thêm học viên</h4>
        <p><strong>Lớp: </strong>{{$lop -> ten_lop}}</p>
        <p><strong>Ngành: </strong>{{$lop -> nganh -> ten_nganh}}</p>
        <p><strong>Khoa: </strong>{{$lop -> nganh -> khoa -> ten_khoa}}</p>
    </div>
    <form action="/doan3/public/admin/quanly/them_hv/{{$lop -> id}}" method="post">
        @csrf
        <br>
        <div class="form-group">
            <label>Chức vụ</label>
            <select name="chucvu" class="form-control">
                <option value="0">Chọn</option>
                <option value="1">Học viên</option>
                <option value="2">Lớp trưởng</option>
            </select>
            <br>
            <label>Họ tên</label>
            <input type="text" name="hoten" class="form-control">
            <br>
            <label>Mã số sinh viên:</label>
            <input type="text" name="mssv" class="form-control" value="{{($hocvien -> mssv) + 1}}" readonly>
            <br>
            <label>Email</label>
            <input type="text" name="email" class="form-control">
            <br>
            <label>SĐT</label>
            <input type="text" name="sdt" class="form-control">
            <br>
            <label>Ngày sinh: </label>
            <input class="form-control" name="ngaysinh" type="date" id="example-date-input">
            <br>
            <button type="submit" class="btn btn-default">Thêm</button>
        </div>
    </form>
</div>
<div class="container-fluid footer">
    <h5>Copyright &copy; 2015</h5>
</div>
