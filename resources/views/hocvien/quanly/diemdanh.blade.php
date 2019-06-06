<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 08/12/18
 * Time: 9:57 AM
 */
?>
@include('layout/header')
<div class="container">
    <div class="turnback">
        <a href="/doan3/public/hocvien/loptruong/hoatdong/{{$hoatdong -> id_lop}}">Trở về</a>
    </div>
    <div class="tt_hk">
        <h4>Trang điểm danh</h4>
        <h5>Hoạt động: {{$hoatdong -> hoatdong -> ten_hoatdong}}</h5>
        <h5>Năm học: {{$hoatdong -> hocky -> namhoc -> namhoc}}</h5>
        <h5>Học kỳ: {{$hoatdong -> hocky -> hocky}}</h5>
        <h5>Lớp: {{$hoatdong -> lop -> ten_lop}}</h5>
    </div>
    <div class="danhsach">
        <h5>Danh sách học viên</h5>
        <form action="/doan3/public/hocvien/loptruong/diemdanh/{{$hoatdong -> hoatdong -> id}}" method="post">
            @csrf
        <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>STT</th>
            <th>Họ tên</th>
            <th>MSSV</th>
            <th>Ngày sinh</th>
            <th>Điểm</th>
        </tr>
        </thead>
            <tbody>
            <?php
            $no = 1;
            ?>
            @foreach($hocvien as $hv)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$hv-> hoten}}</td>
                <td>{{$hv->mssv}}</td>
                <td>{{$hv->ngay_sinh}}</td>
                <td>
                    <label><input type="checkbox" name="id_hocvien[{{$hoatdong->hoatdong->id}}][]" value="{{$hv -> id}}"></label>
                </td>
                {{--<td>--}}
                    {{--<label><input hidden type="text" name="id_hoatdong[]"--}}
                                  {{--value="{{$hoatdong -> hoatdong -> id}}">{{$hoatdong -> hoatdong -> id}}</label>--}}
                {{--</td>--}}
            </tr>
                @endforeach
            </tbody>
        </table>
            <input style="float: right" type="submit" name="button" value="Điểm danh" id="button">
        </form>
    </div>
</div>
<div class="container-fluid footer">
    <h5>Copyright &copy; 2015</h5>
</div>