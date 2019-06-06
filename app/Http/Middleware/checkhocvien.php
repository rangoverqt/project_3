<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class checkhocvien
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('hocvien')->check())
//            $hocvien = Auth::guard('hocvien')->user()->id;
        return $next($request);
        else
            return redirect('hocvien/dangnhap')->with('thongbao','Không đăng nhập không có quyền truy cập');

    }
}
