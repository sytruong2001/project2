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
    public function index()
    {
        //
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
        ->select('detailattendance.*','student.firstName','student.lastName','student.middleName')
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
