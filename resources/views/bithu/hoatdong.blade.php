@extends('bithu.bithu_nav')
@section('title','Trang hoạt động')
@section('noidung')
<div class="container">
	@if(session('thongbao'))
		<div class="alert alert-success">
			{{session('thongbao')}}
		</div>
	@endif
	<h3 class="text-sm-center tieude">Quản lý hoạt động <i class="fas fa-running" style="font-size: 120%;"></i></h3>
	<div class="row">
		<a href="{{asset('bithu/themhoatdong')}}" class="col-sm-3  offset-sm-9" style="text-decoration: none;"><button type="button" class="btn btn-block btn-primary" style="margin: 2% auto;"><i class="fas fa-plus"></i> Thêm hoạt động</button></a>
	</div>
	<div style="overflow-x:auto;">
		<table class="table table-bordered">
			<thead>
				<tr style="background-color: #014c7f;">
					<th style="color: white;">Tên hoạt động</th>
					<th style="color: white;width: 9%;">Số lượng</th>
					<th style="color: white;">Điểm</th>
					<th style="color: white;">Ngày hoạt động</th>
					<!-- <th style="color: white;">Ngày kết thúc</th> -->
					<th style="color: white;">Thời gian</th>
					<!-- <th style="color: white;">Thời gian</th> -->
					<th style="color: white; width: 16%;">Chức năng</th>
				</tr>
			</thead>
			<tbody>
				@foreach($hoatdong as $hoatdong)
				<tr>
					<td>{{$hoatdong->ten_hoatdong}}</td>
					<td>{{$hoatdong->soluong}}</td>
					<td>{{$hoatdong->diem}}</td>
					<td>{{date('d-m-Y',strtotime($hoatdong->ngay_bd))}} đến {{date('d-m-Y',strtotime($hoatdong->ngay_kt))}}</td>
					<!-- <td>{{$hoatdong->ngay_kt}}</td> -->
					<td>{{$hoatdong->thoigian_bd}} đến {{$hoatdong->thoigian_kt}}</td>
					<!-- <td>{{$hoatdong->thoigian_kt}}</td> -->
					<td style="text-align: center;">
						<a href="{{asset('bithu/suahoatdong/'.$hoatdong->id)}}" style="text-decoration: none;"><button type="button" class="btn btn-warning"><i class="fas fa-edit"></i> Sửa</button></a>
						<a href="{{asset('bithu/xoahoatdong/'.$hoatdong->id)}}" style="text-decoration: none;"><button type="button" class="btn btn-danger" ><i class="fas fa-trash-alt"></i> Xóa</button></a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection