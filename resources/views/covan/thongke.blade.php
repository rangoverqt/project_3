@extends('covan.covan_nav')
@section('title','Trang thống kê')
@section('noidung')
<div class="container">
	<h3 class="text-sm-center tieude" style="margin:0 auto -1% auto;">Trang thống kê</h3>
	<div class="row justify-content-sm-center tieudebangthongke">
		<h5><i style="font-size: 100%;" class="fas fa-chart-pie"></i> {{$lop->ten_lop}}</h5>
		<input type="hidden" id="lop" name="lop" value="{{$lop->id}}">
	</div>
	<div class="row">
		<!-- <div class="col-sm-3">
			<div class="form-group">
				<label for="sel1">Lớp:</label>
				<select class="form-control" id="lop" name="lop">

					<option value="{{$lop->id}}">{{$lop->ten_lop}}</option>

				</select>
			</div>
		</div> -->
		<div class="col-sm-5">
			<div class="form-group">
				<label for="sel1">Năm học:</label>
				<select class="form-control" id="namhoc" name="namhoc">
					<option value="0">Chọn năm học</option>
					@foreach($lop_nh as $lop_nh)
					@for($i = 0;$i<$namhoc->count();$i++)
					@if($lop_nh->id_nh == $namhoc[$i]->id)
					<option value="{{$namhoc[$i]->id}}">{{$namhoc[$i]->namhoc}}</option>
					@endif
					@endfor
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label for="sel1">Học kỳ:</label>
				<select class="form-control" id="hocky" name="hocky">

				</select>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-control" style="margin-top: 10%;background: #014c7f;">
				<button class="btn btn-block btn-success" id="thongke"><i class="fas fa-chart-bar"></i> Thống kê</button>
			</div>
		</div>
	</div>

	<div class="thongke" id="bang">
		<div class="table-responsive">
			<!-- <div class="row justify-content-sm-center tieudebangthongke">
				<h5><i style="font-size: 100%;" class="fas fa-chart-pie"></i> {{$lop->ten_lop}}</h5>
			</div> -->
			<table class="table table-hover">
				<thead>
					<tr style="background-color: #014c7f;color: white;">
						<th scope="col">Loại</th>
						<th scope="col" width="10%" class="text-center">Số lượng</th>
						<th scope="col" width="10%"  class="text-center">Tỉ lệ %</th>
						<th scope="col" style="width: 10%;"  class="text-center"></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row">Giỏi</th>
						<td class="text-center">0</td>
						<td class="text-center">0</td>
						<td class="text-center"></td>
					</tr>
					<tr>
						<th scope="row">Khá</th>
						<td class="text-center">0</td>
						<td class="text-center">0</td>
						<td class="text-center"></td>
					</tr>
					<tr>
						<th scope="row">Trung bình</th>
						<td class="text-center">0</td>
						<td class="text-center">0</td>
						<td class="text-center"></td>
					</tr>
					<tr>
						<th scope="row">Yếu</th>
						<td class="text-center">0</td>
						<td class="text-center">0</td>
						<td class="text-center"></td>
					</tr>
				</tbody>

				<thead>
					<tr style="background-color: #014c7f;color: white;">
						<th scope="col">Chứng chỉ</th>
						<th scope="col" class="text-center">Số lượng</th>
						<th scope="col" class="text-center">Tỉ lệ %</th>
						<th scope="col" class="text-center"></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row">Chứng chỉ A(và tương đương)</th>
						<td class="text-center">0</td>
						<td class="text-center">0</td>
						<td class="text-center"></td>
					</tr>
					<tr>
						<th scope="row">Chứng chỉ B(và tương đương)</th>
						<td class="text-center">0</td>
						<td class="text-center">0</td>
						<td class="text-center"></td>
					</tr>
					<tr>
						<th scope="row">Chứng chỉ C(và tương đương)</th>
						<td class="text-center">0</td>
						<td class="text-center">0</td>
						<td class="text-center"></td>
					</tr>
					<tr>
						<th scope='row'>Chứng nhận Toefl  ≥ 450 điểm; IELTS ≥ 4,5; TOEIC ≥ 450 điểm</th>
						<td class="text-center">0</td>
						<td class="text-center">0</td>
						<td class="text-center"></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script >
	$(document).ready(function() {
		$('#namhoc').change(function(event) {
			// var idlop = $('#lop').val()
			// $.get('thongkenamhoc/'+idlop,function(namhoc){
			// 		$("#namhoc").html(namhoc);
			// });
			var idnamhoc = $('#namhoc').val()
			$.get('thongkenamhoc/'+idnamhoc,function(hocky){
				$("#hocky").html(hocky);
			});
			console.log(idnamhoc)
		});
		// Xử lý phần click nút thống kê
		$('#thongke').click(function(event) {
			var lop = $('#lop').val();
			var namhoc = $('#namhoc').val();
			var hocky = $('#hocky').val();
			console.log(hocky);
			if (namhoc == '0') {
				alert('Vui lòng chọn năm học!');
				return false;
			}
			else{
				if (hocky == null) {
					alert('Năm học này chưa có học kỳ nào!');
				}
				else{
					$.get('ketquathongke/'+lop+'/'+hocky,function(ketqua) {
						$("#bang").html(ketqua);
					});
				}
			}
			
		});
	});
</script>
@endsection