<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 05/12/18
 * Time: 8:17 PM
 */
?>

@include('layout/header')
@if(count($errors)>0)
    <div class="alert alert-danger">
        @foreach($errors -> all() as $err)
            {{$err}} <br>
        @endforeach
    </div>
@endif
@if(session('thongbao'))
    <div class="alert alert-success">
        {{session('thongbao')}}
    </div>
@endif
<div class="container">
    <div class="turnback">
        <a href="/doan3/public/hocvien/loptruong/trangchu/{{$loptruong -> id}}" class="turnback">Trở về</a>
    </div>
    <div class="tt_sv">
    <h4>Danh sách học viên</h4>
    <h5>Lớp: {{$lop -> ten_lop}}</h5>
    <h5>Ngành: {{$nganh -> ten_nganh}}</h5>
    <h5>Khoa: {{$nganh -> khoa -> ten_khoa}}</h5>
    </div>
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>STT</th>
            <th>MSSV</th>
            <th>Họ tên</th>
            <th>Chức vụ</th>
            <th>Ngày sinh</th>
            <th>Email</th>
            <th>SĐT</th>
            <th>Xóa</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        ?>
        @foreach($hocvien as $hv)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$hv -> mssv}}</td>
                <td>{{$hv -> hoten}}</td>
                <td>{{$hv -> chucvu -> ten_chucvu}}</td>
                <td>{{$hv -> ngay_sinh}}</td>
                <td>{{$hv -> email}}</td>
                <td>{{$hv -> sdt}}</td>
                <td><a href="/doan3/public/hocvien/loptruong/xoa/{{$hv -> id}}">Xóa</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="turnback">
    <a href="/doan3/public/hocvien/loptruong/export/{{$lop->id}}">Tải xuống</a>
        <form action="/doan3/public/hocvien/loptruong/import/{{$lop->id}}"
              class="form-horizontal" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="import_file"/><br>
            <button class="btn btn-primary">Import File</button>
        </form>
    </div>
</div>
<div class="container-fluid footer">
    <h5>Copyright &copy; 2015</h5>
</div>