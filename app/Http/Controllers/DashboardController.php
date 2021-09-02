<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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
        //
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
