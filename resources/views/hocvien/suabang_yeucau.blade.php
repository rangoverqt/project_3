<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 23/12/18
 * Time: 3:29 PM
 */
?>
@include('layout.header')
<div class="container">
    <div class="turnback"><a href="/doan3/public/hocvien/bangdiem/xemchitiet/{{$bangdiem_lan1 -> id}}">Trở về</a></div>
    <div class="tt_sv">
        <h4>Thông tin sinh viên:</h4>
        <p><strong>Mã số sinh viên:</strong> {{$hocvien -> mssv}}</p>
        <p><strong>Họ tên:</strong> {{$hocvien -> hoten}}</p>
        <p><strong>Lớp:</strong> {{$hocvien -> lop -> ten_lop}}</p>
    </div>
    <div class="tt_hk">
        <p><strong>Năm học: </strong>{{$namhoc -> namhoc -> namhoc}}</p>
        <p><strong>Học kỳ: </strong>{{$bangdiem_lan1 -> hocky -> hocky}}</p>
    </div>
    <div class="bang1">
        <form action="" method="post">
            @csrf
            <table class="table table1 table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>Nội dung đánh giá</th>
                    <th>Mức điểm</th>
                    <th>CVHT cho điểm</th>
                    <th>Chọn và nêu lý do</th>
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
                        @if($bangdiem_chitiet_lan1 -> p1_a_1 == NULL)
                            0
                    @else
                        {{$bangdiem_chitiet_lan1 -> p1_a_1}}
                    @endif
                    <td id="diem">
                        <input placeholder="Lý do"
                               type="text"
                               id="p1_a_1"
                               name="p1_a_1"
                               disabled
                        ><input type="checkbox" id="p1_a_1_cb" name="p1_a_1_cb" value="1"></td>
                </tr>
                <tr>
                    <td>- Không vi phạm quy chế về thi, kiểm tra</td>
                    <td id="diem">10</td>
                    <td id="diem">
                        @if($bangdiem_chitiet_lan1 -> p1_a_2 == NULL)
                            0
                        @else
                            {{$bangdiem_chitiet_lan1 -> p1_a_2}}
                        @endif
                    </td>
                    <td id="diem">
                        <input placeholder="Lý do"
                               type="text"
                               id="p1_a_2"
                               name="p1_a_2"
                               disabled
                        ><input type="checkbox" id="p1_a_2_cb" name="p1_a_2_cb" value="1"></td>
                </tr>
                <tr>
                    <td>- Kết quả học tập trong học kỳ: Điểm trung bình chung học kỳ (ĐTBCHK)</td>
                </tr>
                <tr>
                    <td id="dtb">ĐTBCHK đạt ≥ 3,60</td>
                    <td id="diem">8</td>
                    @if($bangdiem_chitiet_lan1 -> p1_a_3 == 8)
                        <td id="diem">{{$bangdiem_chitiet_lan1 -> p1_a_3}}</td>
                    @else
                        <td id="diem">Không đủ</td>
                    @endif
                    <td id="diem"><input placeholder="Lý do"
                                         type="text"
                                         name="p1_a_3"
                                         id="p1_a_3_1"
                                         disabled
                        ><input type="checkbox" id="p1_a_3_cb1" name="p1_a_3_cb" value="1"></td>
                </tr>
                <tr>
                    <td id="dtb">ĐTBCHK đạt  từ  3,20 đến 3,59</td>
                    <td id="diem">6</td>
                    @if($bangdiem_chitiet_lan1 -> p1_a_3 == 6)
                        <td id="diem">{{$bangdiem_chitiet_lan1 -> p1_a_3}}</td>
                    @else
                        <td id="diem">Không đủ</td>
                    @endif
                    <td id="diem"><input placeholder="Lý do"
                                         type="text"
                                         name="p1_a_3"
                                         id="p1_a_3_2"
                                         disabled
                        ><input type="checkbox" id="p1_a_3_cb2" name="p1_a_3_cb" value="1"></td>
                </tr>
                <tr>
                    <td id="dtb">ĐTBCHK đạt  từ  2,50 đến 3,19 </td>
                    <td id="diem">4</td>
                    @if($bangdiem_chitiet_lan1 -> p1_a_3 == 4)
                        <td id="diem">{{$bangdiem_chitiet_lan1 -> p1_a_3}}</td>
                    @else
                        <td id="diem">Không đủ</td>
                    @endif
                    <td id="diem"><input placeholder="Lý do"
                                         type="text"
                                         name="p1_a_3"
                                         id="p1_a_3_3"
                                         disabled
                        ><input type="checkbox" id="p1_a_3_cb3" name="p1_a_3_cb" value="1"></td>
                </tr>
                <tr>
                    <td id="dtb">ĐTBCHK đạt  từ  2,00 đến 2,49</td>
                    <td id="diem">2</td>
                    @if($bangdiem_chitiet_lan1 -> p1_a_3 == 2)
                        <td id="diem">{{$bangdiem_chitiet_lan1 -> p1_a_3}}</td>
                    @else
                        <td id="diem">Không đủ</td>
                    @endif
                    <td id="diem"><input placeholder="Lý do"
                                         type="text"
                                         name="p1_a_3"
                                         id="p1_a_3_4"
                                         disabled
                        ><input type="checkbox" name="p1_a_3_cb" id="p1_a_3_cb4" value="1"></td>
                </tr>
                <tr>
                    <td id="dtb">ĐTBCHK dưới 2,00</td>
                    <td id="diem">0</td>
                    @if($bangdiem_chitiet_lan1 -> p1_a_3 == 0)
                        <td id="diem">{{$bangdiem_chitiet_lan1 -> p1_a_3}}</td>
                    @else
                        <td id="diem">Không đủ</td>
                    @endif
                    <td id="diem"><input placeholder="Lý do"
                                         type="text"
                                         name="p1_a_3"
                                         id="p1_a_3_5"
                                         disabled
                        ><input type="checkbox" id="p1_a_3_cb5" name="p1_a_3_cb" value="1"></td>
                </tr>
                <tr>
                    <td>- Có cố gắng, vượt khó trong học tập (có ĐTB học kỳ sau lớn hơn học kỳ trước đó;  đối với<br>
                        SV năm thứ nhất, học kỳ I  không có điểm F)</td>
                    <td id="diem">2</td>
                    <td id="diem">
                        @if($bangdiem_chitiet_lan1 -> p1_a_4 == NULL)
                            0
                        @else
                            {{$bangdiem_chitiet_lan1 -> p1_a_4}}
                        @endif
                    </td>
                    <td id="diem"><input placeholder="Lý do"
                                         type="text"
                                         id="p1_a_4"
                                         name="p1_a_4"
                                         disabled
                        ><input type="checkbox" id="p1_a_4_cb" name="p1_a_4_cb" value="1"></td>
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
                    @if($bangdiem_chitiet_lan1 -> chungchi_a == NULL)
                        <td id="diem">Chưa có</td>
                    @else
                        <td id="diem">{{$bangdiem_chitiet_lan1 -> chungchi_a}}</td>
                    @endif
                    <td id="diem"><input placeholder="Lý do"
                                         type="text"
                                         name="chungchi_a"
                                         id="chungchi_a"
                                         disabled
                        ><input type="checkbox" id="chungchi_a_cb" name="chungchi_a_cb" value="1"></td>
                </tr>
                <tr>
                    <td>- Chứng chỉ B (và  tương đương)</td>
                    <td id="diem">5</td>
                    @if($bangdiem_chitiet_lan1 -> chungchi_b == NULL)
                        <td id="diem">Chưa có</td>
                    @else
                        <td id="diem">{{$bangdiem_chitiet_lan1 -> chungchi_b}}</td>
                    @endif
                    <td id="diem"><input placeholder="Lý do"
                                         type="text"
                                         name="chungchi_b"
                                         id="chungchi_b"
                                         disabled
                        ><input type="checkbox" id="chungchi_b_cb" name="chungchi_b_cb" value="1"></td>
                </tr>
                <tr>
                    <td>- Chứng chỉ C (và  tương đương)</td>
                    <td id="diem">6</td>
                    @if($bangdiem_chitiet_lan1 -> chungchi_c == NULL)
                        <td id="diem">Chưa có</td>
                    @else
                        <td id="diem">{{$bangdiem_chitiet_lan1 -> chungchi_c}}</td>
                    @endif
                    <td id="diem"><input placeholder="Lý do"
                                         type="text"
                                         name="chungchi_c"
                                         id="chungchi_c"
                                         disabled
                        ><input type="checkbox" name="chungchi_c_cb" id="chungchi_c_cb" value="1"></td>
                </tr>
                <tr>
                    <td>- Riêng chứng chỉ ngoại ngữ, Chứng nhận Toefl  ≥ 450 điểm; IELTS ≥ 4,5; TOEIC ≥ 450 điểm.</td>
                    <td id="diem">10</td>
                    @if($bangdiem_chitiet_lan1 -> toeic == NULL)
                        <td id="diem">Chưa có</td>
                    @else
                        <td id="diem">{{$bangdiem_chitiet_lan1 -> toeic}}</td>
                    @endif
                    <td id="diem"><input placeholder="Lý do"
                                         type="text"
                                         name="toeic"
                                         id="toeic"
                                         disabled
                        ><input type="checkbox" id="toeic_cb" name="toeic_cb" value="1"></td>
                </tr>
                <tr>
                    <td><strong>Điểm  cộng tối đa của mục 1 là 30 điểm</strong></td>
                    <td></td>
                    <td id="diem">
                        @if($tong1_lan1 > 30)
                            30
                        @else
                            {{$tong1_lan1}}
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
                        @if($bangdiem_chitiet_lan1 -> p2_1 == NULL)
                            0
                        @else
                            {{$bangdiem_chitiet_lan1 -> p2_1}}
                        @endif
                    </td>
                    <td id="diem"><input placeholder="Lý do"
                                         type="text"
                                         id="p2_1"
                                         name="p2_1"
                                         disabled
                        ><input type="checkbox" name="p2_1_cb" id="p2_1_cb" value="1"></td>
                </tr>
                <tr>
                    <td>- Sinh viên có tích cực tham gia các hoạt động tuyên truyền, vận động mọi người xung quanh<br>
                        thực hiện nghiêm túc nội quy, quy chế, các quy định của nhà trường về:</td>
                </tr>
                <tr>
                    <td id="dtb">Giữ gìn an ninh, trật tự nơi công cộng</td>
                    <td id="diem">10</td>
                    <td id="diem">
                        @if($bangdiem_chitiet_lan1 -> p2_2_1 == NULL)
                            0
                        @else
                            {{$bangdiem_chitiet_lan1 -> p2_2_1}}
                        @endif
                    </td>
                    <td id="diem"><input placeholder="Lý do"
                                         type="text"
                                         id="p2_2_1"
                                         name="p2_2_1"
                                         disabled
                        ><input type="checkbox" name="p2_2_1_cb" id="p2_2_1_cb" value="1"></td>
                </tr>
                <tr>
                    <td id="dtb">Giữ gìn vệ sinh, bảo vệ cảnh quan môi trường, nếp sống văn minh <br>
                        (có xác nhận của đoàn thể, Khoa, Trường...).</td>
                    <td id="diem">10</td>
                    <td id="diem">
                        @if($bangdiem_chitiet_lan1 -> p2_2_2 == NULL)
                            0
                        @else
                            {{$bangdiem_chitiet_lan1 -> p2_2_2}}
                        @endif
                    </td>
                    <td id="diem"><input placeholder="Lý do"
                                         type="text"
                                         id="p2_2_2"
                                         name="p2_2_2"
                                         disabled
                        ><input type="checkbox" name="p2_2_2_cb" id="p2_2_2_cb" value="1"></td>
                </tr>
                <tr>
                    <td><strong>Điểm cộng tối đa của mục 2 là 25 điểm</strong></td>
                    <td></td>
                    <td id="diem">
                        @if($tong2_lan1 > 15)
                            15
                        @else
                            {{$tong2_lan1}}
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
                        @if($bangdiem_chitiet_lan1 -> p3_1 == NULL)
                            0
                        @else
                            {{$bangdiem_chitiet_lan1 -> p3_1}}
                        @endif
                    </td>
                    <td id="diem"><input placeholder="Lý do"
                                         type="text"
                                         id="p3_1"
                                         name="p3_1"
                                         disabled
                        ><input type="checkbox" id="p3_1_cb" name="p3_1_cb" value="1"></td>
                </tr>
                <tr>
                    <td>- Là lực lượng nòng cốt trong các phong trào văn hóa, văn nghệ, thể thao:</td>
                </tr>
                <tr>
                    <td id="dtb">Cấp Chi đoàn, Chi hội, Đội, Nhóm, Câu lạc bộ.</td>
                    <td id="diem">4</td>
                    <td id="diem">
                        @if($bangdiem_chitiet_lan1-> p3_2_1 == NULL)
                            0
                        @else
                            {{$bangdiem_chitiet_lan1 -> p3_2_1}}
                        @endif
                    </td>
                    <td id="diem"><input placeholder="Lý do"
                                         type="text"
                                         id="p3_2_1"
                                         name="p3_2_1"
                                         disabled
                        ><input type="checkbox" id="p3_2_1_cb" name="p3_2_1_cb" value="1"></td>
                </tr>
                <tr>
                    <td id="dtb">Cấp Khoa (và tương đương), Trường</td>
                    <td id="diem">5</td>
                    <td id="diem">
                        @if($bangdiem_chitiet_lan1 -> p3_2_2 == NULL)
                            0
                        @else
                            {{$bangdiem_chitiet_lan1 -> p3_2_2}}
                        @endif
                    </td>
                    <td id="diem"><input placeholder="Lý do"
                                         type="text"
                                         id="p3_2_2"
                                         name="p3_2_2"
                                         disabled
                        ><input type="checkbox" id="p3_2_2_cb" name="p3_2_2_cb" value="1"></td>
                </tr>
                <tr>
                    <td>- Được khen thưởng trong các hoạt động phong trào</td>
                </tr>
                <tr>
                    <td id="dtb">Quyết định khen thưởng của Đoàn Khoa  (và tương đương)</td>
                    <td id="diem">6</td>
                    <td id="diem">
                        @if($bangdiem_chitiet_lan1 -> p3_3_1 == NULL)
                            0
                        @else
                            {{$bangdiem_chitiet_lan1 -> p3_3_1}}
                        @endif
                    </td>
                    <td id="diem"><input placeholder="Lý do"
                                         type="text"
                                         id="p3_3_1"
                                         name="p3_3_1"
                                         disabled
                        ><input type="checkbox" id="p3_3_1_cb" name="p3_3_1_cb" value="1"></td>
                </tr>
                <tr>
                    <td id="dtb">Giấy khen cấp Trường</td>
                    <td id="diem">8</td>
                    <td id="diem">
                        @if($bangdiem_chitiet_lan1 -> p3_3_2 == NULL)
                            0
                        @else
                            {{$bangdiem_chitiet_lan1 -> p3_3_2}}
                        @endif
                    </td>
                    <td id="diem"><input placeholder="Lý do"
                                         type="text"
                                         id="p3_3_2"
                                         name="p3_3_2"
                                         disabled
                        ><input type="checkbox" name="p3_3_2_cb" id="p3_3_2_cb" value="1"></td>
                </tr>
                <tr>
                    <td id="dtb">Giấy khen cấp cao hơn</td>
                    <td id="diem">10</td>
                    <td id="diem">
                        @if($bangdiem_chitiet_lan1 -> p3_3_3 == NULL)
                            0
                        @else
                            {{$bangdiem_chitiet_lan1 -> p3_3_3}}
                        @endif
                    </td>
                    <td id="diem"><input placeholder="Lý do"
                                         type="text"
                                         id="p3_3_3"
                                         name="p3_3_3"
                                         disabled
                        ><input type="checkbox" id="p3_3_3_cb" name="p3_3_3_cb" value="1"></td>
                </tr>
                <tr>
                    <td><strong>Điểm cộng tối đa của mục 3 là 20 điểm</strong></td>
                    <td></td>
                    <td id="diem">
                        @if($tong3_lan1 > 20)
                            20
                        @else
                            {{$tong3_lan1}}
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
                        @if($bangdiem_chitiet_lan1 -> p4_1 == NULL)
                            0
                        @else
                            {{$bangdiem_chitiet_lan1 -> p4_1}}
                        @endif
                    </td>
                    <td id="diem"><input placeholder="Lý do"
                                         type="text"
                                         name="p4_1"
                                         id="p4_1"
                                         disabled
                        ><input type="checkbox" name="p4_1_cb" id="p4_1_cb" value="1"></td>
                </tr>
                <tr>
                    <td>- Có tinh thần giúp đỡ bạn bè trong học tập, trong cuộc sống </td>
                    <td id="diem">4</td>
                    <td id="diem">
                        @if($bangdiem_chitiet_lan1 -> p4_2 == NULL)
                            0
                        @else
                            {{$bangdiem_chitiet_lan1 -> p4_2}}
                        @endif
                    </td>
                    <td id="diem"><input placeholder="Lý do"
                                         type="text"
                                         name="p4_2"
                                         id="p4_2"
                                         disabled
                        ><input type="checkbox" name="p4_2_cb" id="p4_2_cb" value="1"></td>
                </tr>
                <tr>
                    <td>- Tham gia đội, nhóm, câu lạc bộ sinh hoạt hướng đến lợi ích cộng đồng<br>
                        (tham gia công tác xã hội ở Trường, nơi cư trú, địa phương).</td>
                    <td id="diem">10</td>
                    <td id="diem">
                        @if($bangdiem_chitiet_lan1 -> p4_3 == NULL)
                            0
                        @else
                            {{$bangdiem_chitiet_lan1 -> p4_3}}
                        @endif
                    </td>
                    <td id="diem"><input placeholder="Lý do"
                                         type="text"
                                         id="p4_3"
                                         name="p4_3"
                                         disabled
                        ><input type="checkbox" name="p4_3_cb" id="p4_3_cb" value="1"></td>
                </tr>
                <tr>
                    <td><strong>Điểm cộng tối đa của mục 4 là 15 điểm</strong></td>
                    <td></td>
                    <td id="diem">
                        @if($tong4_lan1 > 15)
                            15
                        @else
                            {{$tong4_lan1}}
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
                        @if($bangdiem_chitiet_lan1 -> p5_1 == NULL)
                            0
                        @else
                            {{$bangdiem_chitiet_lan1 -> p5_1}}
                        @endif
                    </td>
                    <td id="diem"><input placeholder="Lý do"
                                         type="text"
                                         id="p5_1"
                                         name="p5_1"
                                         disabled
                        ><input type="checkbox" id="p5_1_cb" name="p5_1_cb" value="1"></td>
                </tr>
                <tr>
                    <td>- Là thành viên của Ban Cán sự lớp, Ban Chấp hành chi đoàn, Ban Chấp hành Liên Chi hội<br>
                        sinh viên, Chi hội sinh viên, Ban Chủ nhiệm các Đội, Nhóm, Câu lạc bộ (trừ các thành viên<br>
                        nêu  mục trên), đã hoàn thành nhiệm vụ được giao</td>
                    <td id="diem">6</td>
                    <td id="diem">
                        @if($bangdiem_chitiet_lan1 -> p5_2 == NULL)
                            0
                        @else
                            {{$bangdiem_chitiet_lan1 -> p5_2}}
                        @endif
                    </td>
                    <td id="diem"><input placeholder="Lý do"
                                         type="text"
                                         id="p5_2"
                                         name="p5_2"
                                         disabled
                        ><input type="checkbox" name="p5_2_cb" id="p5_2_cb" value="1"></td>
                </tr>
                <tr>
                    <td>- Được kết nạp Đảng, hoặc được công nhận Đoàn viên ưu tú</td>
                    <td id="diem">6</td>
                    <td id="diem">
                        @if($bangdiem_chitiet_lan1 -> p5_3 == NULL)
                            0
                        @else
                            {{$bangdiem_chitiet_lan1 -> p5_3}}
                        @endif
                    </td>
                    <td id="diem"><input placeholder="Lý do"
                                         type="text"
                                         id="p5_3"
                                         name="p5_3"
                                         disabled
                        ><input type="checkbox" name="p5_3_cb" id="p5_3_cb" value="1"></td>
                </tr>
                <tr>
                    <td><strong>Điểm cộng tối đa của mục 5 là 10 điểm</strong></td>
                    <td></td>
                    <td id="diem">
                        @if($tong5_lan1 > 10)
                            10
                        @else
                            {{$tong5_lan1}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center"><strong>Cộng các mục 1,2,3,4,5</strong></td>
                    <td></td>
                    <td id="diem">{{$tong1_lan1 + $tong2_lan1 + $tong3_lan1 + $tong4_lan1 + $tong5_lan1}}</td>
                </tr>
                </tbody>
            </table>
            <input type="submit" name="submit" value="Gửi yêu cầu">
        </form>
    </div>
    <div class="bang1">
        <h5>Các hoạt động đã tham gia</h5>
        <table class="table tabl1 table-hover table-striped table-bordered">
            <thead>
            <tr>
                <th>STT</th>
                <th>Tên hoạt động</th>
                <th>Học kỳ</th>
                <th>Năm học</th>
            </tr>
            </thead>
            <tbody>
            @if($hoatdong == 0)
                <tr><td>Không tham gia hoạt động</td></tr>
            @else
                <?php $no = 1 ?>
                @foreach($hoatdong as $key => $hd)
                    @foreach($hd as $hd1)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$hd1 -> hoatdong -> ten_hoatdong}}</td>
                            <td>{{$bangdiem_lan1 -> hocky -> hocky}}</td>
                            <td>{{$namhoc -> namhoc -> namhoc}}</td>
                        </tr>
                    @endforeach
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    <div class="bang1">
        <h5>Các thành tích đạt được</h5>
        <table class="table tabl1 table-hover table-striped table-bordered">
            <thead>
            <tr>
                <th>STT</th>
                <th>Tên hoạt động</th>
                <th>Thành tích</th>
            </tr>
            </thead>
            <tbody>
            @if($hoatdong_tt == 0)
                <tr><td>Không có thành tích</td></tr>
            @else
                <?php $no = 1 ?>
                @foreach($hoatdong_tt as $key => $pd)
                    @foreach($pd as $pd1)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$pd1 -> hoatdong -> ten_hoatdong}}
                            @foreach($test as $te)
                                @if($te -> id_hoatdong == $pd1 -> hoatdong -> id)
                                    @if($te -> hang == 1)
                                        <td>Hạng nhất</td>
                                    @elseif($te -> hang == 2)
                                        <td>Hạng hai</td>
                                    @elseif($te -> hang == 3)
                                        <td>Hạng ba</td>
                                    @else
                                        <td>Hạng tư</td>
                                    @endif
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
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
        $('#p1_a_1_cb').on('change', function(){
            if ($('#p1_a_1_cb:checked').length){
                $('#p1_a_1').prop("disabled",false);
                return;
            }
            else {
                $('#p1_a_1').prop("disabled", true);
            }
        });
        $('#p1_a_2_cb').on('change', function(){
            if ($('#p1_a_2_cb:checked').length){
                $('#p1_a_2').prop("disabled",false);
                return;
            }
            else {
                $('#p1_a_2').prop("disabled", true);
            }
        });
        $('#p1_a_3_cb1').on('change', function(){
            if ($('#p1_a_3_cb1:checked').length){
                $('#p1_a_3_1').prop("disabled",false);
                $('#p1_a_3_cb2').prop({ disabled: true, checked: false});
                $('#p1_a_3_cb3').prop({ disabled: true, checked: false});
                $('#p1_a_3_cb4').prop({ disabled: true, checked: false});
                $('#p1_a_3_cb5').prop({ disabled: true, checked: false});
                return;
            }
            else {
                $('#p1_a_3_1').prop("disabled", true);
                $('#p1_a_3_cb2').prop('disabled', false);
                $('#p1_a_3_cb3').prop('disabled', false);
                $('#p1_a_3_cb4').prop('disabled', false);
                $('#p1_a_3_cb5').prop('disabled', false);
            }
        });
        $('#p1_a_3_cb2').on('change', function(){
            if ($('#p1_a_3_cb2:checked').length){
                $('#p1_a_3_2').prop("disabled",false);
                $('#p1_a_3_cb1').prop({ disabled: true, checked: false});
                $('#p1_a_3_cb3').prop({ disabled: true, checked: false});
                $('#p1_a_3_cb4').prop({ disabled: true, checked: false});
                $('#p1_a_3_cb5').prop({ disabled: true, checked: false});
                return;
            }
            else {
                $('#p1_a_3_2').prop("disabled", true);
                $('#p1_a_3_cb1').prop('disabled', false);
                $('#p1_a_3_cb3').prop('disabled', false);
                $('#p1_a_3_cb4').prop('disabled', false);
                $('#p1_a_3_cb5').prop('disabled', false);
            }
        });
        $('#p1_a_3_cb3').on('change', function(){
            if ($('#p1_a_3_cb3:checked').length){
                $('#p1_a_3_3').prop("disabled",false);
                $('#p1_a_3_cb2').prop({ disabled: true, checked: false});
                $('#p1_a_3_cb1').prop({ disabled: true, checked: false});
                $('#p1_a_3_cb4').prop({ disabled: true, checked: false});
                $('#p1_a_3_cb5').prop({ disabled: true, checked: false});
                return;
            }
            else {
                $('#p1_a_3_3').prop("disabled", true);
                $('#p1_a_3_cb2').prop('disabled', false);
                $('#p1_a_3_cb1').prop('disabled', false);
                $('#p1_a_3_cb4').prop('disabled', false);
                $('#p1_a_3_cb5').prop('disabled', false);
            }
        });
        $('#p1_a_3_cb4').on('change', function(){
            if ($('#p1_a_3_cb4:checked').length){
                $('#p1_a_3_4').prop("disabled",false);
                $('#p1_a_3_cb2').prop({ disabled: true, checked: false});
                $('#p1_a_3_cb1').prop({ disabled: true, checked: false});
                $('#p1_a_3_cb3').prop({ disabled: true, checked: false});
                $('#p1_a_3_cb5').prop({ disabled: true, checked: false});
                return;
            }
            else {
                $('#p1_a_3_4').prop("disabled", true);
                $('#p1_a_3_cb2').prop('disabled', false);
                $('#p1_a_3_cb1').prop('disabled', false);
                $('#p1_a_3_cb3').prop('disabled', false);
                $('#p1_a_3_cb5').prop('disabled', false);
            }
        });
        $('#p1_a_3_cb5').on('change', function(){
            if ($('#p1_a_3_cb5:checked').length){
                $('#p1_a_3_5').prop("disabled",false);
                $('#p1_a_3_cb2').prop({ disabled: true, checked: false});
                $('#p1_a_3_cb1').prop({ disabled: true, checked: false});
                $('#p1_a_3_cb3').prop({ disabled: true, checked: false});
                $('#p1_a_3_cb4').prop({ disabled: true, checked: false});
                return;
            }
            else {
                $('#p1_a_3_5').prop("disabled", true);
                $('#p1_a_3_cb2').prop('disabled', false);
                $('#p1_a_3_cb1').prop('disabled', false);
                $('#p1_a_3_cb3').prop('disabled', false);
                $('#p1_a_3_cb4').prop('disabled', false);
            }
        });
        $('#p1_a_4_cb').on('change', function(){
            if ($('#p1_a_4_cb:checked').length){
                $('#p1_a_4').prop("disabled",false);
                return;
            }
            else {
                $('#p1_a_4').prop("disabled", true);
            }
        });
        $('#chungchi_a_cb').on('change', function(){
            if ($('#chungchi_a_cb:checked').length){
                $('#chungchi_a').prop("disabled",false);
                return;
            }
            else {
                $('#chungchi_a').prop("disabled", true);
            }
        });
        $('#chungchi_b_cb').on('change', function(){
            if ($('#chungchi_b_cb:checked').length){
                $('#chungchi_b').prop("disabled",false);
                return;
            }
            else {
                $('#chungchi_b').prop("disabled", true);
            }
        });
        $('#chungchi_c_cb').on('change', function(){
            if ($('#chungchi_c_cb:checked').length){
                $('#chungchi_c').prop("disabled",false);
                return;
            }
            else {
                $('#chungchi_c').prop("disabled", true);
            }
        });
        $('#toeic_cb').on('change', function(){
            if ($('#toeic_cb:checked').length){
                $('#toeic').prop("disabled",false);
                return;
            }
            else {
                $('#toeic').prop("disabled", true);
            }
        });
        $('#p2_1_cb').on('change', function(){
            if ($('#p2_1_cb:checked').length){
                $('#p2_1').prop("disabled",false);
                return;
            }
            else {
                $('#p2_1').prop("disabled", true);
            }
        });
        $('#p2_2_1_cb').on('change', function(){
            if ($('#p2_2_1_cb:checked').length){
                $('#p2_2_1').prop("disabled",false);
                return;
            }
            else {
                $('#p2_2_1').prop("disabled", true);
            }
        });
        $('#p2_2_2_cb').on('change', function(){
            if ($('#p2_2_2_cb:checked').length){
                $('#p2_2_2').prop("disabled",false);
                return;
            }
            else {
                $('#p2_2_2').prop("disabled", true);
            }
        });
        $('#p3_1_cb').on('change', function(){
            if ($('#p3_1_cb:checked').length){
                $('#p3_1').prop("disabled",false);
                return;
            }
            else {
                $('#p3_1').prop("disabled", true);
            }
        });
        $('#p3_2_1_cb').on('change', function(){
            if ($('#p3_2_1_cb:checked').length){
                $('#p3_2_1').prop("disabled",false);
                return;
            }
            else {
                $('#p3_2_1').prop("disabled", true);
            }
        });
        $('#p3_2_2_cb').on('change', function(){
            if ($('#p3_2_2_cb:checked').length){
                $('#p3_2_2').prop("disabled",false);
                return;
            }
            else {
                $('#p3_2_2').prop("disabled", true);
            }
        });
        $('#p3_3_1_cb').on('change', function(){
            if ($('#p3_3_1_cb:checked').length){
                $('#p3_3_1').prop("disabled",false);
                return;
            }
            else {
                $('#p3_3_1').prop("disabled", true);
            }
        });
        $('#p3_3_2_cb').on('change', function(){
            if ($('#p3_3_2_cb:checked').length){
                $('#p3_3_2').prop("disabled",false);
                return;
            }
            else {
                $('#p3_3_2').prop("disabled", true);
            }
        });
        $('#p3_3_3_cb').on('change', function(){
            if ($('#p3_3_3_cb:checked').length){
                $('#p3_3_3').prop("disabled",false);
                return;
            }
            else {
                $('#p3_3_3').prop("disabled", true);
            }
        });
        $('#p4_1_cb').on('change', function(){
            if ($('#p4_1_cb:checked').length){
                $('#p4_1').prop("disabled",false);
                return;
            }
            else {
                $('#p4_1').prop("disabled", true);
            }
        });
        $('#p4_2_cb').on('change', function(){
            if ($('#p4_2_cb:checked').length){
                $('#p4_2').prop("disabled",false);
                return;
            }
            else {
                $('#p4_2').prop("disabled", true);
            }
        });
        $('#p4_3_cb').on('change', function(){
            if ($('#p4_3_cb:checked').length){
                $('#p4_3').prop("disabled",false);
                return;
            }
            else {
                $('#p4_3').prop("disabled", true);
            }
        });
        $('#p5_1_cb').on('change', function(){
            if ($('#p5_1_cb:checked').length){
                $('#p5_1').prop("disabled",false);
                return;
            }
            else {
                $('#p5_1').prop("disabled", true);
            }
        });
        $('#p5_2_cb').on('change', function(){
            if ($('#p5_2_cb:checked').length){
                $('#p5_2').prop("disabled",false);
                return;
            }
            else {
                $('#p5_2').prop("disabled", true);
            }
        });
        $('#p5_3_cb').on('change', function(){
            if ($('#p5_3_cb:checked').length){
                $('#p5_3').prop("disabled",false);
                return;
            }
            else {
                $('#p5_3').prop("disabled", true);
            }
        });
    });
</script>