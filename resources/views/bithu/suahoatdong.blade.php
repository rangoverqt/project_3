@extends('bithu.bithu_nav')
@section('title','Sửa hoạt động')
@section('noidung')
<div class="container">
	@if(session('thongbao'))
		<div class="alert alert-success">
			{{session('thongbao')}}
		</div>
		@endif
	<h3 class="text-sm-center tieude">Sửa hoạt động</h3>
	<form action="{{asset('bithu/updatehoatdong/'.$hoatdong->id)}}" method="post">
		@csrf
			<div class="form-group">
				<label >Tên hoạt động:</label>
				<textarea class="form-control" id="tenhoatdong" name="tenhoatdong" required oninput="setCustomValidity('')">{{$hoatdong->ten_hoatdong}}</textarea>
			</div>
			<div class="form-group row">
				<div class="col-sm-3">
					<label for="pwd">Điểm:</label>
					<input type="number" class="form-control" id="diem" pattern="[0-9]" min="0" max="10" required name="diem" oninput="setCustomValidity('')" value="{{$hoatdong->diem}}">
				</div>
				<div class="col-sm-6">
					<label for="pwd">Số lượng:</label>
					<input type="number" class="form-control" id="soluong" pattern="[0-9]" min="0" required name="soluong" oninput="setCustomValidity('')" value="{{$hoatdong->soluong}}">
				</div>
				<div class="col-sm-3">
				<label for="pwd">Thi đua thành tích:</label>
				<select class="form-control" id="thanhtich" name="thanhtich">
					@if($hoatdong->thanh_tich == 1)
				    <option value="1">Có</option>
				    <option value="0">Không</option>
				    @else
				    <option value="0">Không</option>
				    <option value="1">Có</option>
				    @endif
				 </select>
			</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-6">
					<label for="pwd">Ngày hoạt động:</label>
					<div class="row">
						<div class="col-sm-5">
							<input type="date" class="form-control" id="ngaybatdau" required name="ngaybatdau" oninput="setCustomValidity('')" value="{{$hoatdong->ngay_bd}}">
						</div>
						<div class="col-sm-2">đến</div>
						<div class="col-sm-5">
							<input type="date" class="form-control" id="ngayketthuc" required name="ngayketthuc" oninput="setCustomValidity('')" value="{{$hoatdong->ngay_kt}}">
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<label for="pwd">Thời gian:</label>
					<div class="row">
						<div class="col-sm-5">
							<input type="time" class="form-control" id="thoigianbatdau" pattern="[0-9]" min="0" max="10" name="thoigianbatdau" oninput="setCustomValidity('')" value="{{$hoatdong->thoigian_bd}}">
						</div>
						<div class="col-sm-2">đến</div>
						<div class="col-sm-5">
							<input type="time" class="form-control" id="thoigianketthuc" pattern="[0-9]" min="0" max="10" name="thoigianketthuc" oninput="setCustomValidity('')" value="{{$hoatdong->thoigian_kt}}">
						</div>
					</div>
					
				</div>
			</div>
			<button type="submit" class="btn btn-block btn-warning col-sm-6 offset-sm-3">Sửa hoạt động</button>
	</form>
</div>
<script>
	// Kiểm tra xem người dùng có nhập vào tên hoạt động hay chưa
	var input = document.getElementById('tenhoatdong');
	input.oninvalid = function(event) {
	    event.target.setCustomValidity('Vui lòng nhập tên hoạt động vào');
	};
	//Kiểm tra số lượng tham gia hoạt động
	var input = document.getElementById('soluong');
	input.oninvalid = function(event) {
	    event.target.setCustomValidity('Vui lòng nhập số lượng của lớp');
	};
	var input = document.getElementById('diem');
	input.oninvalid = function(event) {
	    event.target.setCustomValidity('Vui lòng nhập điểm cho hoạt động');
	};
	var input = document.getElementById('ngaybatdau');
	input.oninvalid = function(event) {
	    event.target.setCustomValidity('Vui lòng nhập ngày bắt đầu');
	};
	var input = document.getElementById('ngayketthuc');
	input.oninvalid = function(event) {
	    event.target.setCustomValidity('Vui lòng nhập ngày kết thúc');
	};
	
</script>
@endsection