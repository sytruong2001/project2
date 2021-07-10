<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB,Session,DateTime;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        $idClass = $request->get("idClass");
        $class = DB::table('classroom')
        ->join('faculty', 'classroom.idFaculty', '=', 'faculty.idFaculty')
        ->select('classroom.*', 'faculty.nameFaculty')
        ->where('classroom.available','=', 1)
        ->get();

        $idSubject = $request->get("idSubject");
        $subject = DB::table('subject')
        ->where('subject.available','=', 1)
        ->get();

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
            'idClass' => $idClass,
            'idSubject' => $idSubject,
            'class' => $class,
            'subject' => $subject,
        ]);
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
                    $mydate = new \DateTime();
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
                        $attendance = DB::table('attendance')
                        ->join('subject','attendance.idSubject','=','subject.idSubject')
                        ->join('classroom','attendance.idClass','=','classroom.idClass')
                        ->select('attendance.*','classroom.nameClass','subject.nameSubject')
                        ->get();

                        return view('attendance.diary',[
                            'index' => 1,
                            'attendance' => $attendance
                        ]);
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
        $data = json_decode($request->data, true);
        $idAssign = json_decode($request->idAssign, true);
        $getStart = json_decode($request->start, true);
        $getEnd = json_decode($request->end, true);
        
        foreach($idAssign as $assign){
            $idClass = DB::table('assign')
            ->where("idAssign", "=", $assign['value'])
            ->get();
            foreach($getStart as $startTime){
                $start = $startTime['value'];
                foreach($getEnd as $endTime){
                    $end = $endTime['value'];
                    
                    $attendance = new Attendance();
                    $attendance->dateAttendance = new Datetime();
                    $attendance->idClass = $idClass->idClass;
                    $attendance->idSubject = $idClass->idSubject;
                    $attendance->start = $start;
                    $attendance->end = $end;
                    $attendance->save();
                }
            }
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
        $detail = DB::table('detailattendance')
        ->select('detailattendance.*','student.nameStudent')
        ->join('student','detailattendance.idStudent','=','student.idStudent')
        ->join('attendance','detailattendance.idAttendance','=','attendance.idAttendance')
        ->where('detailattendance.idAttendance',$id)
        ->get();

        return view('attendance.detailAttendance',[
            'index' => 1,
            'detail' => $detail
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
