<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\LoginModel;
use Auth;
use DB;
use App\Models\Subject;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SubjectImport;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $idMajor = $request->get("idMajor");
        $major = DB::table("major")
            ->where('available', '=', 1)
            ->get();
        $query = DB::table('subject')
        ->join('major', 'subject.idMajor', '=', 'major.idMajor')
        ->where('subject.idMajor', '=', $idMajor)
        ->where('subject.available', '=', 1)
        ->select('subject.*', 'major.nameMajor')
        ->get();
        return view("subject.index",[
            'subjects' => $query,
            'idMajor' => $idMajor,
            'major' => $major
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $query = DB::table("major");
        $query = $query->where("available", "=", 1);
        $query = $query->select("*");
        $major = $query->paginate(10);
        return view("subject.create",[
            'major' => $major 
        ]);
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
            $nameSubject = $request->input("nameSubject");
            $idMajor = $request->input("idMajor");
            $duration = $request->input("duration");
            $check = DB::table("subject")
                ->where("nameSubject", "=", $nameSubject)
                ->where("duration", "=", $duration)
                ->count();
            if($check == 0 || $check == null){
                $subject = new subject();
                $subject->nameSubject = $nameSubject;
                $subject->idMajor = $idMajor;
                $subject->duration = $duration;
                $subject->available = 1;

                $subject->save();
                return redirect('subject');
            }
            return redirect('subject');
            
        }
            return view("student.create");
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
        // $data = DB::table('student')
        // ->join('classroom', 'student.idClass', '=', 'classroom.idClass')
        // ->select('student.*', 'classroom.nameClass')
        // ->get();
        // return view("student.update",['class' => $data]);

        $subjects = DB::table("subject")->where("idSubject","$id")->select("*")->get();

        $majors = DB::table("major")->select("*")->get();
        // return $data;
        return view("subject.update",['subjects' => $subjects, 'majors' => $majors ]);
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
        $nameSubject = $request->input("nameSubject");
        $idMajor = $request->input("idMajor");
        $duration = $request->input("duration");

        // return $request->input('firstName');
        $data = Subject::find($id);
        
        $data->nameSubject = $nameSubject;
        $data->idMajor = $idMajor;
        $data->duration = $duration;

        $data->save();
        return redirect('subject');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('subject')->where('idSubject', '=', $id)->delete();
        return redirect('subject');
    }

    public function hide($id)
    {  
        $assign = DB::table("assign")
                ->where("idSubject", "=", $id)
                ->update(["available" => 0]);

        $data = Subject::find($id);       
        $data->available = 0;
        $data->save();
        return redirect('subject');
        
    }

    public function insertExcel()
    {
        return view("subject.insertExcel");
    }

    public function insertExcelProcess(Request $request)
    {
        try{
            Excel::import(new SubjectImport, $request->file("nameSubject"));
            return redirect("subject")->with('success', 'Thêm mới thành công!');
        }catch(\Maatwebsite\Excel\Validators\ValidationException $e){
            $failures = $e->failures();
            return back()->with('failures', $failures);
        }
        return redirect("subject")->with('success', 'Thêm mới thành công!');
    }
}
