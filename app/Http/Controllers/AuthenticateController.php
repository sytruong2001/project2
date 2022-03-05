<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB,Session;
use App\Models\Admin;

class AuthenticateController extends Controller
{
    // Dành cho giảng viên và giáo vụ
    public function login (){
        return view("login");
    }

    public function loginProcess (Request $request){
        $email = $request->get("email");
        $password = md5($request->get("password"));

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


    // Dành cho sinh viên
    public function loginStudent (){
        return view("account.userlogin");
    }

    public function loginStudentProcess (Request $request){
        $email = $request->get("email");

        // var_dump($email);
        $student = DB::table("student")->where("email", $email)->first();
        // var_dump($student);
        $countStudent = DB::table("student")->where("email", $email)->count();

        if($student != null || $countStudent > 0){
            $request->session()->put('student_id', $student->idStudent);
            $request->session()->put('student_name', [$student->firstName,$student->middleName,$student->lastName]);
            // var_dump($request->session()->get('admin_name')[0]);

                // return Session::get('admin_id');
            
            return redirect('homeStudent/index');
        }else{
            return redirect('loginStudent')->with('errors', 'Sai tài khoản hoặc mật khẩu');
        }         
    }

    // Đăng xuất
    public function logout(Request $request){
        if(Session::exists("student_id")){
            $request->session()->flush();
            return redirect('loginStudent');
        }elseif(Session::exists("user_id") || Session::exists("admin_id")){
            $request->session()->flush();
            return redirect('login');
        }
        
    }
}
