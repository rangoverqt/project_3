<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 29/12/18
 * Time: 11:19 PM
 */
?>
@include('layout/header_admin')
<div class="container">
    @if(session('thongbao'))
        <div class="alert alert-success">
            {{session('thongbao')}}
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
    <div class="bang1">
        <h4>Cố vấn học tập</h4>
        @if($cvht == 'k')
            <div class="turnback">
                <a href="/doan3/public/admin/quanly/them_cvht/{{$lop -> id}}">Thêm</a>
            </div>
            @else

            @endif
        <table class="table table1 table-hover table-bordered table-striped">
            <thead>
            <tr>
                <th>Họ tên</th>
                <th>Email</th>
                <th>SĐT</th>
                <th>Ngày sinh</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
            </thead>
            <tbody>
            @if($cvht == 'k')
            <tr>
                <td>Lớp chưa có cố vấn học tập</td>
            </tr>
                @else
                @foreach($cvht as $cv)
                <tr>
                    <td id="diem">{{$cv -> hoten}}</td>
                    <td id="diem">{{$cv -> email}}</td>
                    <td id="diem">{{$cv -> sdt}}</td>
                    <td id="diem">{{$cv -> ngay_sinh}}</td>
                    <td id="diem"><a href="/doan3/public/admin/quanly/sua_cvht/{{$lop -> id}}">Sửa</a></td>
                    <td id="diem"><a href="/doan3/public/admin/quanly/xoa_cvht/{{$lop -> id}}">Xóa</a></td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div class="bang1">
        <div class="turnback">
            <a href="/doan3/public/admin/quanly/them_hv/{{$lop -> id}}">Thêm</a>
        </div>
        <h4>Danh sách sinh viên</h4>
        <table class="table table1 table-hover table-bordered table-striped">
            <thead>
            <tr>
                <th>STT</th>
                <th>MSSV</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>SĐT</th>
                <th>Ngày sinh</th>
                <th>Chức vụ</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            ?>
            @foreach($hocvien as $hv)
            <tr>
                <td id="diem">{{$no++}}</td>
                <td id="diem">{{$hv -> mssv}}</td>
                <td>{{$hv -> hoten}}</td>
                <td>{{$hv -> email}}</td>
                <td id="diem">{{$hv -> sdt}}</td>
                <td id="diem">{{$hv -> ngay_sinh}}</td>
                <td id="diem">
                    @if($hv -> id_chucvu == 2)
                    Lớp trưởng
                        @else
                    Sinh viên
                        @endif
                </td>
                <td id="diem"><a href="/doan3/public/admin/quanly/suatt_hv/{{$hv -> id}}">Sửa</a></td>
                <td id="diem"><a href="/doan3/public/admin/quanly/xoa_hv/{{$hv -> id}}">Xóa</a></td>
            </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="container-fluid footer">
    <h5>Copyright &copy; 2015</h5>
</div>