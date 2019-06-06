@extends('layouts.chamdiemrenluyen')
@section('nav')
<li class="nav-item active" style="border-left: none;">
	<a class="nav-link" href="{{asset('bithu')}}"><i class="fas fa-home" style="font-size: 130%;"></i><span class="sr-only">(current)</span></a>
</li>
<li class="nav-item">
	<a class="nav-link" href="{{asset('bithu/quanlylop')}}">Quản lý lớp<span class="sr-only">(current)</span></a>
</li>
<li class="nav-item">
	<a class="nav-link" href="{{asset('bithu/hoatdong')}}">Quản lý hoạt động<span class="sr-only">(current)</span></a>
</li>
</ul>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
	<ul class="navbar-nav ml-auto">
		<!-- Authentication Links -->
		@guest
		<li class="nav-item">
			<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
		</li>
		<li class="nav-item">
			@if (Route::has('register'))
			<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
			@endif
		</li>
		@else
		<li class="nav-item b dropdown">
			<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><i class="fas fa-user-tie"></i>
				{{ Auth::user()->hoten }} <span class="caret"></span>
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
	@endguest
</ul>
</div>
@endsection