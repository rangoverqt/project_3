@extends('bithu.bithu_nav')
@section('title','Sửa lớp')
@section('noidung')
<div class="container">
	<h3 class="text-sm-center tieude">Sửa lớp</h3>
	<form action="{{asset('bithu/updatelop/'.$lop->id)}}" method="post">
		@csrf
		<div class="form-group row">
			<div class="col-sm-6">
				<label for="email">Tên lớp:</label>
				<input type="text" class="form-control" id="tenlop" name="tenlop" required oninput="setCustomValidity('')" value="{{$lop->ten_lop}}">
			</div>
			<div class="col-sm-6">
				<label for="pwd">Số lượng:</label>
				<input type="number" class="form-control" id="soluong" pattern="[0-9]" min="0" required name="soluong" oninput="setCustomValidity('')" value="{{$lop->soluong}}">
			</div>
		</div>
		<div class="form-group row">
			<div class="col-sm-6">
				<label for="pwd">Ngành:</label>
				<select type="text" class="form-control" id="nganh" required name="nganh" oninput="setCustomValidity('')">
					<option value="{{$nganh_id->id}}">{{$nganh_id->ten_nganh}}</option>
					@foreach($nganh as $nganh)
						@if($nganh_id->id == $nganh->id)
						@else
						<option value="{{$nganh->id}}">{{$nganh->ten_nganh}}</option>
						@endif
					@endforeach
				</select>
			</div>
			<div class="col-sm-6">
				<label for="pwd">Năm học:</label>
				<div class="row">
					<div class="col-sm-5">
						<select type='text' class="form-control" id="namhoc_bd"  required name="namhoc_bd" oninput="setCustomValidity('')">
							<option value="{{$namhoc_id_bd->id}}">{{$namhoc_id_bd->namhoc}}</option>
							@foreach($namhoc as $namhoc_bd)
								@if($namhoc_id_bd->id == $namhoc_bd->id)
								@else
								<option value="{{$namhoc_bd->id}}">{{$namhoc_bd->namhoc}}</option>
								@endif
							@endforeach
						</select>
					</div>
					<div class="col-sm-2">
						<p style="text-align: center;">đến</p>
					</div>
					<div class="col-sm-5">
						<select type='text' class="form-control" id="namhoc_kt"  required name="namhoc_kt" oninput="setCustomValidity('')">
							<option value="{{$namhoc_id_kt->id}}">{{$namhoc_id_kt->namhoc}}</option>
							@foreach($namhoc as $namhoc_kt)
								@if($namhoc_id_kt->id == $namhoc_kt->id)
								@else
								<option value="{{$namhoc_kt->id}}">{{$namhoc_kt->namhoc}}</option>
								@endif
							@endforeach
						</select>
					</div>
				</div>
				
			</div>
		</div>
		<button type="submit" id="themlop" class="btn btn-block btn-warning col-sm-6 offset-sm-3">Cập nhật lớp</button>
	</form>
</div>
@if (session('success'))
<script>
      alert("{{session('success')}}");
</script>
@endif
<script src="{{url('js/javascript_themlop.js')}}"></script>
@endsection