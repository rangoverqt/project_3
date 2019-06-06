<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 29/12/18
 * Time: 10:35 PM
 */
?>
@include('layout/header_admin')
<div class="container">
    <div class="turnback">
        <a href="/doan3/public/admin/trangchu/{{$admin -> id}}">Trở về</a>
    </div>
    <div class="tt_sv">
        <h4>Thông tin admin</h4>
        <p><strong>Họ tên: </strong>{{$admin -> hoten}}</p>
        <p><strong>Email: </strong>{{$admin -> email}}</p>
        <p><strong>Ngày sinh: </strong>{{$admin -> ngay_sinh}}</p>
    </div>
    <br>
    <label>Chọn khoa</label>
    <select class="form-control" name="khoa" id="khoa">
        <option value="0">Chọn</option>
        @foreach($khoa as $kh)
            <option value="{{$kh -> id}}">{{$kh -> ten_khoa}}</option>
        @endforeach
    </select>
    <br>
    <label>Chọn ngành</label>
    <select id="nganh" class="form-control">

    </select>
    <div id="lop" style="margin-top: 20px">

    </div>
</div>
<div class="container-fluid footer">
    <h5>Copyright &copy; 2015</h5>
</div>
<script>
    $(document).ready(function () {
        $('#khoa').change(function () {
            var idkhoa = $(this).val();
            $.get('/doan3/public/admin/ajax/chonnganh/'+ idkhoa,function (data) {
                $('#nganh').
                html(data)
            })
        })
    })
</script>
<script>
    $(document).ready(function () {
        $('#nganh').change(function () {
            var idnganh = $(this).val();
            $.get('/doan3/public/admin/ajax/chonlop/'+ idnganh,function (data) {
                $('#lop').
                html(data)
            })
        })
    })
</script>