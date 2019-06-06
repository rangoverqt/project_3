@extends('bithu.bithu_nav')
@section('title','Trang quản lý lớp')
@section('noidung')
<div class="container">
	<h3 class="text-sm-center tieude">Quản lý lớp</h3>
	<div class="row">
	<a href="{{asset('bithu/themlop')}}" class="col-sm-3 offset-sm-9" style="text-decoration: none;"><button type="button" class="btn btn-block btn-primary" style="margin: 2% auto;"> <i class="fas fa-plus"></i> Thêm Lớp</button></a>
	</div>
 	<div style="overflow-x:auto;">
	<table class="table table-bordered">
		<thead>
			<tr style="background-color: #014c7f;">
				<th style="color: white;">Tên lớp</th>
				<th style="color: white;">Số lượng</th>
				<th style="color: white;">Ngành</th>
				<th style="color: white;">Năm học</th>
				<th style="color: white;">Chức năng</th>
			</tr>
		</thead>
		<tbody>
			@foreach($lop as $lop)
			<tr>
				<td>{{$lop->ten_lop}}</td>
				<td>{{$lop->soluong}}</td>
				<td>
					@for($i=0;$i<$nganh->count();$i++)
						@if($lop->id_nganh == $nganh[$i]->id)
							{{$nganh[$i]->ten_nganh}}
						@endif
					@endfor	
				</td>
				<td>
					@for($i=0;$i<$lop_nh->count();$i++)
						@if($lop->id == $lop_nh[$i]->id_lop)
							@for($k=0;$k<$namhoc->count();$k++)
								@if($lop_nh[$i]->id_nh == $namhoc[$k]->id)
									{{$namhoc[$k]->namhoc}}
								@endif
							@endfor
						@endif
					@endfor	
				</td>
				<td style="text-align: center;">
					<a href="{{asset('bithu/sualop/'.$lop->id)}}" style="text-decoration: none;"><button type="button" class="btn  btn-warning"><i class="fas fa-edit"></i> Sửa</button></a>
					<a href="{{asset('bithu/xoalop/'.$lop->id)}}" style="text-decoration: none;"><button type="button" class="btn  btn-danger" ><i class="fas fa-trash-alt"></i> Xóa</button></a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	</div>
</div>
@if (session('success'))
<script>
      alert("{{session('success')}}");
</script>
@endif
@endsection