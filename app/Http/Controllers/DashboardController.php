<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB,Session;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teacher = DB::table("teacher")
            ->where('available', 1)
            ->count();
        $student = DB::table("student")
            ->where('available', 1)
            ->count();
        $subject = DB::table("subject")
            ->where('available', 1)
            ->count();
        $class = DB::table("classroom")
            ->where('available', 1)
            ->count();
        $major = DB::table("major")
            ->where('available', 1)
            ->count();
        $faculty = DB::table("faculty")
            ->where('available', 1)
            ->count();
        $assign = DB::table("assign")
            ->where('available', 1)
            ->count();
        
        return view('index',[
            'teacher'=> $teacher,
            'student'=> $student,
            'subject'=> $subject,
            'class'=> $class,
            'major'=> $major,
            'faculty'=> $faculty,
            'assign'=> $assign
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(Session::exists("student_id")){
            $idStudent = Session::get("student_id");
        }
        // lấy mã lớp từ bảng student thông qua mã idStudent
        $student = DB::table('student')->select('student.*')->where('idStudent', $idStudent)->get();
        foreach($student as $student){
            $idClass = $student->idClass;
        }
        $idAssign = $request->get("idAssign");
        if(isset($idAssign))
        {
            $attendance = DB::table('attendance')
                ->join('assign','attendance.idAssign','=','assign.idAssign')
                ->join('subject','assign.idSubject','=','subject.idSubject')
                ->join('classroom','assign.idClass','=','classroom.idClass')
                ->join('detailattendance','attendance.idAttendance','=','detailattendance.idAttendance')
                ->where('attendance.idAssign', '=', $idAssign)
                ->where('detailattendance.idStudent', '=', $idStudent)
                ->select('attendance.*','classroom.nameClass','subject.nameSubject','detailattendance.status')
                ->get();
            $idAtt = DB::table('attendance')
                ->join('assign','attendance.idAssign','=','assign.idAssign')
                ->where('attendance.idAssign', '=', $idAssign)
                ->select('attendance.idAttendance')
                ->get();
            $info = DB::table('student')
                ->join('classroom', 'student.idClass', '=', 'classroom.idClass')
                ->select('student.*', 'classroom.nameClass')
                ->where('idStudent', $idStudent)
                ->get();
            $resultAssign = DB::table('assign')
                ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                ->select('assign.*', 'classroom.nameClass', 'subject.nameSubject')
                ->where('assign.available','=', 1)
                ->where('assign.idClass','=', $idClass)
                ->get();
            return view('indexStudent',[
                'index' => 1,
                'attendance' => $attendance,
                'assign' => $resultAssign,
                'idAssign' => $idAssign,
                'student' => $info,
                // 'status' => $status,
            ]);
            // Nếu không nhận được mã phân công
        }else{
            $idAssign = '';
           
            $assign = DB::table('assign')
            ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
            ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
            ->select('assign.*', 'classroom.nameClass', 'subject.nameSubject')
            ->where('assign.available','=', 1)
            ->where('assign.idClass','=', $idClass)
            ->get();
            $checkAssign = empty($assign) ? 1 : 2; 
            if($checkAssign == 1 && $checkAssign != 2)
            {
                foreach ($assign as $assign) {
                    $attendance = DB::table('attendance')
                        ->join('assign','attendance.idAssign','=','assign.idAssign')
                        ->join('subject','assign.idSubject','=','subject.idSubject')
                        ->join('classroom','assign.idClass','=','classroom.idClass')
                        ->where('attendance.idAssign', '=', $assign->idAssign)
                        ->select('attendance.*','classroom.nameClass','subject.nameSubject')
                        ->get();
                }

                $info = DB::table('student')
                    ->join('classroom', 'student.idClass', '=', 'classroom.idClass')
                    ->select('student.*', 'classroom.nameClass')
                    ->where('idStudent', $idStudent)
                    ->get();
                $resultAssign = DB::table('assign')
                    ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                    ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                    ->select('assign.*', 'classroom.nameClass', 'subject.nameSubject')
                    ->where('assign.available','=', 1)
                    ->where('assign.idClass','=', $idClass)
                    ->get();
                return view('indexStudent',[
                    'index' => 1,
                    'attendance' => $attendance,
                    'assign' => $resultAssign,
                    'idAssign' => $idAssign,
                    'student' => $info,
                ]);
            }else
            {
                $attendance = "";
                $info = DB::table('student')
                    ->join('classroom', 'student.idClass', '=', 'classroom.idClass')
                    ->select('student.*', 'classroom.nameClass')
                    ->where('idStudent', $idStudent)
                    ->get();
                $resultAssign = DB::table('assign')
                    ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                    ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                    ->select('assign.*', 'classroom.nameClass', 'subject.nameSubject')
                    ->where('assign.available','=', 1)
                    ->where('assign.idClass','=', $idClass)
                    ->get();
                return view('indexStudent',[
                    'index' => 1,
                    'attendance' => $attendance,
                    'assign' => $resultAssign,
                    'idAssign' => $idAssign,
                    'student' => $info,
                ]);
            }
            
        }
        // return view('indexStudent');
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
    // Chức năng dành cho xem lịch học
    public function show($id)
    {
        if(Session::exists("student_id")){
            $idStudent = Session::get("student_id");
        }
        // lấy mã lớp từ bảng student thông qua mã idStudent
        $student = DB::table('student')->select('student.*')->where('idStudent', $idStudent)->get();
        foreach($student as $student){
            $idClass = $student->idClass;
        }
        $assign = DB::table("assign")
            ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
            ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
            ->join('teacher', 'assign.idTeacher', '=', 'teacher.idTeacher')
            ->select("assign.*","teacher.*","classroom.nameClass","subject.*")
            ->where("assign.idClass",$idClass)
            ->get();
        $timeStart = DB::table('attendance')
            ->select(DB::raw('idAssign, SUM(start) AS sum_start'))
            ->groupBy('idAssign')
            ->orderBy('sum_start', 'desc')
            ->get();
        $timeEnd = DB::table('attendance')
            ->select(DB::raw('idAssign, SUM(end) AS sum_end'))
            ->groupBy('idAssign')
            ->orderBy('sum_end', 'desc')
            ->get();
        
        
        return view("student.ScheduleStudent",[
            'assign' => $assign,
            'timeStart' => $timeStart,
            'timeEnd' => $timeEnd,
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
        //
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
        //
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
