<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 26/11/18
 * Time: 3:26 PM
 */
?>
@include('layout/header')
<div class="container">
<div class="turnback">
    <a href="#">Trở về</a>
</div>
    <h4>Thống kê thành tích rèn luyện</h4>
    <div class="tt_hk">
        <div class="form-group">
    <label><strong>Năm học:</strong>
    <select class="form-control">
        <option value="0">Chọn</option>
        <option></option>
    </select>
    </label>
    <label><strong>Học kỳ:</strong>
        <select class="form-control">
            <option value="0">Chọn</option>
            <option></option>
        </select>
    </label>
        </div>
    </div>
    <h5>Thống kê chứng chỉ ngoại ngữ:</h5>
        <table class="table table1 table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>Văn bằng ngoại ngữ, tin học</th>
                <th>Số lượng</th>
                <th>Xem chi tiết</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Chứng chỉ A</td>
                <td id="diem">0</td>
                <td id="diem"><a href="#">Xem</a></td>
            </tr>
            <tr>
                <td>Chứng chỉ B</td>
                <td id="diem">0</td>
                <td id="diem"><a href="#">Xem</a></td>
            </tr>
            <tr>
                <td>Chứng chỉ C</td>
                <td id="diem">0</td>
                <td id="diem"><a href="#">Xem</a></td>
            </tr>
            <tr>
                <td>Chứng chỉ ngoại ngữ, Chứng nhận Toefl ≥ 450 điểm; IELTS ≥ 4,5; TOEIC ≥ 450 điểm</td>
                <td id="diem">0</td>
                <td id="diem"><a href="#">Xem</a></td>
            </tr>
            </tbody>
        </table>
    <h5>Thống kê xếp loại rèn luyện:</h5>
    <table class="table table-hover table-striped table-bordered">
        <thead>
        <tr>
            <th>Xếp loại</th>
            <th>Số lượng</th>
            <th>Xem chi tiết</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Xuất sắc</td>
        </tr>
        <tr>
            <td>Tốt</td>
        </tr>
        <tr>
            <td>Khá</td>
        </tr>
        <tr>
            <td>Trung bình khá</td>
        </tr>
        <tr>
            <td>Trung bình</td>
        </tr>
        <tr>
            <td>Yếu</td>
        </tr>
        <tr>
            <td>Kém</td>
        </tr>
        </tbody>
    </table>
    </div>
<div class="container-fluid footer">
    <h5>Copyright &copy; 2015</h5>
</div>