@extends('covan.covan_nav')
@section('title','Trang duyệt bảng điểm')
@section('noidung')
<div class="container">
	<h3 class="text-sm-center tieude" style="margin:0 auto -1% auto;">Trang duyệt bảng điểm lần 2</h3>
	<div class="row justify-content-sm-center tieudebangthongke">
		<h5><i style="font-size: 100%;" class="fas fa-address-book"></i> {{$lop->ten_lop}}</h5>
		<input type="hidden" id="lop" name="lop" value="{{$lop->id}}">
		<input type="hidden" id="hocky" name="lop" value="{{$hocky->id}}">
	</div>

	<div class="thongke" >
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr style="background-color: #014c7f;color: white;">
						<th scope="col">Họ tên</th>
						<th scope="col" class="text-center">MSSV</th>
						<th scope="col"  class="text-center">Điểm chấm lần 1</th>
						<th scope="col"  class="text-center">Điểm chấm lần 2</th>
						<th scope="col"  class="text-center">Đã chấm lần 2</th>
						<th scope="col"  class="text-center">Loại</th>
						<th scope="col" style="width: 10%;"  class="text-center"></th>
					</tr>
				</thead>
				<tbody id="bang">
					
					<tr>
						<th scope="row" colspan="6" class="text-center">Chưa có dữ liệu!</th>
						
					</tr>
					
					<!-- <tr>
						<th scope="row">Khá</th>
						<td class="text-center">0</td>
						<td class="text-center">0</td>
						<td class="text-center"></td>
						<td class="text-center"></td>
						<td class="text-center"></td>
					</tr>
					<tr>
						<th scope="row">Trung bình</th>
						<td class="text-center">0</td>
						<td class="text-center">0</td>
						<td class="text-center"></td>
						<td class="text-center"></td>
						<td class="text-center"></td>
					</tr>
					<tr>
						<th scope="row">Yếu</th>
						<td class="text-center">0</td>
						<td class="text-center">0</td>
						<td class="text-center"></td>
						<td class="text-center"></td>
						<td class="text-center"></td>
					</tr> -->
				</tbody>
			</table>
		</div>
	</div>
</div>
<script >
	$(document).ready(function() {
		//$('#namhoc').change(function(event) {
			// var idlop = $('#lop').val()
			// $.get('thongkenamhoc/'+idlop,function(namhoc){
			// 		$("#namhoc").html(namhoc);
			// });
			//var idnamhoc = $('#namhoc').val()
			//$.get('thongkenamhoc/'+idnamhoc,function(hocky){
				//$("#hocky").html(hocky);
			//});
			//console.log(idnamhoc)
		//});
		// Xử lý phần click nút thống kê
		//$('#thongke').click(function(event) {
			var lop = $('#lop').val();
			//var namhoc = $('#namhoc').val();
			var hocky = $('#hocky').val();
			//console.log(hocky);
			//if (namhoc == '0') {
				//alert('Vui lòng chọn năm học!');
				//return false;
			//}
			//else{
				//if (hocky == null) {
					//alert('Năm học này chưa có học kỳ nào!');
				//}
				//else{
					$.get('{{asset('covan/danhsachduyetlan2/')}}/'+lop+'/'+hocky,function(ketqua) {
						$("#bang").html(ketqua);
					});
				//}
			//}
			
		//});
	});
</script>
@endsection