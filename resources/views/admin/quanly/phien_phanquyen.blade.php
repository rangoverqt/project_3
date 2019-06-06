<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 01/01/19
 * Time: 1:42 PM
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
        <a href="/doan3/public/admin/trangchu/{{$admin -> id}}">Trở về</a>
    </div>
<div class="tt_hk">
    <h4>Phiên phân quyền</h4>
</div>
    @if($phienlamviec_check > 0)
        <h4>Phiên phân quyền đã lưu</h4>
    <div class="bang1">
        <table class="table table1 table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>Phiên làm việc đang hiện hành</th>
                <th>Học kỳ</th>
                <th>Năm học</th>
                <th>Xem</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td id="diem">Đang hiện hành</td>
                <td id="diem">{{$phienlamviec -> hocky -> hocky}}</td>
                <td id="diem">{{$phienlamviec -> namhoc -> namhoc}}</td>
                <td id="diem"><a href="/doan3/public/admin/quanly/phanquyen_chucnang/{{$phienlamviec -> id_hocky}}">Xem</a></td>
            </tr>
            </tbody>
        </table>
    </div>
    @else
    <div class="form-group">
        <label>Chọn năm học:</label>
    <select class="form-control" id="namhoc">
        <option value="0">Chọn</option>
        @foreach($namhoc as $nh)
        <option value="{{$nh -> id}}">{{$nh -> namhoc}}</option>
            @endforeach
    </select>
        <br>
        <label>Chọn học kỳ</label>
        <select class="form-control" id="hocky">

        </select>
        <div id="xacnhan">

        </div>
    </div>
        @endif
</div>
<div class="container-fluid footer">
    <h5>Copyright &copy; 2015</h5>
</div>
<script>
    $(document).ready(function () {
        $('#namhoc').change(function () {
            var idnamhoc = $(this).val();
            $.get('/doan3/public/admin/ajax/chonnamhoc/'+ idnamhoc,function (data) {
                $('#hocky').
                html(data)
            })
        })
    })
</script>
<script>
    $(document).ready(function () {
        $('#hocky').change(function () {
            var idhocky = $(this).val();
            $.get('/doan3/public/admin/ajax/chonhocky/'+ idhocky,function (data) {
                $('#xacnhan').
                html(data)
            })
        })
    })
</script>