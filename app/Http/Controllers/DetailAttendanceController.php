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
            'detail' => $detail
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
