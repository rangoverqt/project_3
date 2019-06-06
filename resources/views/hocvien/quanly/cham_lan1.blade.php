<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 26/11/18
 * Time: 3:00 AM
 */
?>
@include('layout/header')
<div class="container">
    <div class="turnback"><a href="/doan3/public/hocvien/loptruong/bangdiemlan1/{{$hocvien -> lop -> id}}">Trở về</a></div>
    <div class="tt_sv">
        <h4>Thông tin sinh viên:</h4>
        <p><strong>Mã số sinh viên:</strong> {{$hocvien -> mssv}}</p>
        <p><strong>Họ tên:</strong> {{$hocvien -> hoten}}</p>
        <p><strong>Lớp:</strong> {{$hocvien -> lop -> ten_lop}}</p>
    </div>
    <div class="tt_hk">
        <h5>Chấm điểm lần 1</h5>
        <p><strong>Năm học: </strong>{{$chucvu_hk -> hocky -> namhoc -> namhoc}}</p>
        <p><strong>Học kỳ: </strong>{{$chucvu_hk -> hocky -> hocky}}</p>
    </div>
    <form action="" method="post">
        @csrf
        <input hidden name="hocky" value="{{$chucvu_hk -> hocky -> id}}">
        <div class="bang1">
            <table class="table table1 table-bordered table-striped table-hover">
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
                        <input placeholder="Nhập"
                               type="number"
                               id="p1_a_1"
                               name="p1_a_1"
                               min=0
                               max=10
                               maxlength=2
                               class="p1"
                        ></td>
                </tr>
                <tr>
                    <td>- Không vi phạm quy chế về thi, kiểm tra</td>
                    <td id="diem">10</td>
                    <td id="diem">
                        <input placeholder="Nhập"
                               type="number"
                               id="p1_a_2"
                               name="p1_a_2"
                               min=0
                               max=10
                               maxlength=2
                               class="p1"
                        ></td>
                </tr>
                <tr>
                    <td>- Kết quả học tập trong học kỳ: Điểm trung bình chung học kỳ (ĐTBCHK)</td>
                </tr>
                <tr>
                    <td id="dtb">ĐTBCHK đạt ≥ 3,60</td>
                    <td id="diem">8</td>
                    <td id="diem"><input type="checkbox" name="p1_a_3" id="cb1" value="8" class="p1_cb"></td>
                </tr>
                <tr>
                    <td id="dtb">ĐTBCHK đạt  từ  3,20 đến 3,59</td>
                    <td id="diem">6</td>
                    <td id="diem"><input type="checkbox" name="p1_a_3" id="cb2" value="6" class="p1_cb"></td>
                </tr>
                <tr>
                    <td id="dtb">ĐTBCHK đạt  từ  2,50 đến 3,19 </td>
                    <td id="diem">4</td>
                    <td id="diem"><input type="checkbox" name="p1_a_3" id="cb3" value="4" class="p1_cb"></td>
                </tr>
                <tr>
                    <td id="dtb">ĐTBCHK đạt  từ  2,00 đến 2,49</td>
                    <td id="diem">2</td>
                    <td id="diem"><input type="checkbox" name="p1_a_3" id="cb4" value="2" class="p1_cb"></td>
                </tr>
                <tr>
                    <td id="dtb">ĐTBCHK dưới 2,00</td>
                    <td id="diem">0</td>
                    <td id="diem"><input type="checkbox" name="p1_a_3" id="cb5" value="0" class="p1_cb"></td>
                </tr>
                <tr>
                    <td>- Có cố gắng, vượt khó trong học tập (có ĐTB học kỳ sau lớn hơn học kỳ trước đó;  đối với<br>
                        SV năm thứ nhất, học kỳ I  không có điểm F)</td>
                    <td id="diem">2</td>
                    <td id="diem"><input placeholder="Nhập"
                                         type="number"
                                         id="p1_a_4"
                                         name="p1_a_4"
                                         min=0
                                         max=2
                                         class="p1"
                                         maxlength=2
                        ></td>
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
                    <td id="diem"><input type="checkbox" value="4" name="chungchi_a" id="chungchi_a" class="p1_cb"></td>
                </tr>
                <tr>
                    <td>- Chứng chỉ B (và  tương đương)</td>
                    <td id="diem">5</td>
                    <td id="diem"><input type="checkbox" value="5" name="chungchi_b" id="chungchi_b" class="p1_cb"></td>
                </tr>
                <tr>
                    <td>- Chứng chỉ C (và  tương đương)</td>
                    <td id="diem">6</td>
                    <td id="diem"><input type="checkbox" value="6" name="chungchi_c" id="chungchi_c" class="p1_cb"></td>
                </tr>
                <tr>
                    <td>- Riêng chứng chỉ ngoại ngữ, Chứng nhận Toefl  ≥ 450 điểm; IELTS ≥ 4,5; TOEIC ≥ 450 điểm.</td>
                    <td id="diem">10</td>
                    <td id="diem"><input type="checkbox" value="10" name="toeic" id="toeic" class="p1_cb"></td>
                </tr>
                <tr>
                    <td><strong>Điểm  cộng tối đa của mục 1 là 30 điểm</strong></td>
                    <td></td>
                    <td id="diem"><input type="number" name="result1" class="tong" id="result1" readonly maxlength="2"></td>
                </tr>
                <tr>
                    <td><strong>2. Đánh giá về ý thức và kết quả chấp hành nội quy, quy chế trong nhà trường</strong><br>
                        (Điều 6 – Quy chế đánh giá kết quả rèn luyện…)</td>
                </tr>
                <tr>
                    <td>- Không vi phạm và có ý thức tham gia thực hiện nghiêm túc các quy định của Lớp, nội quy,<br>
                        quy chế của Trường, Khoa và các tổ chức trong nhà trường</td>
                    <td id="diem">15</td>
                    <td id="diem"><input placeholder="Nhập"
                                         type="number"
                                         id="p2_1"
                                         name="p2_1"
                                         min=0
                                         max=15
                                         maxlength=2
                                         class="p2"
                        ></td>
                </tr>
                <tr>
                    <td>- Sinh viên có tích cực tham gia các hoạt động tuyên truyền, vận động mọi người xung quanh<br>
                        thực hiện nghiêm túc nội quy, quy chế, các quy định của nhà trường về:</td>
                </tr>
                <tr>
                    <td id="dtb">Giữ gìn an ninh, trật tự nơi công cộng</td>
                    <td id="diem">10</td>
                    <td id="diem"><input placeholder="Nhập"
                                         type="number"
                                         id="p2_2_1"
                                         name="p2_2_1"
                                         min=0
                                         max=10
                                         maxlength=2
                                         class="p2"
                        ></td>
                </tr>
                <tr>
                    <td id="dtb">Giữ gìn vệ sinh, bảo vệ cảnh quan môi trường, nếp sống văn minh <br>
                        (có xác nhận của đoàn thể, Khoa, Trường...).</td>
                    <td id="diem">10</td>
                    <td id="diem"><input placeholder="Nhập"
                                         type="number"
                                         id="p2_2_2"
                                         name="p2_2_2"
                                         min=0
                                         max=10
                                         maxlength=2
                                         class="p2"
                        ></td>
                </tr>
                <tr>
                    <td><strong>Điểm cộng tối đa của mục 2 là 25 điểm</strong></td>
                    <td></td>
                    <td id="diem"><input name="result2" id="result2" class="tong" readonly maxlength="2" type="number"></td>
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
                    <td id="diem"><input placeholder="Nhập"
                                         type="number"
                                         id="p3_1"
                                         name="p3_1"
                                         min=0
                                         max=12
                                         maxlength=2
                                         class="p3"
                                         value="{{$sum}}"
                                         readonly
                        ></td>
                    <td id="diem"><a data-toggle="tooltip" data-html="true" rel="tooltip" data-original-title='
                <strong>Các hoạt động đã tham gia</strong>
                <ul>
                @if($hoatdong == 0)
                                <li>Không tham gia hoạt động</li>
                                @else
                @foreach($hoatdong as $key => $pd)
                        @foreach($pd as $pd1)
                                <li>{{$pd1 -> hoatdong -> ten_hoatdong}}</li>
                            @endforeach
                        @endforeach
                        @endif
                                </ul>
'>Hơ chuột</a></td>
                </tr>
                <tr>
                    <td>- Là lực lượng nòng cốt trong các phong trào văn hóa, văn nghệ, thể thao:</td>
                </tr>
                <tr>
                    <td id="dtb">Cấp Chi đoàn, Chi hội, Đội, Nhóm, Câu lạc bộ.</td>
                    <td id="diem">4</td>
                    <td id="diem"><input placeholder="Nhập"
                                         type="number"
                                         id="p3_2_1"
                                         name="p3_2_1"
                                         min=0
                                         max=4
                                         maxlength=2
                                         class="p3"
                        ></td>
                </tr>
                <tr>
                    <td id="dtb">Cấp Khoa (và tương đương), Trường</td>
                    <td id="diem">5</td>
                    <td id="diem"><input placeholder="Nhập"
                                         type="number"
                                         id="p3_2_2"
                                         name="p3_2_2"
                                         min=0
                                         max=5
                                         maxlength=2
                                         class="p3"
                        ></td>
                </tr>
                <tr>
                    <td>- Được khen thưởng trong các hoạt động phong trào</td>
                </tr>
                <tr>
                    <td id="dtb">Quyết định khen thưởng của Đoàn Khoa  (và tương đương)</td>
                    <td id="diem">6</td>
                    <td id="diem"><input placeholder="Nhập"
                                         type="number"
                                         id="p3_3_1"
                                         name="p3_3_1"
                                         min=0
                                         max=6
                                         maxlength=2
                                         class="p3"
                                         value="{{$diem_tt}}"
                                         readonly
                        ></td>
                    <td id="diem"><a data-toggle="tooltip" data-html="true" rel="tooltip" data-original-title='
                <strong>Thành tích hoạt động</strong>
                <ul>
                @if($hoatdong_tt == 0)
                                <li>Không có thành tích</li>
                                @else
                @foreach($hoatdong_tt as $key => $pd)
                        @foreach($pd as $pd1)
                                <li>{{$pd1 -> hoatdong -> ten_hoatdong}}:
                            <ul>
                            @foreach($test as $te)
                                @if($te -> id_hoatdong == $pd1 -> hoatdong -> id)
                            @if($te -> hang == 1)
                                <li>Hạng nhất</li>
@elseif($te -> hang == 2)
                                <li>Hạng hai</li>
@elseif($te -> hang == 3)
                                <li>Hạng ba</li>
@else
                                <li>Hạng khuyến khích</li>
@endif
                                @endif
                                @endforeach
                                </ul>
                                </li>
@endforeach
                        @endforeach
                        @endif
                                </ul>
'>Hơ chuột</a></td>
                </tr>
                <tr>
                    <td id="dtb">Giấy khen cấp Trường</td>
                    <td id="diem">8</td>
                    <td id="diem"><input placeholder="Nhập"
                                         type="number"
                                         id="p3_3_2"
                                         name="p3_3_2"
                                         min=0
                                         max=8
                                         maxlength=2
                                         class="p3"
                        ></td>
                </tr>
                <tr>
                    <td id="dtb">Giấy khen cấp cao hơn</td>
                    <td id="diem">10</td>
                    <td id="diem"><input placeholder="Nhập"
                                         type="number"
                                         id="p3_3_3"
                                         name="p3_3_3"
                                         min=0
                                         max=10
                                         maxlength=2
                                         class="p3"
                        ></td>
                </tr>
                <tr>
                    <td><strong>Điểm cộng tối đa của mục 3 là 20 điểm</strong></td>
                    <td></td>
                    <td id="diem"><input name="result3" id="result3" class="tong" readonly maxlength="2" type="number"></td>
                </tr>
                <tr>
                    <td><strong>4. Đánh giá về phẩm chất công dân và quan hệ với cộng đồng</strong><br>
                        (Điều 8 – Quy chế đánh giá kết quả rèn luyện…)</td>
                </tr>
                <tr>
                    <td>- Không vi phạm pháp luật của Nhà nước.</td>
                    <td id="diem">6</td>
                    <td id="diem"><input type="checkbox" value="6" name="p4_1" id="p4_1" class="p4_cb"></td>
                </tr>
                <tr>
                    <td>- Có tinh thần giúp đỡ bạn bè trong học tập, trong cuộc sống </td>
                    <td id="diem">4</td>
                    <td id="diem"><input type="checkbox" value="4" name="p4_2" id="p4_2" class="p4_cb"></td>
                </tr>
                <tr>
                    <td>- Tham gia đội, nhóm, câu lạc bộ sinh hoạt hướng đến lợi ích cộng đồng<br>
                        (tham gia công tác xã hội ở Trường, nơi cư trú, địa phương).</td>
                    <td id="diem">10</td>
                    <td id="diem"><input placeholder="Nhập"
                                         type="number"
                                         id="p4_3"
                                         name="p4_3"
                                         min=0
                                         max=10
                                         maxlength=2
                                         class="p4"
                        ></td>
                </tr>
                <tr>
                    <td><strong>Điểm cộng tối đa của mục 4 là 15 điểm</strong></td>
                    <td></td>
                    <td id="diem"><input name="result4" id="result4" class="tong" readonly maxlength="2" type="number"></td>
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
                    <td id="diem"><input placeholder="Nhập"
                                         type="number"
                                         id="p5_1"
                                         name="p5_1"
                                         min=0
                                         max=10
                                         maxlength=2
                                         class="p5"
                        ></td>
                </tr>
                <tr>
                    <td>- Là thành viên của Ban Cán sự lớp, Ban Chấp hành chi đoàn, Ban Chấp hành Liên Chi hội<br>
                        sinh viên, Chi hội sinh viên, Ban Chủ nhiệm các Đội, Nhóm, Câu lạc bộ (trừ các thành viên<br>
                        nêu  mục trên), đã hoàn thành nhiệm vụ được giao</td>
                    <td id="diem">6</td>
                    <td id="diem"><input placeholder="Nhập"
                                         type="number"
                                         id="p5_2"
                                         name="p5_2"
                                         min=0
                                         max=6
                                         maxlength=2
                                         class="p5"
                        ></td>
                </tr>
                <tr>
                    <td>- Được kết nạp Đảng, hoặc được công nhận Đoàn viên ưu tú</td>
                    <td id="diem">6</td>
                    <td id="diem"><input placeholder="Nhập"
                                         type="number"
                                         id="p5_3"
                                         name="p5_3"
                                         min=0
                                         max=6
                                         maxlength=2
                                         class="p5"
                        ></td>
                </tr>
                <tr>
                    <td><strong>Điểm cộng tối đa của mục 5 là 10 điểm</strong></td>
                    <td></td>
                    <td id="diem"><input name="result5" id="result5" class="tong" readonly maxlength="2" type="number"></td>
                </tr>
                <tr>
                    <td style="text-align: center"><strong>Cộng các mục 1,2,3,4,5</strong></td>
                    <td></td>
                    <td id="diem"><input id="total" readonly maxlength="2" type="number"></td>
                    <td><input type="button" class="sum" value="Cộng tổng"></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="ketluan">
            <h4>Kết luận của lớp trưởng:</h4>
            <p><strong>Điểm rèn luyện:</strong><input id ="total1" readonly maxlength="2" type="number"></p>
            <p><strong>Xếp loại:</strong><input id ="xl" readonly type="text"></p>
        </div>
        <input type="submit" value="Gửi bảng điểm">
    </form>
</div>

<div class="container-fluid footer">
    <h5>Copyright &copy; 2015</h5>
</div>
{{--<script>--}}
{{--function maxLengthCheck(object) {--}}
{{--if (object.value.length > object.max.length)--}}
{{--object.value = object.value.slice(0, object.max.length)--}}
{{--}--}}

{{--function isNumeric (evt) {--}}
{{--var theEvent = evt || window.event;--}}
{{--var key = theEvent.keyCode || theEvent.which;--}}
{{--key = String.fromCharCode (key);--}}
{{--var regex = /[0-9]|\./;--}}
{{--if ( !regex.test(key) ) {--}}
{{--theEvent.returnValue = false;--}}
{{--if(theEvent.preventDefault) theEvent.preventDefault();--}}
{{--}--}}
{{--}--}}
{{--</script>--}}
<script>
    $('#p1_a_1').on('input', function () {

        var value = $(this).val();

        if ((value !== '') && (value.indexOf('.') === -1)) {

            $(this).val(Math.max(Math.min(value, 10), 0));
        }
    });
    $('#p1_a_2').on('input', function () {

        var value = $(this).val();

        if ((value !== '') && (value.indexOf('.') === -1)) {

            $(this).val(Math.max(Math.min(value, 10), 0));
        }
    });
    $(document).ready(function(){
        $('#cb1').on('change', function(){
            if($('#cb1:checked').length){
                $('#cb2').prop({ disabled: true, checked: false});
                $('#cb3').prop({ disabled: true, checked: false});
                $('#cb4').prop({ disabled: true, checked: false});
                $('#cb5').prop({ disabled: true, checked: false});
                return;
            }
            else {
                $('#cb2').prop('disabled', false);
                $('#cb3').prop('disabled', false);
                $('#cb4').prop('disabled', false);
                $('#cb5').prop('disabled', false);
            }
        });
        $('#cb2').on('change', function(){
            if($('#cb2:checked').length){
                $('#cb1').prop({ disabled: true, checked: false});
                $('#cb3').prop({ disabled: true, checked: false});
                $('#cb4').prop({ disabled: true, checked: false});
                $('#cb5').prop({ disabled: true, checked: false});
                return;
            }
            else {
                $('#cb1').prop('disabled', false);
                $('#cb3').prop('disabled', false);
                $('#cb4').prop('disabled', false);
                $('#cb5').prop('disabled', false);
            }
        });
        $('#cb3').on('change', function(){
            if($('#cb3:checked').length){
                $('#cb2').prop({ disabled: true, checked: false});
                $('#cb1').prop({ disabled: true, checked: false});
                $('#cb4').prop({ disabled: true, checked: false});
                $('#cb5').prop({ disabled: true, checked: false});
                return;
            }
            else {
                $('#cb2').prop('disabled', false);
                $('#cb1').prop('disabled', false);
                $('#cb4').prop('disabled', false);
                $('#cb5').prop('disabled', false);
            }
        });
        $('#cb4').on('change', function(){
            if($('#cb4:checked').length){
                $('#cb2').prop({ disabled: true, checked: false});
                $('#cb1').prop({ disabled: true, checked: false});
                $('#cb3').prop({ disabled: true, checked: false});
                $('#cb5').prop({ disabled: true, checked: false});
                return;
            }
            else {
                $('#cb2').prop('disabled', false);
                $('#cb1').prop('disabled', false);
                $('#cb3').prop('disabled', false);
                $('#cb5').prop('disabled', false);
            }
        });
        $('#cb5').on('change', function(){
            if($('#cb5:checked').length){
                $('#cb2').prop({ disabled: true, checked: false});
                $('#cb1').prop({ disabled: true, checked: false});
                $('#cb3').prop({ disabled: true, checked: false});
                $('#cb4').prop({ disabled: true, checked: false});
                return;
            }
            else {
                $('#cb2').prop('disabled', false);
                $('#cb1').prop('disabled', false);
                $('#cb3').prop('disabled', false);
                $('#cb4').prop('disabled', false);
            }
        });
        $('#p1_a_4').on('input', function () {

            var value = $(this).val();

            if ((value !== '') && (value.indexOf('.') === -1)) {

                $(this).val(Math.max(Math.min(value, 2), 0));
            }
        });
        function calculate(){
            var sum = 0;
            $(".p1").each(function(){
                sum += +$(this).val();
            });
            var total = 0;
            var checkbox = document.getElementsByClassName('p1_cb');
            for (var i = 0; checkbox[i]; ++i) {

                if (checkbox[i].checked) {
                    var value = checkbox[i].value;
                    total += Number(checkbox[i].value);
                }
            }
            var checkTotal = sum + total;
            if (checkTotal > 30){
                alert('Số điểm tối đa mục 1 là 30 điểm');
                $('#result1').val(30);
            }
            else {
                $('#result1').val(sum + total);
            }
        }
        $('.p1').on("change", function() {
            calculate();
        });
        $('.p1_cb').change(function ()
        {
            calculate();
        });

        $('#p2_1').on('input', function () {

            var value = $(this).val();

            if ((value !== '') && (value.indexOf('.') === -1)) {

                $(this).val(Math.max(Math.min(value, 15), 0));
            }
        });

        $('#p2_2_1').on('input', function () {

            var value = $(this).val();

            if ((value !== '') && (value.indexOf('.') === -1)) {

                $(this).val(Math.max(Math.min(value, 10), 0));
            }
        });

        $('#p2_2_2').on('input', function () {

            var value = $(this).val();

            if ((value !== '') && (value.indexOf('.') === -1)) {

                $(this).val(Math.max(Math.min(value, 10), 0));
            }
        });

        $('.p2').on('change',function () {
            var sum = 0;
            $(".p2").each(function(){
                sum += +$(this).val();
            });
            if (sum > 25){
                alert('Điểm cộng tối đa mục 2 là 25');
                $('#result2').val(25)
            }
            else {
                $('#result2').val(sum);
            }
        });

        $("[rel=tooltip]").tooltip({html:true});

        $('#p3_2_1').on('input', function () {

            var value = $(this).val();

            if ((value !== '') && (value.indexOf('.') === -1)) {

                $(this).val(Math.max(Math.min(value, 4), 0));
            }
        });

        $('#p3_2_2').on('input', function () {

            var value = $(this).val();

            if ((value !== '') && (value.indexOf('.') === -1)) {

                $(this).val(Math.max(Math.min(value, 5), 0));
            }
        });

        $('#p3_3_2').on('input', function () {

            var value = $(this).val();

            if ((value !== '') && (value.indexOf('.') === -1)) {

                $(this).val(Math.max(Math.min(value, 8), 0));
            }
        });

        $('#p3_3_3').on('input', function () {

            var value = $(this).val();

            if ((value !== '') && (value.indexOf('.') === -1)) {

                $(this).val(Math.max(Math.min(value, 10), 0));
            }
        });

        $('.p3').on('change',function () {
            var sum_more = '<?php $sum + $diem_tt ?>';
            var sum = 0;
            $(".p3").each(function(){
                sum += +$(this).val();
            });
            if (sum > 20){
                alert('Điểm cộng tối đa mục 3 là 20');
                $('#result3').val(20)
            }
            else {
                $('#result3').val(sum + sum_more);
            }
        });
        var p3_1 = document.getElementById('p3_1');
        var p3_3_1 = document.getElementById('p3_3_1');

        var val1 = p3_1.value;
        var val2 = parseInt(p3_3_1.value) + parseInt(val1);

        $('#result3').val(val2);


        $('#p4_3').on('input', function () {

            var value = $(this).val();

            if ((value !== '') && (value.indexOf('.') === -1)) {

                $(this).val(Math.max(Math.min(value, 10), 0));
            }
        });

        function calculate1(){
            var sum = 0;
            $(".p4").each(function(){
                sum += +$(this).val();
            });
            var total = 0;
            var checkbox = document.getElementsByClassName('p4_cb');
            for (var i = 0; checkbox[i]; ++i) {

                if (checkbox[i].checked) {
                    var value = checkbox[i].value;
                    total += Number(checkbox[i].value);
                }
            }
            var checkTotal = sum + total;
            if (checkTotal > 15){
                alert('Số điểm tối đa mục 4 là 15 điểm');
                $('#result4').val(15);
            }
            else {
                $('#result4').val(sum + total);
            }
        }
        $('.p4').on("change", function() {
            calculate1();
        });
        $('.p4_cb').change(function ()
        {
            calculate1();
        });

        $('#p5_1').on('input', function () {

            var value = $(this).val();

            if ((value !== '') && (value.indexOf('.') === -1)) {

                $(this).val(Math.max(Math.min(value, 10), 0));
            }
        });

        $('#p5_2').on('input', function () {

            var value = $(this).val();

            if ((value !== '') && (value.indexOf('.') === -1)) {

                $(this).val(Math.max(Math.min(value, 6), 0));
            }
        });

        $('#p5_3').on('input', function () {

            var value = $(this).val();

            if ((value !== '') && (value.indexOf('.') === -1)) {

                $(this).val(Math.max(Math.min(value, 6), 0));
            }
        });
        $('.p5').on('change',function () {
            var sum = 0;
            $(".p5").each(function(){
                sum += +$(this).val();
            });
            if (sum > 10){
                alert('Điểm cộng tối đa mục 5 là 10')
                $('#result5').val(10)
            }
            else {
                $('#result5').val(sum);
            }
        });

        // $('.tong').on('change',function () {
        //     var re1 = document.getElementById('result1');
        //     var re2 = document.getElementById('result2');
        //     var re3 = document.getElementById('result3');
        //     var re4 = document.getElementById('result4');
        //     var re5 = document.getElementById('result5');
        //
        //     var reval1 = re1.value;
        //     var reval2 = re2.value;
        //     var reval3 = re3.value;
        //     var reval4 = re4.value;
        //     var reval5 = re5.value;
        // var sum = 0;
        // $('.tong').each(function () {
        //    sum += +$(this).val();
        // });
        // console.log(sum);
        // $('#total').val(reval1 + reval2 + reval3 + reval4 + reval5);
        // });
        $('.sum').click(function () {
            var sum = 0;
            $('.tong').each(function () {
                sum += +$(this).val();
            });
            $('#total').val(sum);
            $('#total1').val(sum);
            var ss = sum;
            if (ss >= 0 && ss <= 30){
                ss = "Yếu";
            }
            else if (ss > 30 && ss <= 50){
                ss = "Trung bình";
            }
            else if (ss > 50 && ss <= 60){
                ss = "Trung bình - Khá";
            }
            else if (ss > 60 && ss <= 70){
                ss = "Khá";
            }
            else if (ss > 70 && ss <= 80){
                ss = "Khá - Giỏi";
            }
            else if (ss > 80 && ss <= 90){
                ss = "Giỏi";
            }
            else if (ss > 90 && ss <= 100){
                ss = "Xuất sắc";
            }
            $('#xl').val(ss);
        });
    })
</script>