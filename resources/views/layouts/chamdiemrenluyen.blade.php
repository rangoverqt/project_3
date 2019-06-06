<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>@yield('title')</title>
	<link rel="stylesheet" type="text/css" href="{{url('css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('css/chamdiemrenluyen.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('fontawesome/css/all.css')}}">
	<!-- Phần Jquery -->
	<script src="{{url('js/jquery-3.3.1.slim.min.js')}}"></script>
	<script src="{{url('js/jquery-3.3.1.min.js')}}"></script>
	<script src="{{url('js/jquery.validate.min.js')}}"></script>
	<script src="{{url('js/bootstrap.min.js')}}"></script>
	<script src="{{url('js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{url('js/chamdiemrenluyen.js')}}"></script>
</head>
<body background="{{asset('/img/bg.jpg')}}" >
	<div class="header">
		<img src="{{asset('img/header.png')}}" class="img-fluid" alt="header" width="100%">
	</div>
	<div class="navigation">
		<nav class="navbar navbar-expand-lg navbar-light bg-light" >
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarTogglerDemo03">
				<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
					@yield('nav')
					<!-- <li class="nav-item active" style="border-left: none;">
						<a class="nav-link" href="{{asset('bithu')}}">Trang chủ<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{asset('quanlylop')}}">Quản lý lớp<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{asset('hoatdong')}}">Quản lý hoạt động<span class="sr-only">(current)</span></a>
					</li> -->
				</ul>
			</div>
		</nav>
	</div>
	@yield('noidung')
</body>
</html>