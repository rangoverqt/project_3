@extends('covan.covan_nav')
@section('title','Trang chủ cố vấn')
@section('noidung')
<?php
	use App\chucvu;
	use App\chucnang_hk;
	use App\chucnang;use Illuminate\Support\Facades\Auth;
$covan_chucvu = Auth::guard('cvht')->user()->id_chucvu;
	$chucvu = chucvu::where('id',$covan_chucvu)->first();
	$hk = chucnang_hk::where('id',$chucvu->id_chucnang_hk)->first();
	$chucnang_hk = chucnang_hk::where('id',$chucvu->id_chucnang_hk)->first();
	if ($chucnang_hk == null) {
		$chucnang =0;
	}
	else{
		$chucnang = chucnang::where('id',$chucnang_hk->id_chucnang)->first();
	}
	
?>
@if($hk != null)
<div class="container">
	<h3 class="text-sm-center tieude" style="margin:0 auto 5% auto;">Chức năng của cố vấn</h3>
	<input type="hidden" name="hocky" value="{{$chucnang_hk->id_hocky}}">
	<div class="row">
		@if($chucnang->id == 4)
		<div class="col-sm-6"  style="margin-top: 2%;">
			<img src="{{asset('img/duyet.png')}}" alt="" class="float-left" width="15%;" style="background-color: #014c7f;">
			<a type="button" class="btn btn-primary btn-block btn-change7" href="{{asset('covan/duyetlan2/'.$chucnang_hk->id_hocky)}}" style="text-decoration: none;padding:5%;">
				Duyệt lần 2
			</a>
		</div>
		@endif()
		<div class="col-sm-6"  style="margin-top: 2%;">
			<img src="{{asset('img/daduyet.png')}}" alt="" class="float-left" width="15%;" style="background-color: #014c7f;">
			<a type="button" class="btn btn-primary btn-block btn-change7" href="{{asset('hoatdong')}}" style="text-decoration: none;padding:5%;">
				Điểm đã duyệt
			</a>
		</div>
	
		<div class="col-sm-6"  style="margin-top: 2%;">
			<img src="{{asset('img/thongke.png')}}" alt="" class="float-left" width="15%;" style="background-color: #014c7f;">
			<a type="button" class="btn btn-primary btn-block btn-change7" href="{{asset('covan/thongke')}}" style="text-decoration: none;padding:5%;">
				Thống kê
			</a>
		</div>
		@if($chucnang->id == 6)
		<div class="col-sm-6"  style="margin-top: 2%;">
			<img src="{{asset('img/yeucau.png')}}" alt="" class="float-left" width="15%;" style="background-color: #014c7f;">
			<a type="button" class="btn btn-primary btn-block btn-change7" href="{{asset('covan/yeucau/'.$chucnang_hk->id_hocky)}}" style="text-decoration: none;padding:5%;">
				Danh sách yêu cầu xem xét
			</a>
		</div>
		@endif
	
		<div class="col-sm-6"  style="margin-top: 2%;">
			<img src="{{asset('img/Excel.png')}}" alt="" class="float-left" width="15%" style="background-color: #014c7f;">
			<a type="button" class="btn btn-primary btn-block btn-change7" href="{{asset('quanlylop')}}" style="text-decoration: none;padding:5%;">
				  Mẫu Excel
			</a>
		</div>
	</div>
</div>
@else
<div class="container">
	<h3 class="text-sm-center tieude" style="margin:0 auto 5% auto;">Chức năng của cố vấn</h3>
	
	
	<div class="row">
		<div class="col-sm-6"  style="margin-top: 2%;">
			<img src="{{asset('img/thongke.png')}}" alt="" class="float-left" width="15%;" style="background-color: #014c7f;">
			<a type="button" class="btn btn-primary btn-block btn-change7" href="{{asset('covan/thongke')}}" style="text-decoration: none;padding:5%;">
				Thống kê
			</a>
		</div>
		<div class="col-sm-6"  style="margin-top: 2%;">
			<img src="{{asset('img/Excel.png')}}" alt="" class="float-left" width="15%" style="background-color: #014c7f;">
			<a type="button" class="btn btn-primary btn-block btn-change7" href="{{asset('quanlylop')}}" style="text-decoration: none;padding:5%;">
				  Mẫu Excel
			</a>
		</div>
	</div>
</div>
@endif
@endsection