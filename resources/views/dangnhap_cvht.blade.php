<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 02/01/19
 * Time: 2:02 PM
 */
?>
        <!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
<img src="{{asset('img/DEMO.png')}}" alt="head_banner" width="100%">
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Hướng dẫn thực hiện</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="col-sm-8">
        <h4>Trang đăng nhập CVHT</h4>
        <img src="{{asset('img/gv.jpg')}}" alt="banner" width="100%">
    </div>
    <div class="col-sm-4">
        <h4>Form đăng nhập</h4>
        <br>
        @if(count($errors)>0)
            <div class="alert alert-danger">
                @foreach($errors -> all() as $err)
                    {{$err}} <br>
                @endforeach
            </div>
        @endif
        @if(session('thongbao1'))
            <div class="alert alert-danger">
                {{session('thongbao1')}}
            </div>
        @endif
        @if(session('thongbao'))
            <div class="alert alert-danger">
                {{session('thongbao')}}
            </div>
        @endif
        <form action="/doan3/public/covanlogin" method="post">
            @csrf
            <div class="form-group">
                <label>Tên đăng nhập</label>
                <input name="ten_dn" type="text" class="form-control">
                <br>
                <label>Mật khẩu</label>
                <input name="password" type="text" class="form-control">
                <br>
                <input type="submit" value="Đăng nhập">
            </div>
        </form>
    </div>
</div>
<div class="container-fluid footer">
    <h5>Copyright &copy; 2015</h5>
</div>
</body>