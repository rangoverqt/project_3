<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 06/12/18
 * Time: 8:25 PM
 */
?>
@include('layout/header')
<div class="container">
    <div class="turnback">
        <a href="/doan3/public/hocvien/loptruong/trangchu/{{$hocvien -> id}}">Trở về</a>
    </div>
<h4>Trang quản lý hoạt động</h4>
{{--{{$hocky}}--}}
{{--    {{$test}}--}}
    <div class="tt_hk">
        <h5>Lớp: {{$lop -> ten_lop}}</h5>
    </div>
    <h5>Chọn năm học</h5>
    <select class="form-control" name="namhoc" id="namhoc">
        <option value="0">Chọn</option>
        @foreach($namhoc as $nh)
        <option value="{{$nh -> namhoc -> id}}">{{$nh -> namhoc -> namhoc}}</option>
            @endforeach
    </select>
    <select id="hocky" class="form-control" style="margin-top: 20px">

    </select>
    <div id="hoatdong" style="margin-top: 20px">

    </div>
</div>
<div class="container-fluid footer">
    <h5>Copyright &copy; 2015</h5>
</div>
<script>
    $(document).ready(function () {
        $('#namhoc').change(function () {
            var idnamhoc = $(this).val();
            $.get('/doan3/public/hocvien/ajax/chonhocky/'+ idnamhoc,function (data) {
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
            $.get('/doan3/public/hocvien/ajax/chonhoatdong/'+ idhocky,function (data) {
                $('#hoatdong').
                html(data)
            })
        })
    })
</script>