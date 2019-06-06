<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 28/12/18
 * Time: 7:42 AM
 */
?>
@include('layout/header')
<div class="container">
    @if(session('thongbao'))
        <div class="alert alert-success">
        {{session('thongbao')}}
        </div>
    @else
        @endif
    <div class="turnback">
        <a href="/doan3/public/hocvien/bangdiem/xemchitiet/{{$bangdiem_lan1 -> id}}">Trở về</a>
    </div>
        <div class="turnback">
            <a href="/doan3/public/hocvien/bangdiem/suayeucau/{{$bangdiem_lan1 -> id}}" style="margin-right: 20px">
                Sửa bảng yêu cầu</a>
        </div>
    <div class="tt_sv">
        <h5>Thông tin học viên:</h5>
        <p><strong>Mã số sinh viên: </strong>{{$bangdiem_lan1 -> hocvien -> mssv}}</p>
        <p><strong>Họ tên: </strong>{{$bangdiem_lan1 -> hocvien -> hoten}}</p>
        <p><strong>Lớp: </strong>{{$bangdiem_lan1 -> hocvien -> lop -> ten_lop}}</p>
    </div>
    <div class="tt_hk">
        <p><strong>Học kỳ: </strong>{{$bangdiem_lan1 -> hocky -> hocky}}</p>
        <p><strong>Năm học: </strong>{{$bangdiem_lan1 -> hocky -> namhoc -> namhoc}}</p>
    </div>
<div class="bang1">
<table class="table table1 table-bordered table-hover table-striped">
    <h5>Các phần yêu cầu xem xét</h5>
    <thead>
    <tr>
        <th>Mục yêu cầu</th>
        <th>Điểm được cho</th>
        <th>Có yêu cầu</th>
        <th>Lý do</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        @if($bangdiem_yeucau -> p1_a_1 == null)
        <td>Đi học đầy đủ, đúng giờ, đúng giờ, nghiêm túc trong giờ học</td>
        @else
            <td style="color: red">Đi học đầy đủ, đúng giờ, đúng giờ, nghiêm túc trong giờ học</td>
        @endif
        <td id="diem">
            @if($bangdiem_chitiet_lan1 -> p1_a_1 == null)
                0
                @else
                {{$bangdiem_chitiet_lan1 -> p1_a_1}}
                @endif
        </td>
        <td id="diem">
            @if($bangdiem_yeucau -> p1_a_1 == 1)
                Có
                @else
                    Không
                @endif
        </td>
        <td id="diem">
            @if($lydo_yeucau -> p1_a_1 != null)
            {{$lydo_yeucau -> p1_a_1}}
                @else
                    Không có lý do
                @endif
        </td>
    </tr>
    <tr>
        @if($bangdiem_yeucau -> p1_a_2 == null)
        <td>Không vi phạm quy chế về thi, kiểm tra</td>
        @else
        <td style="color: red;">Không vi phạm quy chế về thi, kiểm tra</td>
            @endif
        <td id="diem">
            @if($bangdiem_chitiet_lan1 -> p1_a_2 == null)
                0
                @else
            {{$bangdiem_chitiet_lan1 -> p1_a_2}}
                @endif
        </td>
        <td id="diem">
            @if($bangdiem_yeucau -> p1_a_2 == 1)
                Có
                @else
            Không
                @endif
        </td>
        <td id="diem">
            @if($lydo_yeucau -> p1_a_2 != null)
                {{$lydo_yeucau -> p1_a_2}}
                @else
            Không có lý do
                @endif
        </td>
    </tr>
    <tr>
        @if($bangdiem_yeucau -> p1_a_3 == null)
            <td>Kết quả học tập trong học kỳ: Điểm trung bình chung học kỳ (ĐTBCHK)</td>
        @else
            <td style="color: red;">Kết quả học tập trong học kỳ: Điểm trung bình chung học kỳ (ĐTBCHK)</td>
        @endif
        <td id="diem">
            @if($bangdiem_chitiet_lan1 -> p1_a_3 == null)
                0
            @else
                {{$bangdiem_chitiet_lan1 -> p1_a_3}}
            @endif
        </td>
        <td id="diem">
            @if($bangdiem_yeucau -> p1_a_3 == 1)
                Có
            @else
                Không
            @endif
        </td>
        <td id="diem">
            @if($lydo_yeucau -> p1_a_3 != null)
                {{$lydo_yeucau -> p1_a_3}}
            @else
                Không có lý do
            @endif
        </td>
    </tr>
    <tr>
        @if($bangdiem_yeucau -> p1_a_4 == null)
            <td>Có cố gắng, vượt khó trong học tập (có ĐTB học kỳ sau lớn hơn học kỳ trước đó; đối với<br>
                SV năm thứ nhất, học kỳ I không có điểm F)</td>
        @else
            <td style="color: red;">Có cố gắng, vượt khó trong học tập (có ĐTB học kỳ sau lớn hơn học kỳ trước đó; đối với<br>
                SV năm thứ nhất, học kỳ I không có điểm F)</td>
        @endif
        <td id="diem">
            @if($bangdiem_chitiet_lan1 -> p1_a_4 == null)
                0
            @else
                {{$bangdiem_chitiet_lan1 -> p1_a_4}}
            @endif
        </td>
        <td id="diem">
            @if($bangdiem_yeucau -> p1_a_4 == 1)
                Có
            @else
                Không
            @endif
        </td>
        <td id="diem">
            @if($lydo_yeucau -> p1_a_4 != null)
                {{$lydo_yeucau -> p1_a_4}}
            @else
                Không có lý do
            @endif
        </td>
    </tr>
    <tr>
        @if($bangdiem_yeucau -> chungchi_a == null)
            <td>Chứng chỉ A (Tin học hoặc Anh văn)</td>
        @else
            <td style="color: red;">Chứng chỉ A (Tin học hoặc Anh văn)</td>
        @endif
        <td id="diem">
            @if($bangdiem_chitiet_lan1 -> chungchi_a == null)
                0
            @else
                {{$bangdiem_chitiet_lan1 -> chungchi_a}}
            @endif
        </td>
        <td id="diem">
            @if($bangdiem_yeucau -> chungchi_a == 1)
                Có
            @else
                Không
            @endif
        </td>
        <td id="diem">
            @if($lydo_yeucau -> chungchi_a != null)
                {{$lydo_yeucau -> chungchi_a}}
            @else
                Không có lý do
            @endif
        </td>
    </tr>
    <tr>
        @if($bangdiem_yeucau -> chungchi_b == null)
            <td>Chứng chỉ B (Tin học hoặc Anh văn)</td>
        @else
            <td style="color: red;">Chứng chỉ B (Tin học hoặc Anh văn)</td>
        @endif
        <td id="diem">
            @if($bangdiem_chitiet_lan1 -> chungchi_b == null)
                0
            @else
                {{$bangdiem_chitiet_lan1 -> chungchi_b}}
            @endif
        </td>
        <td id="diem">
            @if($bangdiem_yeucau -> chungchi_b == 1)
                Có
            @else
                Không
            @endif
        </td>
        <td id="diem">
            @if($lydo_yeucau -> chungchi_b != null)
                {{$lydo_yeucau -> chungchi_b}}
            @else
                Không có lý do
            @endif
        </td>
    </tr>
    <tr>
        @if($bangdiem_yeucau -> chungchi_a == null)
            <td>Chứng chỉ C (Tin học hoặc Anh văn)</td>
        @else
            <td style="color: red;">Chứng chỉ C (Tin học hoặc Anh văn)</td>
        @endif
        <td id="diem">
            @if($bangdiem_chitiet_lan1 -> chungchi_c == null)
                0
            @else
                {{$bangdiem_chitiet_lan1 -> chungchi_c}}
            @endif
        </td>
        <td id="diem">
            @if($bangdiem_yeucau -> chungchi_c == 1)
                Có
            @else
                Không
            @endif
        </td>
        <td id="diem">
            @if($lydo_yeucau -> chungchi_c != null)
                {{$lydo_yeucau -> chungchi_c}}
            @else
                Không có lý do
            @endif
        </td>
    </tr>
    <tr>
        @if($bangdiem_yeucau -> toeic == null)
            <td>Toeic 450</td>
        @else
            <td style="color: red;">Toeic 450</td>
        @endif
        <td id="diem">
            @if($bangdiem_chitiet_lan1 -> toeic == null)
                0
            @else
                {{$bangdiem_chitiet_lan1 -> toeic}}
            @endif
        </td>
        <td id="diem">
            @if($bangdiem_yeucau -> toeic == 1)
                Có
            @else
                Không
            @endif
        </td>
        <td id="diem">
            @if($lydo_yeucau -> toeic != null)
                {{$lydo_yeucau -> toeic}}
            @else
                Không có lý do
            @endif
        </td>
    </tr>
    <tr>
        @if($bangdiem_yeucau -> p2_1 == null)
            <td>Không vi phạm và có ý thức tham gia thực hiện nghiêm túc các quy định của Lớp, nội quy,<br>
                quy chế của Trường, Khoa và các tổ chức trong nhà trường</td>
        @else
            <td style="color: red;">Không vi phạm và có ý thức tham gia thực hiện nghiêm túc các quy định của Lớp, nội quy,<br>
                quy chế của Trường, Khoa và các tổ chức trong nhà trường</td>
        @endif
        <td id="diem">
            @if($bangdiem_chitiet_lan1 -> p2_1 == null)
                0
            @else
                {{$bangdiem_chitiet_lan1 -> p2_1}}
            @endif
        </td>
        <td id="diem">
            @if($bangdiem_yeucau -> p2_1 == 1)
                Có
            @else
                Không
            @endif
        </td>
        <td id="diem">
            @if($lydo_yeucau -> p2_1 != null)
                {{$lydo_yeucau -> p2_1}}
            @else
                Không có lý do
            @endif
        </td>
    </tr>
    <tr>
        @if($bangdiem_yeucau -> p2_2_1 == null)
            <td>Giữ gìn an ninh, trật tự nơi công cộng</td>
        @else
            <td style="color: red;">Giữ gìn an ninh, trật tự nơi công cộng</td>
        @endif
        <td id="diem">
            @if($bangdiem_chitiet_lan1 -> p2_2_1 == null)
                0
            @else
                {{$bangdiem_chitiet_lan1 -> p2_2_1}}
            @endif
        </td>
        <td id="diem">
            @if($bangdiem_yeucau -> p2_2_1 == 1)
                Có
            @else
                Không
            @endif
        </td>
        <td id="diem">
            @if($lydo_yeucau -> p2_2_1 != null)
                {{$lydo_yeucau -> p2_2_1}}
            @else
                Không có lý do
            @endif
        </td>
    </tr>
    <tr>
        @if($bangdiem_yeucau -> p2_2_2 == null)
            <td>Giữ gìn vệ sinh, bảo vệ cảnh quan môi trường, nếp sống văn minh<br>
                (có xác nhận của đoàn thể, Khoa, Trường...)</td>
        @else
            <td style="color: red;">Giữ gìn vệ sinh, bảo vệ cảnh quan môi trường, nếp sống văn minh<br>
                (có xác nhận của đoàn thể, Khoa, Trường...)</td>
        @endif
        <td id="diem">
            @if($bangdiem_chitiet_lan1 -> p2_2_2 == null)
                0
            @else
                {{$bangdiem_chitiet_lan1 -> p2_2_2}}
            @endif
        </td>
        <td id="diem">
            @if($bangdiem_yeucau -> p2_2_2 == 1)
                Có
            @else
                Không
            @endif
        </td>
        <td id="diem">
            @if($lydo_yeucau -> p2_2_2 != null)
                {{$lydo_yeucau -> p2_2_2}}
            @else
                Không có lý do
            @endif
        </td>
    </tr>
    <tr>
        @if($bangdiem_yeucau -> p3_1 == null)
            <td>Tham gia đầy đủ các hoạt động chính trị, xã hội, văn hóa, văn nghệ, thể thao các cấp<br>
                từ Lớp, Chi hội, Chi đoàn trở lên tổ chức</td>
        @else
            <td style="color: red;">Tham gia đầy đủ các hoạt động chính trị, xã hội, văn hóa, văn nghệ, thể thao các cấp<br>
                từ Lớp, Chi hội, Chi đoàn trở lên tổ chức</td>
        @endif
        <td id="diem">
            @if($bangdiem_chitiet_lan1 -> p3_1 == null)
                0
            @else
                {{$bangdiem_chitiet_lan1 -> p3_1}}
            @endif
        </td>
        <td id="diem">
            @if($bangdiem_yeucau -> p3_1 == 1)
                Có
            @else
                Không
            @endif
        </td>
        <td id="diem">
            @if($lydo_yeucau -> p3_1 != null)
                {{$lydo_yeucau -> p3_1}}
            @else
                Không có lý do
            @endif
        </td>
    </tr>
    <tr>
        @if($bangdiem_yeucau -> p3_2_1 == null)
            <td>Là lực lượng nòng cốt: Cấp Chi đoàn, Chi hội, Đội, Nhóm, Câu lạc bộ</td>
        @else
            <td style="color: red;">Là lực lượng nòng cốt: Cấp Chi đoàn, Chi hội, Đội, Nhóm, Câu lạc bộ</td>
        @endif
        <td id="diem">
            @if($bangdiem_chitiet_lan1 -> p3_2_1 == null)
                0
            @else
                {{$bangdiem_chitiet_lan1 -> p3_2_1}}
            @endif
        </td>
        <td id="diem">
            @if($bangdiem_yeucau -> p3_2_1 == 1)
                Có
            @else
                Không
            @endif
        </td>
        <td id="diem">
            @if($lydo_yeucau -> p3_2_1 != null)
                {{$lydo_yeucau -> p3_2_1}}
            @else
                Không có lý do
            @endif
        </td>
    </tr>
    <tr>
        @if($bangdiem_yeucau -> p3_2_2 == null)
            <td>Là lực lượng nòng cốt: Cấp Khoa (và tương đương), Trường</td>
        @else
            <td style="color: red;">Là lực lượng nòng cốt: Cấp Khoa (và tương đương), Trường</td>
        @endif
        <td id="diem">
            @if($bangdiem_chitiet_lan1 -> p3_2_2 == null)
                0
            @else
                {{$bangdiem_chitiet_lan1 -> p3_2_2}}
            @endif
        </td>
        <td id="diem">
            @if($bangdiem_yeucau -> p3_2_2 == 1)
                Có
            @else
                Không
            @endif
        </td>
        <td id="diem">
            @if($lydo_yeucau -> p3_2_2 != null)
                {{$lydo_yeucau -> p3_2_2}}
            @else
                Không có lý do
            @endif
        </td>
    </tr>
    <tr>
        @if($bangdiem_yeucau -> p3_3_1 == null)
            <td>Quyết định khen thưởng của Đoàn Khoa (và tương đương)</td>
        @else
            <td style="color: red;">Quyết định khen thưởng của Đoàn Khoa (và tương đương)</td>
        @endif
        <td id="diem">
            @if($bangdiem_chitiet_lan1 -> p3_3_1 == null)
                0
            @else
                {{$bangdiem_chitiet_lan1 -> p3_3_1}}
            @endif
        </td>
        <td id="diem">
            @if($bangdiem_yeucau -> p3_3_1 == 1)
                Có
            @else
                Không
            @endif
        </td>
        <td id="diem">
            @if($lydo_yeucau -> p3_3_1 != null)
                {{$lydo_yeucau -> p3_3_1}}
            @else
                Không có lý do
            @endif
        </td>
    </tr>
    <tr>
        @if($bangdiem_yeucau -> p3_3_2 == null)
            <td>Giấy khen cấp Trường</td>
        @else
            <td style="color: red;">Giấy khen cấp Trường</td>
        @endif
        <td id="diem">
            @if($bangdiem_chitiet_lan1 -> p3_3_2 == null)
                0
            @else
                {{$bangdiem_chitiet_lan1 -> p3_3_2}}
            @endif
        </td>
        <td id="diem">
            @if($bangdiem_yeucau -> p3_3_2 == 1)
                Có
            @else
                Không
            @endif
        </td>
        <td id="diem">
            @if($lydo_yeucau -> p3_3_2 != null)
                {{$lydo_yeucau -> p3_3_2}}
            @else
                Không có lý do
            @endif
        </td>
    </tr>
    <tr>
        @if($bangdiem_yeucau -> p3_3_3 == null)
            <td>Giấy khen cấp cao hơn</td>
        @else
            <td style="color: red;">Giấy khen cấp cao hơn</td>
        @endif
        <td id="diem">
            @if($bangdiem_chitiet_lan1 -> p3_3_3 == null)
                0
            @else
                {{$bangdiem_chitiet_lan1 -> p3_3_3}}
            @endif
        </td>
        <td id="diem">
            @if($bangdiem_yeucau -> p3_3_3 == 1)
                Có
            @else
                Không
            @endif
        </td>
        <td id="diem">
            @if($lydo_yeucau -> p3_3_3 != null)
                {{$lydo_yeucau -> p3_3_3}}
            @else
                Không có lý do
            @endif
        </td>
    </tr>
    <tr>
        @if($bangdiem_yeucau -> p4_1 == null)
            <td>Không vi phạm pháp luật của Nhà nước</td>
        @else
            <td style="color: red;">Không vi phạm pháp luật của Nhà nước</td>
        @endif
        <td id="diem">
            @if($bangdiem_chitiet_lan1 -> p4_1 == null)
                0
            @else
                {{$bangdiem_chitiet_lan1 -> p4_1}}
            @endif
        </td>
        <td id="diem">
            @if($bangdiem_yeucau -> p4_1 == 1)
                Có
            @else
                Không
            @endif
        </td>
        <td id="diem">
            @if($lydo_yeucau -> p4_1 != null)
                {{$lydo_yeucau -> p4_1}}
            @else
                Không có lý do
            @endif
        </td>
    </tr>
    <tr>
        @if($bangdiem_yeucau -> p4_2 == null)
            <td>Có tinh thần giúp đỡ bạn bè trong học tập, trong cuộc sống</td>
        @else
            <td style="color: red;">Có tinh thần giúp đỡ bạn bè trong học tập, trong cuộc sống</td>
        @endif
        <td id="diem">
            @if($bangdiem_chitiet_lan1 -> p4_2 == null)
                0
            @else
                {{$bangdiem_chitiet_lan1 -> p4_2}}
            @endif
        </td>
        <td id="diem">
            @if($bangdiem_yeucau -> p4_2 == 1)
                Có
            @else
                Không
            @endif
        </td>
        <td id="diem">
            @if($lydo_yeucau -> p4_2 != null)
                {{$lydo_yeucau -> p4_2}}
            @else
                Không có lý do
            @endif
        </td>
    </tr>
    <tr>
        @if($bangdiem_yeucau -> p4_3 == null)
            <td>Tham gia đội, nhóm, câu lạc bộ sinh hoạt hướng đến lợi ích cộng đồng<br>
                (tham gia công tác xã hội ở Trường, nơi cư trú, địa phương)</td>
        @else
            <td style="color: red;">Tham gia đội, nhóm, câu lạc bộ sinh hoạt hướng đến lợi ích cộng đồng<br>
                (tham gia công tác xã hội ở Trường, nơi cư trú, địa phương)</td>
        @endif
        <td id="diem">
            @if($bangdiem_chitiet_lan1 -> p4_3 == null)
                0
            @else
                {{$bangdiem_chitiet_lan1 -> p4_3}}
            @endif
        </td>
        <td id="diem">
            @if($bangdiem_yeucau -> p4_3 == 1)
                Có
            @else
                Không
            @endif
        </td>
        <td id="diem">
            @if($lydo_yeucau -> p4_3 != null)
                {{$lydo_yeucau -> p4_3}}
            @else
                Không có lý do
            @endif
        </td>
    </tr>
    <tr>
        @if($bangdiem_yeucau -> p5_1 == null)
            <td>Là Lớp trưởng, Bí thư Chi đoàn, Ủy viên BCH Đoàn Trường, Ủy viên Ban Chấp hành<br>
                Đoàn khoa, BCH Hội Sinh viên Trường, Liên Chi hội trưởng, Chi hội trưởng Hội Sinh viên,<br>
                Đội trưởng các Đội, Nhóm, Chủ nhiệm các Câu lạc bộ thuộc Hội Sinh viên Trường đã<br>
                hoàn thành nhiệm vụ được giao</td>
        @else
            <td style="color: red;">Là Lớp trưởng, Bí thư Chi đoàn, Ủy viên BCH Đoàn Trường, Ủy viên Ban Chấp hành<br>
                Đoàn khoa, BCH Hội Sinh viên Trường, Liên Chi hội trưởng, Chi hội trưởng Hội Sinh viên,<br>
                Đội trưởng các Đội, Nhóm, Chủ nhiệm các Câu lạc bộ thuộc Hội Sinh viên Trường đã<br>
                hoàn thành nhiệm vụ được giao</td>
        @endif
        <td id="diem">
            @if($bangdiem_chitiet_lan1 -> p5_1 == null)
                0
            @else
                {{$bangdiem_chitiet_lan1 -> p5_1}}
            @endif
        </td>
        <td id="diem">
            @if($bangdiem_yeucau -> p5_1 == 1)
                Có
            @else
                Không
            @endif
        </td>
        <td id="diem">
            @if($lydo_yeucau -> p5_1 != null)
                {{$lydo_yeucau -> p5_1}}
            @else
                Không có lý do
            @endif
        </td>
    </tr>
    <tr>
        @if($bangdiem_yeucau -> p5_2 == null)
            <td>Là thành viên của Ban Cán sự lớp, Ban Chấp hành chi đoàn, Ban Chấp hành Liên Chi hội<br>
                sinh viên, Chi hội sinh viên, Ban Chủ nhiệm các Đội, Nhóm, Câu lạc bộ (trừ các thành viên<br>
                nêu mục trên), đã hoàn thành nhiệm vụ được giao</td>
        @else
            <td style="color: red;">Là thành viên của Ban Cán sự lớp, Ban Chấp hành chi đoàn, Ban Chấp hành Liên Chi hội<br>
                sinh viên, Chi hội sinh viên, Ban Chủ nhiệm các Đội, Nhóm, Câu lạc bộ (trừ các thành viên<br>
                nêu mục trên), đã hoàn thành nhiệm vụ được giao</td>
        @endif
        <td id="diem">
            @if($bangdiem_chitiet_lan1 -> p5_2 == null)
                0
            @else
                {{$bangdiem_chitiet_lan1 -> p5_2}}
            @endif
        </td>
        <td id="diem">
            @if($bangdiem_yeucau -> p5_2 == 1)
                Có
            @else
                Không
            @endif
        </td>
        <td id="diem">
            @if($lydo_yeucau -> p5_2 != null)
                {{$lydo_yeucau -> p5_2}}
            @else
                Không có lý do
            @endif
        </td>
    </tr>
    <tr>
        @if($bangdiem_yeucau -> p5_3 == null)
            <td>Được kết nạp Đảng, hoặc được công nhận Đoàn viên ưu tú</td>
        @else
            <td style="color: red;">Được kết nạp Đảng, hoặc được công nhận Đoàn viên ưu tú</td>
        @endif
        <td id="diem">
            @if($bangdiem_chitiet_lan1 -> p5_3 == null)
                0
            @else
                {{$bangdiem_chitiet_lan1 -> p5_3}}
            @endif
        </td>
        <td id="diem">
            @if($bangdiem_yeucau -> p5_3 == 1)
                Có
            @else
                Không
            @endif
        </td>
        <td id="diem">
            @if($lydo_yeucau -> p5_3 != null)
                {{$lydo_yeucau -> p5_3}}
            @else
                Không có lý do
            @endif
        </td>
    </tr>
    </tbody>
</table>
</div>
</div>
<div class="container-fluid footer">
    <h5>Copyright &copy; 2015</h5>
</div>
