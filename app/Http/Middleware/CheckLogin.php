<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
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
        if($request->session()->exists("admin_id") || $request->session()->exists("user_id")){
            return $next($request);
        } else {
            return redirect('login')->with('errors', 'Bạn chưa đăng nhập tài khoản !');
        }
       
    }
}
