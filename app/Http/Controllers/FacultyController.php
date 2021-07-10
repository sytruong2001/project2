<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\LoginModel;
use Auth;
use DB;
use App\Models\Faculty;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\FacultyImport;


class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table("faculty")
            ->where("available", "=", 1)
            ->paginate(5);
        return view("faculty.index",['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("faculty.create");
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
            $nameFaculty = $request->input("nameFaculty");

            $faculty = new Faculty();
            $faculty->nameFaculty = $nameFaculty;

            $faculty->save();
            return redirect('faculty');
        }
        return view("faculty.create");
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
        $query = DB::table("faculty");
        $query = $query->where("idFaculty","$id");
        $query = $query->select("*");
        $data = $query->paginate(10);
        // return $data;
        return view("faculty.update",['data' => $data ]);
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
        $nameFaculty = $request->input("nameFaculty");

        $data = Faculty::find($id);
        
        $data->nameFaculty = $nameFaculty;

        $data->save();
        return redirect('faculty');
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
        $class = DB::table("classroom")
                ->where("idFaculty", "=", $id)
                ->update(["available" => 0]);
        $assign = DB::table("assign")
                ->where("idFaculty", "=", $id)
                ->update(["available" => 0]);
        $data = Faculty::find($id);       
        $data->available = 0;
        $data->save();
        return redirect('faculty');
        
    }

    public function insertExcel()
    {
        return view("faculty.insertExcel");
    }

    public function insertExcelProcess(Request $request)
    {
        Excel::import(new FacultyImport, $request->file("nameFaculty"));
        return redirect("faculty");
    }
}
