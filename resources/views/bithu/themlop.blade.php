@extends('bithu.bithu_nav')
@section('title','Thêm lớp')
@section('noidung')
<div class="container">
	<h3 class="text-sm-center tieude">Thêm lớp mới</h3>
	<form action="{{asset('bithu/insertlop')}}" method="post">
		@csrf
		<div class="form-group row">
			<div class="col-sm-6">
				<label for="email">Tên lớp:</label>
				<input type="text" class="form-control" id="tenlop" name="tenlop" required oninput="setCustomValidity('')">
			</div>
			<div class="col-sm-6">
				<label for="pwd">Số lượng:</label>
				<input type="number" class="form-control" id="soluong" pattern="[0-9]" min="0" required name="soluong" oninput="setCustomValidity('')">
			</div>
		</div>
		<div class="form-group row">
			<div class="col-sm-6">
				<label for="pwd">Ngành:</label>
				<select type="text" class="form-control" id="nganh" required name="nganh" oninput="setCustomValidity('')">
					<option value="0">-- Chọn ngành --</option>
					@foreach($nganh as $nganh)
					<option value="{{$nganh->id}}">{{$nganh->ten_nganh}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-sm-6">
				<label for="pwd">Năm học:</label>
				<div class="row">
					<div class="col-sm-6">
						<select type='text' class="form-control" id="namhoc_bd"  required name="namhoc_bd" oninput="setCustomValidity('')">
							<option value="0">-- Chọn năm bắt đầu --</option>
							@foreach($namhoc as $namhoc_bd)
							<option value="{{$namhoc_bd->id}}">{{$namhoc_bd->namhoc}}</option>
							@endforeach
						</select>
					</div>	
					<div class="col-sm-6">
						<select type='text' class="form-control" id="namhoc_kt"  required name="namhoc_kt" oninput="setCustomValidity('')">
							<option value="0">-- Chọn năm kết thúc --</option>
							@foreach($namhoc as $namhoc_kt)
							<option value="{{$namhoc_kt->id}}">{{$namhoc_kt->namhoc}}</option>
							@endforeach
						</select>
					</div>	
				</div>
				
				
			</div>
		</div>
		<button type="submit" id="themlop" class="btn btn-block btn-primary col-sm-6 offset-sm-3">Thêm lớp</button>
	</form>
</div>
@if (session('success'))
<script>
      alert("{{session('success')}}");
</script>
@endif
<script src="{{url('js/javascript_themlop.js')}}"></script>
@endsection