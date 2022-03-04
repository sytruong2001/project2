<?php

namespace App\Http\Middleware;

use Closure;

class CheckLoginStudent
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
        // Kiểm tra session: trường hợp có session 
        if($request->session()->exists("student_id")){
            return $next($request);
        } else {
            return redirect('loginStudent')->with('errors', 'Bạn chưa đăng nhập tài khoản !');
        }
    }
}
