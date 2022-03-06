<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB,Session,DateTime;
use App\Models\Attendance;
use App\Models\DetailAttendance;
class DetailAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     // function dùng để thống kê điểm danh của sinh viên
    public function index(Request $request)
    {
        // chỉ dành cho giáo vụ
        if(Session::exists("admin_id")){
            // lấy mã phân công
            $idAssign = $request->get("idAssign");
            if(isset($idAssign)){
                // lấy dữ liệu phân công
                $assign = DB::table('assign')
                ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                ->select('assign.*','classroom.nameClass', 'subject.nameSubject')
                ->where('assign.available','=', 1)
                ->get();
                // lấy dữ liệu bảng lớp
                $idClass = DB::table('assign')
                ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                ->select('assign.idClass')
                ->where('assign.available','=', 1)
                ->where('assign.idAssign', '=', $idAssign)
                ->get();
                // lấy dữ liệu bảng môn học
                $idSubject = DB::table('assign')
                ->join('subject','assign.idSubject','=','subject.idSubject')
                ->select('assign.idSubject')
                ->where('assign.available','=', 1)
                ->where('assign.idAssign', '=', $idAssign)
                ->get();
                
                foreach($idClass as $idClass){
                    
                    foreach($idSubject as $idSubject){
                        
                        $countAttendance = DB::table('attendance')
                        ->where('attendance.idAssign', '=', $idAssign)
                        ->count();
                        
                        $tong = 0;
                        // test thống kê
                        $idStudent = DB::table('assign')
                        ->join('subject','assign.idSubject','=','subject.idSubject')
                        ->join('classroom','assign.idClass','=','classroom.idClass')
                        ->join('student', 'classroom.idClass', '=', 'student.idClass')
                        ->where('assign.idClass', '=', $idClass->idClass)
                        ->where('assign.idSubject', '=', $idSubject->idSubject)
                        ->select('student.idStudent')
                        ->get();
                        $resultArray = [];
                        foreach($idStudent as $student){
                            $query = DB::table('attendance')
                                ->join('detailattendance', 'attendance.idAttendance', '=', 'detailattendance.idAttendance')
                                ->where('attendance.idAssign', $idAssign)
                                ->where('detailattendance.idStudent', $student->idStudent)
                                ->selectRaw('idStudent,SUM(IF(detailattendance.status = 0, 1, 0)) as dihoc, 
                                    SUM(IF(detailattendance.status = 1, 1, 0)) as nghiKp, 
                                    SUM(IF(detailattendance.status = 2, 1, 0)) as dimuon, 
                                    SUM(IF(detailattendance.status = 3, 1, 0)) as nghiP')
                                ->groupBy('idStudent')
                                ->get();
                                array_push($resultArray, $query);
                        }
                        $total = DB::table('attendance')
                        ->join('assign', 'attendance.idAssign', '=', 'assign.idAssign')
                        ->join('detailattendance', 'attendance.idAttendance', '=', 'detailattendance.idAttendance')
                        ->where('attendance.idAssign', $idAssign)
                        ->selectRaw('SUM(IF(detailattendance.status = 0, 1, 0)) as dihoc, 
                                    SUM(IF(detailattendance.status = 1, 1, 0)) as nghiKp, 
                                    SUM(IF(detailattendance.status = 2, 1, 0)) as dimuon, 
                                    SUM(IF(detailattendance.status = 3, 1, 0)) as nghiP,
                                    COUNT(idDetail) as total')
                        ->get();
                        // dd($total);
                        $student = DB::table('assign')
                            ->join('subject','assign.idSubject','=','subject.idSubject')
                            ->join('classroom','assign.idClass','=','classroom.idClass')
                            ->join('student', 'classroom.idClass', '=', 'student.idClass')
                            ->where('assign.idClass', '=', $idClass->idClass)
                            ->where('assign.idSubject', '=', $idSubject->idSubject)
                            ->select(DB::raw('DISTINCT student.idStudent, classroom.nameClass,student.*,subject.nameSubject'))
                            ->get();
                        return view('attendance.statistical',[
                            'index' => 1,
                            'assign' => $assign,
                            'idAssign' => $idAssign,
                            'student' => $student,
                            'results' => $resultArray,
                            'countAttendance' => $countAttendance,
                            'tong'=> $tong,
                            'totals' => $total,
                        ]);   
                    }
                }   
            }else{
                $idAssign = '';
                $assign = DB::table('assign')
                ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                ->select('assign.*', 'classroom.*', 'subject.*')
                ->where('assign.available','=', 1)
                ->get();
                    $attendance = DB::table('attendance')
                    ->join('assign','attendance.idAssign','=','assign.idAssign')
                    ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                    ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                    ->where('attendance.idAssign', '=', $idAssign)
                    ->select('attendance.*','classroom.nameClass','subject.nameSubject')
                    ->get();
    
                    return view('attendance.statistical',[
                        'index' => 1,
                        'attendance' => $attendance,
                        'assign' => $assign,
                        'idAssign' => $idAssign
                    ]);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = DB::table('detailattendance')
            ->join('student','detailattendance.idStudent','=','student.idStudent')
            ->join('attendance','detailattendance.idAttendance','=','attendance.idAttendance')
            ->where('detailattendance.idAttendance',$id)
            ->select('detailattendance.*','student.firstName','student.lastName','student.middleName', 'attendance.*')
            ->get();

        $class = DB::table('classroom')
            ->get();
        $faculty = DB::table('faculty')
            ->get();
        $subject = DB::table('subject')
            ->get();
        
        return view('attendance.detailAttendance',[
            'index' => 1,
            'detail' => $detail,
            'subjects' => $subject,
            'classs' => $class,
            'facultys' => $faculty
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
        $detail = DB::table('detailattendance')
        ->join('student','detailattendance.idStudent','=','student.idStudent')
        ->join('attendance','detailattendance.idAttendance','=','attendance.idAttendance')
        ->where('detailattendance.idAttendance',$id)
        ->select('detailattendance.*','student.*')
        ->get();
        return view('attendance.updateDetail',[
            'index' => 1,
            'detail' => $detail,
            'idAttendance' => $id
        ]); 
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
        $idAttendance = $id;
        $student = DB::table("detailattendance")
            ->join("student", "detailattendance.idStudent", "=", "student.idStudent")
            ->where("detailattendance.idAttendance", "=", $idAttendance)
            ->select("student.*")
            ->get();
        
        foreach($student as $student){
            $idStudent = $student->idStudent;   
            $status = $_REQUEST[$student->idStudent];
            $data = DB::table("detailattendance")
                ->where("idAttendance", "=", $idAttendance)
                ->where("idStudent", "=", $idStudent)
                ->update(['status' => $status]);
        }
        $detail = DB::table('detailattendance')
        ->join('student','detailattendance.idStudent','=','student.idStudent')
        ->join('attendance','detailattendance.idAttendance','=','attendance.idAttendance')
        ->where('detailattendance.idAttendance',$idAttendance)
        ->select('detailattendance.*','student.*')
        ->get();

        // return view('attendance.updateDetail',[
        //     'index' => 1,
        //     'detail' => $detail,
        //     'idAttendance' => $id
        // ])->with("success","Thay đổi thành công!");
        
        $alert="Điểm danh đã được cập nhật thành công!";
        return redirect()->back()->with('alert',$alert);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
