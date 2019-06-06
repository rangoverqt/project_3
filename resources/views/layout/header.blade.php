<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 26/11/18
 * Time: 1:06 AM
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
    <style>
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu .dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -1px;
        }
    </style>
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
            <ul class="nav navbar-nav mr-auto">
                <li class="active"><a href="/doan3/public/hocvien/trangchu/{{\Illuminate\Support\Facades\Auth::guard('hocvien')
                        ->user()->id}}">Trang chủ</a></li>
            @if(\Illuminate\Support\Facades\Auth::guard('hocvien')->check())
                    <ul class="nav navbar-nav ml-auto">
                    <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="glyphicon glyphicon-user"></span>{{\Illuminate\Support\Facades\Auth::guard('hocvien')
                        ->user()->hoten}}
                        <span class="caret"></span></a>
                     <ul class="dropdown-menu">
                            <li><a href="#">Đổi mật khẩu</a></li>
                            {{--<li><a href="#">Page 1-3</a></li>--}}
                    </ul>
                 </li>
                <li><a href="/doan3/public/hocvien/dangxuat"><span class="glyphicon glyphicon-log-in"></span> Đăng xuất</a></li>
            </ul>
                @endif
            </ul>
        </div>
    </div>
</nav>
</body>

<script>
    $(document).ready(function(){
        $('.dropdown-submenu a.test').on("click", function(e){
            $(this).next('ul').toggle();
            e.stopPropagation();
            e.preventDefault();
        });
    });
</script>