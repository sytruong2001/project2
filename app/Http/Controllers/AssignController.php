<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\LoginModel;
use Auth;
use DB;
use App\Models\Assign;

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
        ->join('faculty', 'classroom.idFaculty', '=', 'faculty.idFaculty')
        ->select('classroom.*', 'faculty.nameFaculty')
        ->where('classroom.available','=', 1)
        ->get();

        $idTeacher = $request->get("idTeacher");
        $teacher = DB::table('teacher')
        ->where('available','=', 1)
        ->get();

        $query = DB::table('assign')
        ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
        ->join('faculty', 'assign.idFaculty', '=', 'faculty.idFaculty')
        ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
        ->join('teacher', 'assign.idTeacher', '=', 'teacher.idTeacher')
        ->where('assign.idClass', '=', $idClass)
        ->orwhere('assign.idTeacher', '=', $idTeacher)
        ->where('assign.available', '=', 1)
        ->select('assign.*', 'classroom.nameClass', 'subject.nameSubject','faculty.nameFaculty', 'teacher.firstName', 'teacher.middleName', 'teacher.lastName' )
        ->get();
        return view("assign.index",[
            'data' => $query,
            'idClass' => $idClass,
            'idTeacher' => $idTeacher,
            'class' => $class,
            'teacher' => $teacher,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $query = DB::table("classroom");
        $query = $query->select("*");
        $class = $query->paginate(10);

        $query = DB::table("subject");
        $query = $query->select("*");
        $subject = $query->paginate(10);
        
        $query = DB::table("teacher");
        $query = $query->select("*");
        $teacher = $query->paginate(10);

        $query = DB::table("faculty");
        $query = $query->select("*");
        $faculty = $query->paginate(10);

        return view("assign.create",['faculty' => $faculty,'class' => $class, 'subject' => $subject, 'teacher'=> $teacher ]);
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
            $idFaculty = $request->input("idFaculty");
            $idSubject = $request->input("idSubject");
            $idTeacher = $request->input("idTeacher");
            $startDate = $request->input("startDate");

            if (DB::table('assign')->where('idClass', '=', $idFaculty)->exists()) {

                if(DB::table('assign')->where('idClass', '=', $idFaculty)->where('idSubject', '=', $idClass)->exists() ){

                    if (DB::table('assign')->where('idClass', '=', $idFaculty)->where('idSubject', '=', $idClass)->where('idTeacher', '=', $idSubject)->exists()){

                        if (DB::table('assign')->where('idClass', '=', $idFaculty)->where('idSubject', '=', $idClass)->where('idTeacher', '=', $idSubject)->where('idTeacher', '=', $idTeacher)->exists()){
                            return redirect('assign');
                        }else{
                            $assign = new Assign();
                            $assign->idClass = $idClass;
                            $assign->idFaculty = $idFaculty;
                            $assign->idSubject = $idSubject;
                            $assign->idTeacher = $idTeacher;
                            $assign->start_date = $startDate;
                            $assign->available = 1;
                            $assign->save();
                            return redirect('assign');
                        }
                    }else{
                        $assign = new Assign();
                        $assign->idClass = $idClass;
                        $assign->idFaculty = $idFaculty;
                        $assign->idSubject = $idSubject;
                        $assign->idTeacher = $idTeacher;
                        $assign->start_date = $startDate;
                        $assign->available = 1;
                        $assign->save();
                        return redirect('assign');
                    }
                    
                }else{
                    $assign = new Assign();
                    $assign->idClass = $idClass;
                    $assign->idFaculty = $idFaculty;
                    $assign->idSubject = $idSubject;
                    $assign->idTeacher = $idTeacher;
                    $assign->start_date = $startDate;
                    $assign->available = 1;
                    $assign->save();
                    return redirect('assign');
                }
             }else{
                $assign = new Assign();
                $assign->idClass = $idClass;
                $assign->idFaculty = $idFaculty;
                $assign->idSubject = $idSubject;
                $assign->idTeacher = $idTeacher;
                $assign->start_date = $startDate;
                $assign->available = 1;
                $assign->save();
                return redirect('assign');
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
        $query = DB::table("assign");
        $query = $query->where("idAssign","$id");
        $query = $query->select("*");
        $assign = $query->paginate(10);

        $query = DB::table("subject");
        $query = $query->select("*");
        $subject = $query->paginate(10);

        $query = DB::table("teacher");
        $query = $query->select("*");
        $teacher = $query->paginate(10);

        $query = DB::table("classroom");
        $query = $query->select("*");
        $class = $query->paginate(10);

        $query = DB::table("faculty");
        $query = $query->select("*");
        $faculty = $query->paginate(10);

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
        $idFaculty = $request->input("idFaculty");
        $idSubject = $request->input("idSubject");
        $idTeacher = $request->input("idTeacher");
        $startDate = $request->input("startDate");

        // return $startDate;
        // return $request->input('firstName');

        if (DB::table('assign')->where('idFaculty', '=', $idFaculty)->exists()) {

            if(DB::table('assign')->where('idFaculty', '=', $idFaculty)->where('idClass', '=', $idClass)->exists()){

                if (DB::table('assign')->where('idFaculty', '=', $idFaculty)->where('idClass', '=', $idClass)->where('idSubject', '=', $idSubject)->exists()) {
                    
                    if (DB::table('assign')->where('idFaculty', '=', $idFaculty)->where('idClass', '=', $idClass)->where('idSubject', '=', $idSubject)->where('idTeacher', '=', $idTeacher)->exists()) {
                        return redirect('assign');
                    }else{
                        $data = Assign::find($id);
            
                        $data->idClass = $idClass;
                        $data->idFaculty = $idFaculty;
                        $data->idSubject = $idSubject;
                        $data->idTeacher = $idTeacher;
                        $data->start_date = $startDate;
    
                        $data->save();
                        // return $data;
                        return redirect('assign');
                    }
                }else{
                    $data = Assign::find($id);
        
                    $data->idClass = $idClass;
                    $data->idFaculty = $idFaculty;
                    $data->idSubject = $idSubject;
                    $data->idTeacher = $idTeacher;
                    $data->start_date = $startDate;

                    $data->save();
                    // return $data;
                    return redirect('assign');
                }
            }else{

                $data = Assign::find($id);
                $data->idClass = $idClass;
                $data->idFaculty = $idFaculty;
                $data->idSubject = $idSubject;
                $data->idTeacher = $idTeacher;
                $data->start_date = $startDate;

                $data->save();
                // return $data;
                return redirect('assign');
            }
        }else{
            $data = Assign::find($id);
            $data->idClass = $idClass;
            $data->idFaculty = $idFaculty;
            $data->idSubject = $idSubject;
            $data->idTeacher = $idTeacher;
            $data->start_date = $startDate;

            $data->save();
            // return $data;
            return redirect('assign');
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
}
