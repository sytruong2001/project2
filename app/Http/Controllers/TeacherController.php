<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\LoginModel;
use Auth;
use DB;
use App\Models\Teacher;
use App\Models\Assign;
use App\Http\Controllers\ClassroomController;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TeacherImport;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table("teacher")
            ->where("available", "=", 1)
            ->paginate(10);

        return view("teacher.index",['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("teacher.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->isMethod("post")){
            $firstName = $request->input("firstName");
            $middleName = $request->input("middleName");
            $lastName = $request->input("lastName");
            $gender = $request->input("gender");
            $email = $request->input("email");
            $password = $request->input("password");
            $phone = $request->input("phone");
            $birthday = $request->input("birthday");
            $address = $request->input("address");

            $teacher = new teacher();
            $teacher->firstName = $firstName;
            $teacher->middleName = $middleName;
            $teacher->lastName = $lastName;
            $teacher->gender = $gender;
            $teacher->email = $email;
            $teacher->password = md5($password);
            $teacher->phone = $phone;
            $teacher->birthday = $birthday;
            $teacher->address = $address;

            $teacher->save();
            return redirect('teacher');
        }
        return view("teacher.create");
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $data = DB::table("teacher")
            ->where('idTeacher', '=', $id)
            ->get();
        
        $query = DB::table('assign')
        ->join('faculty', 'assign.idFaculty', '=', 'faculty.idFaculty')
        ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
        ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
        ->where('assign.idTeacher', '=', $id)
        ->where('assign.available', '=', 1)
        ->select('assign.*', 'faculty.nameFaculty', 'classroom.nameClass', 'subject.nameSubject')
        ->get();
        
        return view("info.index",[
            'index' => 1,
            'data' => $data,
            'class' => $query
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  
        $query = DB::table("teacher");
        $query = $query->where("idTeacher","$id");
        $query = $query->select("*");
        $data = $query->paginate(10);
        // return $data;
        return view("teacher.update",['data' => $data ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $firstName = $request->input("firstName");
        $middleName = $request->input("middleName");
        $lastName = $request->input("lastName");
        $gender = $request->input("gender");
        $email = $request->input("email");
        $password = $request->input("password");
        $phone = $request->input("phone");
        $birthday = $request->input("birthday");
        $address = $request->input("address");

        $data = Teacher::find($id);
        
        $data->firstName = $firstName;
        $data->middleName = $middleName;
        $data->lastName = $lastName;
        $data->gender = $gender;
        $data->email = $email;
        $data->password = md5($password);
        $data->phone = $phone;
        $data->birthday = $birthday;
        $data->address = $address;

        $data->save();
        return redirect('teacher');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }


    public function hide($id)
    {  
        $assign = DB::table("assign")
                ->where("idTeacher", "=", $id)
                ->update(["available" => 0]);

        $data = Teacher::find($id);       
        $data->available = 0;
        $data->save();
        return redirect('teacher');
        
    }

    public function showPassword($id)
    {  
        $data = DB::table("teacher")->where("idTeacher", "=", $id)->get();
        // return $data;
        return view("info.updatePassword",['data' => $data ]);
        
    }

    public function changePassword(Request $request, $id)
    {  
        $newPass = $request->input("newPassword");
        $rePass = $request->input("rePassword");
        if($newPass != $rePass){
            $data = DB::table("teacher")->where("idTeacher", "=", $id)->get();
            // return $data;
            return view("info.updatePassword",['data' => $data ])->with("error","Mật khẩu không trùng khớp! Vui lòng nhập lại");
        }else{
            $data = Teacher::find($id);       
            $data->password = md5($newPass);
            $data->save();
            $teacher = DB::table("teacher")->where("idTeacher", "=", $id)->get();
            return view("info.updatePassword",['data' => $teacher])->with("message","Thay đổi mật khẩu thành công");
        }
        
        
    }

    public function insertExcel()
    {
        return view("teacher.insertExcel");
    }

    public function insertExcelProcess(Request $request)
    {
        Excel::import(new TeacherImport, $request->file("nameTeacher"));
        return redirect("teacher");
    }
}
