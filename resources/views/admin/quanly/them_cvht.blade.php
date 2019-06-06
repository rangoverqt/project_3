<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 30/12/18
 * Time: 12:18 AM
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
        <a href="/doan3/public/admin/quanly/quanly_nguoidung/{{$admin -> id}}">Trở về</a>
    </div>
    <div class="tt_lt">
        <h4>Thông tin lớp học</h4>
        <p><strong>Tên lớp: </strong>{{$lop -> ten_lop}}</p>
        <p><strong>Ngành: </strong>{{$lop -> nganh -> ten_nganh}}</p>
        <p><strong>Khoa: </strong>{{$lop -> nganh -> khoa -> ten_khoa}}</p>
    </div>
        <h4>Thêm cố vấn học tập</h4>
    <br>
    <button id="chuyendoi">Thêm mới hoặc chọn</button>
    <form action="/doan3/public/admin/quanly/themmoi_cvht/{{$lop -> id}}" method="post">
        @csrf
        <div class="col-sm-7">
            <br>
            <label>Họ tên: </label>
            <input class="form-control" id="hoten" name="hoten">
            <br>
            <label>Tên đăng nhập: </label>
            <input class="form-control" id="tendn" name="tendn">
            <br>
            <label>Mật khẩu: </label>
            <input class="form-control" id="password" name="password">
            <br>
            <label>Email: </label>
            <input class="form-control" id="email" name="email">
            <br>
            <label>SĐT: </label>
            <input class="form-control" id="sdt" name="sdt">
            <br>
            <label>Ngày sinh: </label>
            <input class="form-control" name="ngaysinh" type="date" id="example-date-input">
            <br>
            <button type="submit" class="btn btn-default">Thêm</button>
        </div>
    </form>
    <div class="col-sm-5" hidden>
        <br>
        <form action="/doan3/public/admin/quanly/chonlai_cvht/{{$lop -> id}}" method="post">
            @csrf
        <select class="form-control" id="chon_cvht" name="chon_cvht">
            <option value="0">Chọn</option>
            @foreach($cvht_khonglop as $cvkl)
            <option value="{{$cvkl -> id}}">{{$cvkl -> hoten}}</option>
                @endforeach
        </select>
        <div id="thongtin_cvht">


        </div>
        </form>
    </div>
</div>
<div class="container-fluid footer">
    <h5>Copyright &copy; 2015</h5>
</div>
<script>
    $(document).ready(function () {
        $('#chon_cvht').change(function () {
            var idcvht = $(this).val();
            $.get('/doan3/public/admin/ajax/choncvht/'+ idcvht,function (data) {
                $('#thongtin_cvht').
                html(data)
            })
        });
        $('#chuyendoi').click(function () {
                $('.col-sm-7').toggle();
            $('.col-sm-5').toggle();
            })
        });
</script>