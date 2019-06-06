<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 08/12/18
 * Time: 11:46 AM
 */
?>
@include('layout/header')
@if(session('thongbao'))
    <div class="alert alert-success">
        {{session('thongbao')}}
    </div>
@endif
<div class="container">
    <div class="turnback">
        <a href="/doan3/public/hocvien/loptruong/hoatdong/{{$namhoc -> id_lop}}">Trở về</a>
    </div>
    @if($hd -> thanh_tich == 1 && $thanhtich <= 0)
        <div class="turnback">
            <a style="margin-right: 20px" href="/doan3/public/hocvien/loptruong/themthanhtich/{{$hd -> id}}">
                Thêm thành tích</a>
        </div>
        @elseif($hd -> thanh_tich == 0)

        @else
        <div class="turnback">
            <a style="margin-right: 20px" href="/doan3/public/hocvien/loptruong/suathanhtich/{{$hd -> id}}">
                Sửa thành tích</a>
        </div>
        @endif
    <div class="tt_hk">
        <h4>Trang xem danh sách điểm danh</h4>
        <h5>Hoạt động: {{$hoatdong -> hoatdong -> ten_hoatdong}}</h5>
        <h5>Năm học: {{$namhoc -> hocky -> namhoc -> namhoc}}</h5>
        <h5>Học kỳ: {{$namhoc -> hocky -> hocky}}</h5>
        <h5>Lớp: {{$namhoc -> lop -> ten_lop}}</h5>
    </div>
    <div class="turnback">
        <a href="/doan3/public/hocvien/loptruong/suadiemdanh/{{$hoatdong -> id_hoatdong}}">Điểm danh lại</a>
    </div>
    <table class="table table-hover table-striped table-bordered" style="margin-top: 20px">
        <thead>
        <tr>
            <th>STT</th>
            <th>Họ tên</th>
            <th>MSSV</th>
            <th>Ngày sinh</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $no =1;
        ?>
        @foreach($hocvien as $hv)
        <tr>
            <td>{{$no++}}</td>
            <td>{{$hv -> hocvien -> hoten}}</td>
            <td>{{$hv -> hocvien -> mssv}}</td>
            <td>{{$hv -> hocvien -> ngay_sinh}}</td>
        </tr>
            @endforeach
        </tbody>
    </table>
    @if($thanhtich > 0)
        <a class="turnback" href=""></a>
        <h5>Bảng thành tích</h5>
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>STT</th>
                <th>Họ tên</th>
                <th>MSSV</th>
                <th>Ngày sinh</th>
                <th>Thành tích</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no1 = 1;
            ?>
        @foreach($xem as $xe)
            <tr>
                <td>{{$no1++}}</td>
                <td>{{$xe -> hocvien -> hoten}}</td>
                <td>{{$xe -> hocvien -> mssv}}</td>
                <td>{{$xe -> hocvien -> ngay_sinh}}</td>
                <td>
                    @if($xe -> hang == 1)
                        Hạng nhất
                    @elseif($xe -> hang == 2)
                        Hạng hai
                    @elseif($xe -> hang == 3)
                        Hạng ba
                    @else
                        Hạng tư
                        @endif
                </td>
            </tr>
            @endforeach
        @endif
            </tbody>
        </table>
</div>
<div class="container-fluid footer">
    <h5>Copyright &copy; 2015</h5>
</div>
