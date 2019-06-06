@extends('layouts.chamdiemrenluyen')
@section('nav')
<?php 
	use App\chucvu;
	use App\chucnang_hk;
	use App\chucnang;use Illuminate\Support\Facades\Auth;
$covan_chucvu = Auth::guard('cvht')->user()->id_chucvu;
$ten_cv = Auth::guard('cvht')->user()->hoten;
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
 @if($chucnang !=null)
<li class="nav-item active" style="border-left: none;">
	<a class="nav-link" href="{{asset('covan')}}"><i class="fas fa-home" style="font-size: 130%;"></i><span class="sr-only">(current)</span></a>
</li>
@if($chucnang->id == 4)
<li class="nav-item a">
	<a class="nav-link a" href="{{asset('covan/duyetlan2/'.$hk->id_hocky)}}">Duyệt bảng điểm<span class="sr-only">(current)</span></a>
</li>
@endif
<li class="nav-item a">
	<a class="nav-link a" href="{{asset('covan/diemdaduyet/'.$hk->id_hocky)}}">Điểm đã duyệt<span class="sr-only">(current)</span></a>
</li>
<li class="nav-item a">
	<a class="nav-link a" href="{{asset('covan/thongke')}}">Thống kê<span class="sr-only">(current)</span></a>
</li>
@if($chucnang->id == 6)
<li class="nav-item a">
	<a class="nav-link a" href="{{asset('covan/yeucau/'.$hk->id_hocky)}}">Yêu cầu xem xét<span class="sr-only">(current)</span></a>
</li>
@endif
<li class="nav-item a">
	<a class="nav-link a" href="{{asset('covan/yeucau')}}" style="border-right: 1px solid white;">Mẫu Excel<span class="sr-only">(current)</span></a>
</li>
	</ul>
@else
<li class="nav-item active" style="border-left: none;">
	<a class="nav-link" href="{{asset('covan')}}"><i class="fas fa-home" style="font-size: 130%;"></i><span class="sr-only">(current)</span></a>
</li>

<li class="nav-item a">
	<a class="nav-link a" href="{{asset('covan/thongke')}}">Thống kê<span class="sr-only">(current)</span></a>
</li>

<li class="nav-item a">
	<a class="nav-link a" href="{{asset('covan/yeucau')}}" style="border-right: 1px solid white;">Mẫu Excel<span class="sr-only">(current)</span></a>
</li>
	</ul>
@endif

<div class="collapse navbar-collapse" id="navbarSupportedContent">
	<ul class="navbar-nav ml-auto">
		<!-- Authentication Links -->
		{{--@guest--}}
		@if($ten_cv == null)
		<li class="nav-item">
			<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
		</li>
		<li class="nav-item">
			@if (Route::has('register'))
			<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
			@endif
		</li>
		{{--@else--}}
		@else
		<li class="nav-item b dropdown">
			<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><i class="fas fa-user-tie"></i>
				{{ $ten_cv }} <span class="caret"></span>
			</a>

			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
				<a class="dropdown-item" href="{{ route('logout') }}"
				onclick="event.preventDefault();
				document.getElementById('logout-form').submit();">
				{{ __('Đăng xuất') }}
			</a>

			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				@csrf
			</form>
		</div>
	</li>
	{{--@endguest--}}
			@endif
</ul>
</div>
@endsection