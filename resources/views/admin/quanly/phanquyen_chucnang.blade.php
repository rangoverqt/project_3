<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 01/01/19
 * Time: 7:42 PM
 */
?>
@include('layout/header_admin')
<div class="container">
    @if(session('thongbao'))
        <div class="alert alert-success">
        {{session('thongbao')}}
        </div>
        @endif
        @if(count($errors)>0)
            <div class="alert alert-danger">
                @foreach($errors -> all() as $err)
                    {{$err}} <br>
                @endforeach
            </div>
        @endif
    <div class="turnback">
        <a href="/doan3/public/admin/quanly/phienphanquyen/{{$admin -> id}}">Trở về</a>
    </div>
        <div class="turnback">
            <a href="/doan3/public/admin/quanly/xoa_phienlamviec/{{$admin -> id}}"
               style="margin-right: 20px">Xóa phiên làm việc</a>
        </div>
    <div class="tt_hk">
        <p><strong>Học kỳ: </strong>{{$hocky -> hocky}}</p>
        <p><strong>Năm học: </strong>{{$hocky -> namhoc -> namhoc}}</p>
    </div>
    <div class="bang1">
        <form action="/doan3/public/admin/quanly/phanquyen_chucnang/{{$hocky -> id}}" method="post">
            @csrf
        <table class="table table1 table-striped table-hover table-bordered">
            <thead>
            <tr>
                <th>STT</th>
                <th>Tên chức năng</th>
                <th>Chú thích</th>
                <th>Nhóm người dùng</th>
                <th>Phân quyền</th>
            </tr>
            </thead>
            <?php
            $no = 1;
            $check = 1;
            ?>
            <tbody>
            @if($hocvien -> id_chucnang_hk != null && $loptruong -> id_chucnang_hk != null)
                <tr>
                    <td id="diem"></td>
                    <td id="diem">Tự chấm</td>
                    <td id="diem">Chức năng tự chấm đang hiện hành</td>
                    <td id="diem">Sinh viên</td>
                    <td id="diem"><a href="/doan3/public/admin/quanly/dongphanquyen_tucham/{{$hocky -> id}}">Đóng phân quyền</a></td>
                </tr>
                @elseif($loptruong -> id_chucnang_hk != null)
                <tr>
                    <td id="diem"></td>
                    <td id="diem">Chấm lần 1</td>
                    <td id="diem">Chức năng chấm lần 1 đang hiện hành</td>
                    <td id="diem">Lớp trưởng</td>
                    <td id="diem"><a href="/doan3/public/admin/quanly/dongphanquyen_chamlan1/{{$hocky -> id}}">Đóng phân quyền</a></td>
                </tr>
                @elseif($cvht -> id_chucnang_hk != null)
                <tr>
                    <td id="diem"></td>
                    <td id="diem">Chấm lần 2</td>
                    <td id="diem">Chức năng chấm lần 2 đang hiện hành</td>
                    <td id="diem">Cố vấn học tập</td>
                    <td id="diem"><a href="/doan3/public/admin/quanly/dongphanquyen_chamlan2/{{$hocky -> id}}">Đóng phân quyền</a></td>
                </tr>
                @elseif($hocvien -> id_chucnang_hk != null)
                <tr>
                    <td id="diem"></td>
                    <td id="diem">Yêu cầu</td>
                    <td id="diem">Chức năng yêu cầu đang hiện hành</td>
                    <td id="diem">Sinh viên</td>
                    <td id="diem"><a href="/doan3/public/admin/quanly/dongphanquyen_yeucau/{{$hocky -> id}}">Đóng phân quyền</a></td>
                </tr>
            @elseif($cvht -> id_chucnang_hk != null)
                <tr>
                    <td id="diem"></td>
                    <td id="diem">Yêu cầu</td>
                    <td id="diem">Chức năng xem yêu cầu đang hiện hành</td>
                    <td id="diem">Cố vấn học tập</td>
                    <td id="diem"><a href="/doan3/public/admin/quanly/dongphanquyen_xemyeucau/{{$hocky -> id}}">Đóng phân quyền</a></td>
                </tr>
            @else
            @foreach($chucnang as $cn)
                    <tr>
                <td id="diem">{{$no++}}</td>
                <td id="diem">{{$cn -> ten_chucnang}}</td>
                    @if($check == 1)
                        <td id="diem">Kích hoạt tự chấm</td>
                        <td id="diem">Sinh viên</td>
                        <td id="diem"><input id="chucnang1" name="chucnang" type="checkbox" value="{{$cn -> id}}">
                            </td>
                    @elseif($check == 2)
                        <td id="diem">Kích hoạt chấm lần 1</td>
                        <td id="diem">Lớp trưởng</td>
                        <td id="diem"><input id="chucnang2" name="chucnang" type="checkbox" value="{{$cn -> id}}">
                            </td>
                    @elseif($check == 3)
                        <td id="diem">Kích hoạt chấm lần 2</td>
                        <td id="diem">Cố vấn học tập</td>
                        <td id="diem"><input id="chucnang3" name="chucnang" type="checkbox" value="{{$cn -> id}}">
                            </td>
                    @elseif($check == 4)
                        <td id="diem">Kích hoạt yêu cầu</td>
                        <td id="diem">Sinh viên</td>
                        <td id="diem"><input id="chucnang4" name="chucnang" type="checkbox" value="{{$cn -> id}}">
                           </td>
                        @elseif($check == 5)
                            <td id="diem">Kích hoạt xem yêu cầu</td>
                            <td id="diem">Cố vấn học tập</td>
                            <td id="diem"><input id="chucnang5" name="chucnang" type="checkbox" value="{{$cn -> id}}">
                            </td>
                    @endif
                    <?php $check++ ?>
                </tr>
                @endforeach
                        @endif
            </tbody>
        </table>
            @if($hocvien -> id_chucnang_hk != null && $loptruong -> id_chucnang_hk != null)

                @else
        <input type="submit" value="Xác nhận">
                @endif
        </form>
    </div>
    <div class="bang1">
        <h4>Các phần quyền từng thực hiện</h4>
        <table class="table table1 table-hover table-striped table-bordered">
        <thead>
        <tr>
            <th>STT</th>
            <th>Tên chức năng</th>
        </tr>
        </thead>
            <?php $no = 1; ?>
            <tbody>
            @if($chucnang_hk == 'k')
                <tr>
                    <td id="diem">Chưa có phân quyền thực thi</td>
                </tr>
                @else
            @foreach($chucnang_hk as $cn)
            <tr>
                <td id="diem">{{$no++}}</td>
                <td id="diem">{{$cn -> chucnang -> ten_chucnang}}</td>
            </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<div class="container-fluid footer">
    <h5>Copyright &copy; 2015</h5>
</div>
<script>
    $(document).ready(function(){
        $('#chucnang1').on('change', function(){
            if($('#chucnang1:checked').length){
                $('#chucnang2').prop({ disabled: true, checked: false});
                $('#chucnang3').prop({ disabled: true, checked: false});
                $('#chucnang4').prop({ disabled: true, checked: false});
                $('#chucnang5').prop({ disabled: true, checked: false});
                return;
            }
            else {
                $('#chucnang2').prop('disabled', false);
                $('#chucnang3').prop('disabled', false);
                $('#chucnang4').prop('disabled', false);
                $('#chucnang5').prop('disabled', false);
            }
        });
        $('#chucnang2').on('change', function(){
            if($('#chucnang2:checked').length){
                $('#chucnang1').prop({ disabled: true, checked: false});
                $('#chucnang3').prop({ disabled: true, checked: false});
                $('#chucnang4').prop({ disabled: true, checked: false});
                $('#chucnang5').prop({ disabled: true, checked: false});
                return;
            }
            else {
                $('#chucnang1').prop('disabled', false);
                $('#chucnang3').prop('disabled', false);
                $('#chucnang4').prop('disabled', false);
                $('#chucnang5').prop('disabled', false);
            }
        });
        $('#chucnang3').on('change', function(){
            if($('#chucnang3:checked').length){
                $('#chucnang2').prop({ disabled: true, checked: false});
                $('#chucnang1').prop({ disabled: true, checked: false});
                $('#chucnang4').prop({ disabled: true, checked: false});
                $('#chucnang5').prop({ disabled: true, checked: false});
                return;
            }
            else {
                $('#chucnang2').prop('disabled', false);
                $('#chucnang1').prop('disabled', false);
                $('#chucnang4').prop('disabled', false);
                $('#chucnang5').prop('disabled', false);
            }
        });
        $('#chucnang4').on('change', function(){
            if($('#chucnang4:checked').length){
                $('#chucnang2').prop({ disabled: true, checked: false});
                $('#chucnang1').prop({ disabled: true, checked: false});
                $('#chucnang3').prop({ disabled: true, checked: false});
                $('#chucnang5').prop({ disabled: true, checked: false});
                return;
            }
            else {
                $('#chucnang2').prop('disabled', false);
                $('#chucnang1').prop('disabled', false);
                $('#chucnang3').prop('disabled', false);
                $('#chucnang5').prop('disabled', false);
            }
        });
        $('#chucnang5').on('change', function(){
            if($('#chucnang5:checked').length){
                $('#chucnang2').prop({ disabled: true, checked: false});
                $('#chucnang1').prop({ disabled: true, checked: false});
                $('#chucnang3').prop({ disabled: true, checked: false});
                $('#chucnang4').prop({ disabled: true, checked: false});
                return;
            }
            else {
                $('#chucnang2').prop('disabled', false);
                $('#chucnang1').prop('disabled', false);
                $('#chucnang3').prop('disabled', false);
                $('#chucnang4').prop('disabled', false);
            }
        });
    })
</script>