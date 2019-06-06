<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 20/12/18
 * Time: 11:00 PM
 */
?>
@include('layout/header')
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<div class="container">
    @if(session('thongbao'))
        <div class="alert alert-success">
            {{session('thongbao')}}
        </div>
    @endif
    <div class="turnback"><a href="/doan3/public/hocvien/loptruong/bangdiemlan1/{{$hocvien -> lop -> id}}">Trở về</a></div>
    <div class="turnback"><a style="margin-right: 20px" href="/doan3/public/hocvien/loptruong/suacham_lan1/{{$hocvien->id}}">Chấm lại</a></div>
    <div class="tt_sv">
        <h4>Thông tin sinh viên:</h4>
        <p><strong>Mã số sinh viên:</strong> {{$hocvien -> mssv}}</p>
        <p><strong>Họ tên:</strong> {{$hocvien -> hoten}}</p>
        <p><strong>Lớp:</strong> {{$hocvien -> lop -> ten_lop}}</p>
    </div>
    <div class="tt_hk">
        <p><strong>Năm học: </strong>{{$chucvu_hk -> hocky -> namhoc -> namhoc}}</p>
        <p><strong>Học kỳ: </strong>{{$chucvu_hk -> hocky -> hocky}}</p>
    </div>
    <div class="bang1">
        <table class="table table1 table-bordered table-hover" style="background-color: white">
            <thead>
            <tr>
                <th>Nội dung đánh giá</th>
                <th>Mức điểm</th>
                <th>Lớp trưởng cho điểm</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><strong>1. Đánh giá về ý thức học tập</strong> (Điều 5 – Quy chế đánh giá kết quả rèn luyện…)</td>
            </tr>
            <tr>
                <td><strong>a. Tinh thần thái độ và kết quả học tập</strong></td>
            </tr>
            <tr>
                <td>- Đi học đầy đủ, đúng giờ, nghiêm túc trong giờ học</td>
                <td id="diem">10</td>
                <td id="diem">
                    @if($bangdiem_chitiet -> p1_a_1 == NULL)
                        0
                    @else
                        {{$bangdiem_chitiet -> p1_a_1}}
                    @endif
                </td>
            </tr>
            <tr>
                <td>- Không vi phạm quy chế về thi, kiểm tra</td>
                <td id="diem">10</td>
                <td id="diem">
                    @if($bangdiem_chitiet -> p1_a_2 == NULL)
                        0
                    @else
                        {{$bangdiem_chitiet -> p1_a_2}}
                    @endif
                </td>
            </tr>
            <tr>
                <td>- Kết quả học tập trong học kỳ: Điểm trung bình chung học kỳ (ĐTBCHK)</td>
            </tr>
            <tr>
                <td id="dtb">ĐTBCHK đạt ≥ 3,60</td>
                <td id="diem">8</td>
                @if($bangdiem_chitiet -> p1_a_3 == 8)
                    <td id="diem">{{$bangdiem_chitiet -> p1_a_3}}</td>
                @else
                    <td id="diem">Không đủ</td>
                @endif
            </tr>
            <tr>

                <td id="dtb">ĐTBCHK đạt  từ  3,20 đến 3,59</td>
                <td id="diem">6</td>
                @if($bangdiem_chitiet -> p1_a_3 == 6)
                    <td id="diem">{{$bangdiem_chitiet -> p1_a_3}}</td>
                @else
                    <td id="diem">Không đủ</td>
                @endif
            </tr>
            <tr>
                <td id="dtb">ĐTBCHK đạt  từ  2,50 đến 3,19</td>
                <td id="diem">4</td>
                @if($bangdiem_chitiet -> p1_a_3 == 4)
                    <td id="diem">{{$bangdiem_chitiet -> p1_a_3}}</td>
                @else
                    <td id="diem">Không đủ</td>
                @endif
            </tr>
            <tr>
                <td id="dtb">ĐTBCHK đạt  từ  2,00 đến 2,49</td>
                <td id="diem">2</td>
                @if($bangdiem_chitiet -> p1_a_3 == 2)
                    <td id="diem">{{$bangdiem_chitiet -> p1_a_3}}</td>
                @else
                    <td id="diem">Không đủ</td>
                @endif
            </tr>
            <tr>
                <td id="dtb">ĐTBCHK dưới 2,00</td>
                <td id="diem">0</td>
                @if($bangdiem_chitiet -> p1_a_3 == 0)
                    <td id="diem">{{$bangdiem_chitiet -> p1_a_3}}</td>
                @else
                    <td id="diem">Không đủ</td>
                @endif
            </tr>
            <tr>
                <td>- Có cố gắng, vượt khó trong học tập (có ĐTB học kỳ sau lớn hơn học kỳ trước đó;  đối với<br>
                    SV năm thứ nhất, học kỳ I  không có điểm F)</td>
                <td id="diem">2</td>
                <td id="diem">
                    @if($bangdiem_chitiet -> p1_a_4 == NULL)
                        0
                    @else
                        {{$bangdiem_chitiet -> p1_a_4}}
                    @endif
                </td>
            </tr>
            <tr>
                <td><strong>b. Học tập  nâng cao trình độ ngoại ngữ, tin học</strong></td>
            </tr>
            <tr>
                <td>Hoàn thành chứng chỉ ngoại ngữ, tin học</td>
            </tr>
            <tr>
                <td>- Chứng chỉ A (và  tương đương)</td>
                <td id="diem">4</td>
                @if($bangdiem_chitiet -> chungchi_a == NULL)
                    <td id="diem">Chưa có</td>
                @else
                    <td id="diem">{{$bangdiem_chitiet -> chungchi_a}}</td>
                @endif
            </tr>
            <tr>
                <td>- Chứng chỉ B (và  tương đương)</td>
                <td id="diem">5</td>
                @if($bangdiem_chitiet -> chungchi_b == NULL)
                    <td id="diem">Chưa có</td>
                @else
                    <td id="diem">{{$bangdiem_chitiet -> chungchi_b}}</td>
                @endif
            </tr>
            <tr>
                <td>- Chứng chỉ C (và  tương đương)</td>
                <td id="diem">6</td>
                @if($bangdiem_chitiet -> chungchi_c == NULL)
                    <td id="diem">Chưa có</td>
                @else
                    <td id="diem">{{$bangdiem_chitiet -> chungchi_c}}</td>
                @endif
            </tr>
            <tr>
                <td>- Riêng chứng chỉ ngoại ngữ, Chứng nhận Toefl  ≥ 450 điểm; IELTS ≥ 4,5; TOEIC ≥ 450 điểm.</td>
                <td id="diem">10</td>
                @if($bangdiem_chitiet -> toeic == NULL)
                    <td id="diem">Chưa có</td>
                @else
                    <td id="diem">{{$bangdiem_chitiet -> toeic}}</td>
                @endif
            </tr>
            <tr>
                <td><strong>Điểm  cộng tối đa của mục 1 là 30 điểm</strong></td>
                <td></td>
                <td id="diem">
                    @if($tong1 > 30)
                        30
                    @else
                        {{$tong1}}
                    @endif
                </td>
            </tr>
            <tr>
                <td><strong>2. Đánh giá về ý thức và kết quả chấp hành nội quy, quy chế trong nhà trường</strong><br>
                    (Điều 6 – Quy chế đánh giá kết quả rèn luyện…)</td>
            </tr>
            <tr>
                <td>- Không vi phạm và có ý thức tham gia thực hiện nghiêm túc các quy định của Lớp, nội quy,<br>
                    quy chế của Trường, Khoa và các tổ chức trong nhà trường</td>
                <td id="diem">15</td>
                <td id="diem">
                    @if($bangdiem_chitiet -> p2_1 == NULL)
                        0
                    @else
                        {{$bangdiem_chitiet -> p2_1}}
                    @endif
                </td>
            </tr>
            <tr>
                <td>- Sinh viên có tích cực tham gia các hoạt động tuyên truyền, vận động mọi người xung quanh<br>
                    thực hiện nghiêm túc nội quy, quy chế, các quy định của nhà trường về:</td>
            </tr>
            <tr>
                <td id="dtb">Giữ gìn an ninh, trật tự nơi công cộng</td>
                <td id="diem">10</td>
                <td id="diem">
                    @if($bangdiem_chitiet -> p2_2_1 == NULL)
                        0
                    @else
                        {{$bangdiem_chitiet -> p2_2_1}}
                    @endif
                </td>
            </tr>
            <tr>
                <td id="dtb">Giữ gìn vệ sinh, bảo vệ cảnh quan môi trường, nếp sống văn minh <br>
                    (có xác nhận của đoàn thể, Khoa, Trường...).</td>
                <td id="diem">10</td>
                <td id="diem">
                    @if($bangdiem_chitiet -> p2_2_2 == NULL)
                        0
                    @else
                        {{$bangdiem_chitiet -> p2_2_2}}
                    @endif
                </td>
            </tr>
            <tr>
                <td><strong>Điểm cộng tối đa của mục 2 là 25 điểm</strong></td>
                <td></td>
                <td id="diem">
                    @if($tong2 > 15)
                        15
                    @else
                        {{$tong2}}
                    @endif
                </td>
            </tr>
            <tr>
                <td><strong>3. Đánh giá về ý thức và kết quả tham gia các hoạt động chính trị - xã hội, văn hóa,<br>
                        văn nghệ, thể thao, phòng chống các tệ nạn xã hội</strong><br>
                    (Điều 7 – Quy chế đánh giá kết quả rèn luyện…)</td>
            </tr>
            <tr>
                <td>- Tham gia đầy đủ các hoạt động chính trị, xã hội, văn hóa, văn nghệ, thể thao các cấp<br>
                    từ Lớp, Chi hội, Chi đoàn trở lên tổ chức.</td>
                <td id="diem">12</td>
                <td id="diem">
                    @if($bangdiem_chitiet -> p3_1 == NULL)
                        0
                    @else
                        {{$bangdiem_chitiet -> p3_1}}
                    @endif
                </td>
            </tr>
            <tr>
                <td>- Là lực lượng nòng cốt trong các phong trào văn hóa, văn nghệ, thể thao:</td>
            </tr>
            <tr>
                <td id="dtb">Cấp Chi đoàn, Chi hội, Đội, Nhóm, Câu lạc bộ.</td>
                <td id="diem">4</td>
                <td id="diem">
                    @if($bangdiem_chitiet -> p3_2_1 == NULL)
                        0
                    @else
                        {{$bangdiem_chitiet -> p3_2_1}}
                    @endif
                </td>
            </tr>
            <tr>
                <td id="dtb">Cấp Khoa (và tương đương), Trường</td>
                <td id="diem">5</td>
                <td id="diem">
                    @if($bangdiem_chitiet -> p3_2_2 == NULL)
                        0
                    @else
                        {{$bangdiem_chitiet -> p3_2_2}}
                    @endif
                </td>
            </tr>
            <tr>
                <td>- Được khen thưởng trong các hoạt động phong trào</td>
            </tr>
            <tr>
                <td id="dtb">Quyết định khen thưởng của Đoàn Khoa  (và tương đương)</td>
                <td id="diem">6</td>
                <td id="diem">
                    @if($bangdiem_chitiet -> p3_3_1 == NULL)
                        0
                    @else
                        {{$bangdiem_chitiet -> p3_3_1}}
                    @endif
                </td>
            </tr>
            <tr>
                <td id="dtb">Giấy khen cấp Trường</td>
                <td id="diem">8</td>
                <td id="diem">
                    @if($bangdiem_chitiet -> p3_3_2 == NULL)
                        0
                    @else
                        {{$bangdiem_chitiet -> p3_3_2}}
                    @endif
                </td>
            </tr>
            <tr>
                <td id="dtb">Giấy khen cấp cao hơn</td>
                <td id="diem">10</td>
                <td id="diem">
                    @if($bangdiem_chitiet -> p3_3_3 == NULL)
                        0
                    @else
                        {{$bangdiem_chitiet -> p3_3_3}}
                    @endif
                </td>
            </tr>
            <tr>
                <td><strong>Điểm cộng tối đa của mục 3 là 20 điểm</strong></td>
                <td></td>
                <td id="diem">
                    @if($tong3 > 20)
                        20
                    @else
                        {{$tong3}}
                    @endif
                </td>
            </tr>
            <tr>
                <td><strong>4. Đánh giá về phẩm chất công dân và quan hệ với cộng đồng</strong><br>
                    (Điều 8 – Quy chế đánh giá kết quả rèn luyện…)</td>
            </tr>
            <tr>
                <td>- Không vi phạm pháp luật của Nhà nước.</td>
                <td id="diem">6</td>
                <td id="diem">
                    @if($bangdiem_chitiet-> p4_1 == NULL)
                        0
                    @else
                        {{$bangdiem_chitiet-> p4_1}}
                    @endif
                </td>
            </tr>
            <tr>
                <td>- Có tinh thần giúp đỡ bạn bè trong học tập, trong cuộc sống </td>
                <td id="diem">4</td>
                <td id="diem">
                    @if($bangdiem_chitiet -> p4_2 == NULL)
                        0
                    @else
                        {{$bangdiem_chitiet-> p4_2}}
                    @endif
                </td>
            </tr>
            <tr>
                <td>- Tham gia đội, nhóm, câu lạc bộ sinh hoạt hướng đến lợi ích cộng đồng<br>
                    (tham gia công tác xã hội ở Trường, nơi cư trú, địa phương).</td>
                <td id="diem">10</td>
                <td id="diem">
                    @if($bangdiem_chitiet -> p4_3 == NULL)
                        0
                    @else
                        {{$bangdiem_chitiet -> p4_3}}
                    @endif
                </td>
            </tr>
            <tr>
                <td><strong>Điểm cộng tối đa của mục 4 là 15 điểm</strong></td>
                <td></td>
                <td id="diem">
                    @if($tong4 > 15)
                        15
                    @else
                        {{$tong4}}
                    @endif
                </td>
            </tr>
            <tr>
                <td><strong>5.  Đánh giá về ý thức và kết quả tham gia công tác phụ trách lớp, các đoàn thể,<br>
                        tổ chức trong Nhà trường …</strong>(Điều 9 – Quy chế đánh giá kết quả rèn luyện…)</td>
            </tr>
            <tr>
                <td>- Là Lớp trưởng, Bí thư Chi đoàn, Ủy viên BCH Đoàn Trường, Ủy viên Ban Chấp hành<br>
                    Đoàn khoa, BCH Hội Sinh viên Trường, Liên Chi hội trưởng, Chi hội trưởng Hội Sinh viên,<br>
                    Đội trưởng các Đội, Nhóm, Chủ nhiệm các Câu lạc bộ thuộc Hội Sinh viên Trường đã<br>
                    hoàn thành nhiệm vụ được giao</td>
                <td id="diem">10</td>
                <td id="diem">
                    @if($bangdiem_chitiet -> p5_1 == NULL)
                        0
                    @else
                        {{$bangdiem_chitiet -> p5_1}}
                    @endif
                </td>
            </tr>
            <tr>
                <td>- Là thành viên của Ban Cán sự lớp, Ban Chấp hành chi đoàn, Ban Chấp hành Liên Chi hội<br>
                    sinh viên, Chi hội sinh viên, Ban Chủ nhiệm các Đội, Nhóm, Câu lạc bộ (trừ các thành viên<br>
                    nêu  mục trên), đã hoàn thành nhiệm vụ được giao</td>
                <td id="diem">6</td>
                <td id="diem">
                    @if($bangdiem_chitiet -> p5_2 == NULL)
                        0
                    @else
                        {{$bangdiem_chitiet -> p5_2}}
                    @endif
                </td>
            </tr>
            <tr>
                <td>- Được kết nạp Đảng, hoặc được công nhận Đoàn viên ưu tú</td>
                <td id="diem">6</td>
                <td id="diem">
                    @if($bangdiem_chitiet -> p5_3 == NULL)
                        0
                    @else
                        {{$bangdiem_chitiet -> p5_3}}
                    @endif
                </td>
            </tr>
            <tr>
                <td><strong>Điểm cộng tối đa của mục 5 là 10 điểm</strong></td>
                <td></td>
                <td id="diem">
                    @if($tong5 > 10)
                        10
                    @else
                        {{$tong5}}
                    @endif
                </td>
            </tr>
            <tr>
                <td style="text-align: center"><strong>Cộng các mục 1,2,3,4,5</strong></td>
                <td></td>
                <td id="diem">{{$tong1 + $tong2 + $tong3 + $tong4 + $tong5}}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="ketluan">
        <h4>Kết luận:</h4>
        <p><strong>Điểm rèn luyện:</strong>{{$bangdiem -> diemtong}}</p>
        <p><strong>Xếp loại:</strong> {{$bangdiem -> xeploai}}</p>
    </div>
</div>
<div class="container-fluid footer">
    <h5>Copyright &copy; 2015</h5>
</div>

