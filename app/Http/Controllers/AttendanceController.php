<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB,Session,DateTime;
use App\Models\Attendance;
use App\Models\DetailAttendance;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        if(Session::exists("admin_id")){
            $idAssign = $request->get("idAssign");
            if(isset($idAssign)){
                $assign = DB::table('assign')
                ->join('faculty', 'assign.idFaculty', '=', 'faculty.idFaculty')
                ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                ->select('assign.*', 'faculty.nameFaculty', 'classroom.nameClass', 'subject.nameSubject')
                ->where('assign.available','=', 1)
                ->get();
                $idClass = DB::table('assign')
                ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                ->select('assign.idClass')
                ->where('assign.available','=', 1)
                ->where('assign.idAssign', '=', $idAssign)
                ->get();
                $idSubject = DB::table('assign')
                ->join('subject','assign.idSubject','=','subject.idSubject')
                ->select('assign.idSubject')
                ->where('assign.available','=', 1)
                ->where('assign.idAssign', '=', $idAssign)
                ->get();
                
                foreach($idClass as $idClass){
                    
                    foreach($idSubject as $idSubject){
                        
                        $attendance = DB::table('attendance')
                        ->join('subject','attendance.idSubject','=','subject.idSubject')
                        ->join('classroom','attendance.idClass','=','classroom.idClass')
                        ->where('attendance.idClass', '=', $idClass->idClass)
                        ->where('attendance.idSubject', '=', $idSubject->idSubject)
                        ->select('attendance.*','classroom.nameClass','subject.nameSubject')
                        ->get();
                        
                        return view('attendance.diary',[
                            'index' => 1,
                            'attendance' => $attendance,
                            'assign' => $assign,
                            'idAssign' => $idAssign,
                        ]);
                    }
                }   
            }else{
                $idAssign = '';
                $assign = DB::table('assign')
                ->join('faculty', 'assign.idFaculty', '=', 'faculty.idFaculty')
                ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                ->select('assign.*', 'faculty.nameFaculty', 'classroom.nameClass', 'subject.nameSubject')
                ->where('assign.available','=', 1)
                ->get();
                
                $idClass = '';
                $idSubject = '';
                    $attendance = DB::table('attendance')
                    ->join('subject','attendance.idSubject','=','subject.idSubject')
                    ->join('classroom','attendance.idClass','=','classroom.idClass')
                    ->where('attendance.idClass', '=', $idClass)
                    ->where('attendance.idSubject', '=', $idSubject)
                    ->select('attendance.*','classroom.nameClass','subject.nameSubject')
                    ->get();

                    return view('attendance.diary',[
                        'index' => 1,
                        'attendance' => $attendance,
                        'assign' => $assign,
                        'idAssign' => $idAssign
                    ]);
            }
        }elseif(Session::exists("user_id")){
            $idAssign = $request->get("idAssign");
            $idTeacher = Session::get("user_id");
            if(isset($idAssign)){
                $assign = DB::table('assign')
                ->join('faculty', 'assign.idFaculty', '=', 'faculty.idFaculty')
                ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                ->select('assign.*', 'faculty.nameFaculty', 'classroom.nameClass', 'subject.nameSubject')
                ->where('assign.available','=', 1)
                ->where('idTeacher','=', $idTeacher)
                ->get();
                $idClass = DB::table('assign')
                ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                ->select('assign.idClass')
                ->where('assign.available','=', 1)
                ->where('assign.idAssign', '=', $idAssign)
                ->where('idTeacher','=', $idTeacher)
                ->get();
                $idSubject = DB::table('assign')
                ->join('subject','assign.idSubject','=','subject.idSubject')
                ->select('assign.idSubject')
                ->where('assign.available','=', 1)
                ->where('assign.idAssign', '=', $idAssign)
                ->where('idTeacher','=', $idTeacher)
                ->get();
                
                foreach($idClass as $idClass){
                    
                    foreach($idSubject as $idSubject){
                        
                        $attendance = DB::table('attendance')
                        ->join('subject','attendance.idSubject','=','subject.idSubject')
                        ->join('classroom','attendance.idClass','=','classroom.idClass')
                        ->where('attendance.idClass', '=', $idClass->idClass)
                        ->where('attendance.idSubject', '=', $idSubject->idSubject)
                        ->select('attendance.*','classroom.nameClass','subject.nameSubject')
                        ->get();
                        
                        return view('attendance.diary',[
                            'index' => 1,
                            'attendance' => $attendance,
                            'assign' => $assign,
                            'idAssign' => $idAssign,
                        ]);
                    }
                }   
            }else{
                $idAssign = '';
                $assign = DB::table('assign')
                ->join('faculty', 'assign.idFaculty', '=', 'faculty.idFaculty')
                ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                ->select('assign.*', 'faculty.nameFaculty', 'classroom.nameClass', 'subject.nameSubject')
                ->where('assign.available','=', 1)
                ->where('idTeacher','=', $idTeacher)
                ->get();
                
                $idClass = '';
                $idSubject = '';
                    $attendance = DB::table('attendance')
                    ->join('subject','attendance.idSubject','=','subject.idSubject')
                    ->join('classroom','attendance.idClass','=','classroom.idClass')
                    ->where('attendance.idClass', '=', $idClass)
                    ->where('attendance.idSubject', '=', $idSubject)
                    ->select('attendance.*','classroom.nameClass','subject.nameSubject')
                    ->get();

                    return view('attendance.diary',[
                        'index' => 1,
                        'attendance' => $attendance,
                        'assign' => $assign,
                        'idAssign' => $idAssign
                    ]);
            }
            
        }
    }

    public function search(Request $request){
        if($request->isMethod("post")){
            $idAssign = $request->input("idAssign");
            // return $idAssign;
            $getID = DB::table('assign')
            ->select('assign.*','assign.idFaculty','classroom.nameClass','faculty.nameFaculty','subject.nameSubject')
            ->join('subject','assign.idSubject','=','subject.idSubject')
            ->join('classroom','assign.idClass','=','classroom.idClass')
            ->join('faculty','assign.idFaculty','=','faculty.idFaculty')
            ->distinct('assign.idSubject','assign.idClass','assign.idFaculty')
            ->where('idAssign', '=', $idAssign)
            ->get();
            // return $idClass;
            // return $getID;

            if ($getID != null || count($getID) > 0) {
                foreach($getID as $getID){
                    $mydate = new DateTime();
                    $mydate->modify('+7 hours');
                    $curentDate = $mydate->format('Y-m-d');
                    
                   
                    $count = DB::table('attendance')
                    ->where('idClass', '=', $getID->idClass)
                    ->where('idSubject', '=', $getID->idSubject)
                    ->where('created_at', '>=', $curentDate)
                    ->select('*')
                    ->count();

                    if($count == null || $count == 0){
                        $student = DB::table('student')
                        ->where('idClass', '=', $getID->idClass)
                        ->get();
                    }else{
                        if(Session::exists("user_id")){
                            $idTeacher = Session::get("user_id");
                            $view = DB::table('assign')
                            ->select('assign.*','assign.idFaculty','classroom.nameClass','faculty.nameFaculty','subject.nameSubject')
                            ->join('subject','assign.idSubject','=','subject.idSubject')
                            ->join('classroom','assign.idClass','=','classroom.idClass')
                            ->join('faculty','assign.idFaculty','=','faculty.idFaculty')
                            ->distinct('assign.idSubject','assign.idClass','assign.idFaculty')
                            ->where('assign.idTeacher', '=', $idTeacher)
                            ->get();
                            // return $subject;
                            
                            return view('attendance.index', ['view' => $view])->with("message", "Lớp bạn vừa lựa chọn hôm nay đã được điểm danh =))");
                        }
                    }
                    
                }
            }
            
            return view('attendance.index', [
                'index' => 1,
                'student' => $student, 
                'count' => $count,
                'assign' => $getID
            ]);

        }
            if(Session::exists("user_id")){
                $idTeacher = Session::get("user_id");
                $view = DB::table('assign')
                ->select('assign.*','assign.idFaculty','classroom.nameClass','faculty.nameFaculty','subject.nameSubject')
                ->join('subject','assign.idSubject','=','subject.idSubject')
                ->join('classroom','assign.idClass','=','classroom.idClass')
                ->join('faculty','assign.idFaculty','=','faculty.idFaculty')
                ->distinct('assign.idSubject','assign.idClass','assign.idFaculty')
                ->where('assign.idTeacher', '=', $idTeacher)
                ->get();
                // return $subject;
                
                return view('attendance.index', ['view' => $view]);
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
        $idAssign = $request->get("idAssign");
        $assign = DB::table("assign")
            ->where("idAssign", "=", $idAssign)
            ->get();
        foreach($assign as $assign){
            $idClass = $assign->idClass;
            $idSubject = $assign->idSubject;
        }
        
        $start = $request->get("start");
        
        $end = $request->get("end");
        
        $student = DB::table("student")
            ->where("idClass", "=", $idClass)
            ->get();
        
        $date = new Datetime();
        
        $attendance = new Attendance();
        $attendance->dateAttendance = new Datetime();
        $attendance->idClass = $idClass;
        $attendance->idSubject = $idSubject;
        $attendance->start = $start;
        $attendance->end = $end;
        $attendance->save();

        $Att = DB::table('Attendance')->orderBy('idAttendance', 'desc')->first();
        $idAttendance = $Att->idAttendance;

        foreach($student as $student){
            $idStudent = $student->idStudent;
            $status = $_REQUEST[$student->idStudent];

            $data = new DetailAttendance();
            $data->idStudent = $idStudent;
            $data->idAttendance = $idAttendance;
            $data->status = $status;
            $data->save();
        }
         if(Session::exists("user_id")){
            $idTeacher = Session::get("user_id");
            $view = DB::table('assign')
            ->select('assign.*','assign.idFaculty','classroom.nameClass','faculty.nameFaculty','subject.nameSubject')
            ->join('subject','assign.idSubject','=','subject.idSubject')
            ->join('classroom','assign.idClass','=','classroom.idClass')
            ->join('faculty','assign.idFaculty','=','faculty.idFaculty')
            ->distinct('assign.idSubject','assign.idClass','assign.idFaculty')
            ->where('assign.idTeacher', '=', $idTeacher)
            ->get();
            // return $subject;
            
            return view('attendance.index', ['view' => $view])->with("success","Đã điểm danh thành công <3 <3");
        } 

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
