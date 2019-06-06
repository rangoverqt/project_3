@extends('bithu.bithu_nav')
@section('title','Trang bí thư')
@section('noidung')
<div class="container">
	<h3 class="text-sm-center tieude" style="margin:0 auto 5% auto;">Chức năng của bí thư</h3>
	<div class="row">
		<div class="col-sm-6" style="margin-top: 2%;">
			<img src="{{asset('img/classroom.png')}}" alt="" class="float-left" width="15%;" style="background-color: #014c7f;">
			<a type="button" class="btn btn-primary btn-block btn-change7" href="{{asset('bithu/quanlylop')}}" style="text-decoration: none;padding:5%;">
				Quản lý lớp
			</a>
		</div>
		<div class="col-sm-6" style="margin-top: 2%;">
			<img src="{{asset('img/hoatdong.png')}}" alt="" class="float-left" width="15%;" style="background-color: #014c7f;">
			<a type="button" class="btn btn-primary btn-block btn-change7" href="{{asset('bithu/hoatdong')}}" style="text-decoration: none;padding:5%;">
				Quản lý hoạt động
			</a>
		</div>
	</div>
</div>
@endsection