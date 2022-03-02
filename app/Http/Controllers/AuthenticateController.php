<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB,Session;
use App\Models\Admin;

class AuthenticateController extends Controller
{
    public function login (){
        return view("login");
    }

    public function loginProcess (Request $request){
        $email = $request->get("email");
        $password = $request->get("password");

        // var_dump($password);
        $admin = DB::table("admin")->where("email", $email)->where("password", $password)->first();
        // var_dump($admin->password);
        $countAdmin = DB::table("admin")->where("email", $email)->where("password", $password)->count();

        $user = DB::table("teacher")->where("email", $email)->where("password", $password)->first();
        // var_dump($admin->password);
        $countUser = DB::table("teacher")->where("email", $email)->where("password", $password)->count();
        if($admin != null || $countAdmin > 0){
            $request->session()->put('admin_id', $admin->idAdmin);
            $request->session()->put('admin_name', [$admin->firstName,$admin->middleName,$admin->lastName]);
            // var_dump($request->session()->get('admin_name')[0]);

                // return Session::get('admin_id');
            
            return redirect('home');
        }else{
            if($user != null || $countUser > 0){
                $request->session()->put('user_name', [$user->firstName,$user->middleName,$user->lastName]);
                $request->session()->put('user_id', $user->idTeacher);
                    // return Session::get('user_id');
                return redirect('attendance/create');
            }
            return redirect('login')->with('errors', 'Sai tài khoản hoặc mật khẩu');
        }         
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect('login');
    }
}
