<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\LoginModel;
use Auth;
use DB;
use App\Models\Assign;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AssignImport;

class AssignController extends Controller
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
        ->select('classroom.*')
        ->where('classroom.available','=', 1)
        ->get();

        $idTeacher = $request->get("idTeacher");
        $teacher = DB::table('teacher')
        ->where('available','=', 1)
        ->get();

        
        
        $data = DB::table('assign')
        ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
        ->join('faculty', 'classroom.idFaculty', '=', 'faculty.idFaculty')
        ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
        ->join('teacher', 'assign.idTeacher', '=', 'teacher.idTeacher')
        ->where('assign.idClass', '=', $idClass)
        ->orwhere('assign.idTeacher', '=', $idTeacher)
        ->where('assign.available', '=', 1)
        ->select('assign.*', 'classroom.nameClass', 'subject.*','faculty.nameFaculty', 'teacher.firstName', 'teacher.middleName', 'teacher.lastName' )
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
        // dd($timeEnd);
        return view("assign.index",[
            'data' => $data,
            'idClass' => $idClass,
            'idTeacher' => $idTeacher,
            'class' => $class,
            'teacher' => $teacher,
            'timeStarts' => $timeStart,
            'timeEnds' => $timeEnd,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $class = DB::table("classroom")
            ->where("available", "=", 1)
            ->select("*")
            ->get();

        $subject = DB::table("subject")
            ->where("available", "=", 1)
            ->select("*")
            ->get();
        
        $teacher = DB::table("teacher")
            ->where("available", "=", 1)
            ->select("*")
            ->get();

        return view("assign.create",['class' => $class, 'subject' => $subject, 'teacher'=> $teacher ]);
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
            $idClass = $request->input("idClass");
            $idSubject = $request->input("idSubject");
            $idTeacher = $request->input("idTeacher");
            $startDate = $request->input("startDate");
            $date = $request->input("date");

            

                if(DB::table('assign')->where('idSubject', '=', $idClass)->exists() ){

                    if (DB::table('assign')->where('idSubject', '=', $idClass)->where('idTeacher', '=', $idSubject)->exists()){

                        if (DB::table('assign')->where('idSubject', '=', $idClass)->where('idTeacher', '=', $idSubject)->where('idTeacher', '=', $idTeacher)->exists()){
                            return redirect('assign');
                        }else{
                            $assign = new Assign();
                            $assign->idClass = $idClass;
                            $assign->idSubject = $idSubject;
                            $assign->idTeacher = $idTeacher;
                            $assign->start_date = $startDate;
                            $assign->date = $date;
                            $assign->available = 1;
                            $assign->save();
                            $alert="Phân công đã được thêm thành công!";
                            return redirect()->back()->with('alert',$alert);
                        }
                    }else{
                        $assign = new Assign();
                        $assign->idClass = $idClass;
                        $assign->idSubject = $idSubject;
                        $assign->idTeacher = $idTeacher;
                        $assign->start_date = $startDate;
                        $assign->date = $date;
                        $assign->available = 1;
                        $assign->save();
                        $alert="Phân công đã được thêm thành công!";
                        return redirect()->back()->with('alert',$alert);
                    }
                    
                }else{
                    $assign = new Assign();
                    $assign->idClass = $idClass;
                    $assign->idSubject = $idSubject;
                    $assign->idTeacher = $idTeacher;
                    $assign->start_date = $startDate;
                    $assign->date = $date;
                    $assign->available = 1;
                    $assign->save();
                    $alert="Phân công đã được thêm thành công!";
                    return redirect()->back()->with('alert',$alert);
                }
        }
            return view("assign.create");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Hàm dành cho việc xem lịch học
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
        
        $assign = DB::table("assign")
        ->where("idAssign","$id")
        ->get();

        $subject = DB::table("subject")
        ->get();

        $teacher = DB::table("teacher")
        ->get();

        $class = DB::table("classroom")
        ->get();

        $faculty = DB::table("faculty")
        ->get();

        return view("assign.update",[
            'class' => $class, 
            'assign' => $assign, 
            'subject' => $subject,
            'teacher' => $teacher,
            'faculty' => $faculty 
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
        $idClass = $request->input("idClass");
        $idSubject = $request->input("idSubject");
        $idTeacher = $request->input("idTeacher");
        $startDate = $request->input("startDate");
        $date = $request->input("date");
        // dd($date);
        // return $startDate;
        // return $request->input('firstName');


            if(DB::table('assign')->where('idClass', '=', $idClass)->exists()){

                if (DB::table('assign')->where('idClass', '=', $idClass)->where('idSubject', '=', $idSubject)->exists()) {
                    
                    if (DB::table('assign')->where('idClass', '=', $idClass)->where('idSubject', '=', $idSubject)->where('idTeacher', '=', $idTeacher)->exists()) {

                        if (DB::table('assign')->where('idClass', '=', $idClass)->where('idSubject', '=', $idSubject)->where('idTeacher', '=', $idTeacher)->where('date', '=', $date)->exists()){
                            return redirect('assign');
                        }else{
                            $data = Assign::find($id);
            
                            $data->idClass = $idClass;
                            $data->idSubject = $idSubject;
                            $data->idTeacher = $idTeacher;
                            $data->start_date = $startDate;
                            $data->date = $date;
        
                            $data->save();
                            // return $data;
                            // return redirect('assign');
                            $alert="Phân công đã được cập nhật thành công!";
                            return redirect()->back()->with('alert',$alert);
                        }
                        
                    }else{
                        $data = Assign::find($id);
            
                        $data->idClass = $idClass;
                        $data->idSubject = $idSubject;
                        $data->idTeacher = $idTeacher;
                        $data->start_date = $startDate;
                        $data->date = $date;
    
                        $data->save();
                        // return $data;
                        // return redirect('assign');
                        $alert="Phân công đã được cập nhật thành công!";
                        return redirect()->back()->with('alert',$alert);
                    }
                }else{
                    $data = Assign::find($id);
        
                    $data->idClass = $idClass;
                    $data->idSubject = $idSubject;
                    $data->idTeacher = $idTeacher;
                    $data->start_date = $startDate;
                    $data->date = $date;

                    $data->save();
                    // return $data;
                    // return redirect('assign');
                    $alert="Phân công đã được cập nhật thành công!";
                    return redirect()->back()->with('alert',$alert);
                }
            }else{

                $data = Assign::find($id);
                $data->idClass = $idClass;
                $data->idSubject = $idSubject;
                $data->idTeacher = $idTeacher;
                $data->start_date = $startDate;
                $data->date = $date;

                $data->save();
                // return $data;
                // return redirect('assign');
                $alert="Phân công đã được cập nhật thành công!";
                return redirect()->back()->with('alert',$alert);
            }
         
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
        $data = Assign::find($id);       
        $data->available = 0;
        $data->save();
        return redirect('assign');
        
    }

    public function insertExcel()
    {
        return view("assign.insertExcel");
    }

    public function insertExcelProcess(Request $request)
    {
        try{
            Excel::import(new AssignImport, $request->file("nameAssign"));
            return redirect("assign")->with('success', 'Thêm mới thành công!');
        }catch(\Maatwebsite\Excel\Validators\ValidationException $e){
            $failures = $e->failures();
            return back()->with('failures', $failures);
        }
        
        return redirect("assign")->with('success', 'Thêm mới thành công!');
    }
}
