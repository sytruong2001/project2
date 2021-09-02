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
                        ->join('detailattendance','attendance.idAttendance','=','detailattendance.idAttendance')
                        ->where('attendance.idClass', '=', $idClass->idClass)
                        ->where('attendance.idSubject', '=', $idSubject->idSubject)
                        ->select('attendance.*','classroom.nameClass','subject.nameSubject','detailattendance.*')
                        ->distinct('detailattendance.idStudent')
                        ->get();

                        $countAttendance = DB::table('attendance')
                        ->where('attendance.idClass', '=', $idClass->idClass)
                        ->where('attendance.idSubject', '=', $idSubject->idSubject)
                        ->count();
                        // nháp 
                        $idAtt = DB::table('attendance')
                        ->where('attendance.idClass', '=', $idClass->idClass)
                        ->where('attendance.idSubject', '=', $idSubject->idSubject)
                        ->get();
                        $student = DB::table('student')
                                ->where('idClass', '=', $idClass->idClass)
                                ->get();
                        
                                
                                $dihoc = DB::table('detailattendance')
                                    ->select(DB::raw('DISTINCT idStudent, COUNT(status) AS count_dihoc'))
                                    ->where('status', 0)
                                    ->groupBy('idStudent','idAttendance')
                                    ->orderBy('count_dihoc', 'desc')
                                    ->get();
                                
                                $dimuon = DB::table('detailattendance')
                                    ->select(DB::raw('DISTINCT idStudent, COUNT(status) AS count_dimuon,idAttendance'))
                                    ->where('status', 2)
                                    ->groupBy('idStudent','idAttendance')
                                    ->orderBy('count_dimuon', 'desc')
                                    ->get();
                                    dd($dimuon);
                                $nghiP = DB::table('detailattendance')
                                    ->select(DB::raw('DISTINCT idStudent, COUNT(status) AS count_nghiP'))
                                    ->where('status', '=', 3)
                                    ->groupBy('idStudent','idAttendance')
                                    ->orderBy('count_nghiP', 'desc')
                                    ->get();
                                $nghiKp = DB::table('detailattendance')
                                    ->select(DB::raw('DISTINCT idStudent, COUNT(status) AS count_nghiKp'))
                                    ->where('status', '=', 1)
                                    ->groupBy('idStudent','idAttendance')
                                    ->orderBy('count_nghiKp', 'desc')
                                    ->get();
    
                                // foreach($nghiKp as $nghiKps){
                                //     foreach($dihoc as $dihocs){
                                //         foreach($dimuon as $dimuons){
                                //             foreach($nghiP as $nghiPs){
                                //                 if($nghiKps->idStudent == $dihocs->idStudent && $nghiKps->idStudent == $dimuons->idStudent && $nghiKps->idStudent == $nghiPs->idStudent){
                                //                     $nghi = $nghiKps->count_nghiKp;
                                //                     if($nghiPs->count_nghiP % 2 == 0){
                                //                         $nghi += (1*($nghiPs->count_nghiP/2));
                                //                     }elseif($nghiPs->count_nghiP % 2 == 1){
                                //                         $nghi += ($nghiPs->count_nghiP/2);
                                //                     }elseif($dimuons->count_dimuon % 3 == 0){
                                //                         $nghi += (1*$dimuons->count_dimuon/3);
                                //                     }elseif($dimuons->count_dimuon % 3 == 1){
                                //                         $nghi += ($dimuons->count_dimuon/3);
                                //                     }
                                //                     $per = $nghi/$countAttendance;
                                //                     array_push($arr, $per);
                                //                 }
                                //             }
                                //         }
                                //     }
                                // }
                                // var_dump($arr);
                                return view('attendance.statistical',[
                                    'index' => 1,
                                    'attendance' => $attendance,
                                    'assign' => $assign,
                                    'idAssign' => $idAssign,
                                    'students' => $student,
                                    'dihocs' => $dihoc,
                                    'dimuons' => $dimuon,
                                    'nghiKps' => $nghiKp,
                                    'nghiPs' => $nghiP,
                                    // 'arrs' => $arr,
                                    'countAttendance' => $countAttendance,
                                ]);
                        
                         
                    }
                }   
            }else{
                $idAssign = '';
                $assign = DB::table('assign')
                ->join('faculty', 'assign.idFaculty', '=', 'faculty.idFaculty')
                ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                ->select('assign.*', 'faculty.*', 'classroom.*', 'subject.*')
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
        ->select('detailattendance.*','student.firstName','student.lastName','student.middleName')
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
        ->select('detailattendance.*','student.firstName','student.lastName','student.middleName')
        ->get();

        return view('attendance.updateDetail',[
            'index' => 1,
            'detail' => $detail,
            'idAttendance' => $id
        ]);
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
