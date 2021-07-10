<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\LoginModel;
use Auth;
use DB;
use App\Models\Major;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MajorImport;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table("major")
                ->where("available", "=", 1)
                ->paginate(5);
        return view("major.index",['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("major.create");
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
            $nameMajor = $request->input("nameMajor");

            $major = new Major();
            $major->nameMajor = $nameMajor;

            $major->save();
            return redirect('major');
        }
        return view("major.create");
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
        $query = DB::table("major");
        $query = $query->where("idMajor","$id");
        $query = $query->select("*");
        $data = $query->paginate(10);
        // return $data;
        return view("major.update",['data' => $data ]);
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
        $nameMajor = $request->input("nameMajor");

        $data = Major::find($id);
        
        $data->nameMajor = $nameMajor;

        $data->save();
        return redirect('major');
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
                ->where("idMajor", "=", $id)
                ->update(["available" => 0]);
        $subject = DB::table("subject")
                ->where("idMajor", "=", $id)
                ->update(["available" => 0]);
        $data = Major::find($id);       
        $data->available = 0;
        $data->save();
        return redirect('major');
        
    }

    public function insertExcel()
    {
        return view("major.insertExcel");
    }

    public function insertExcelProcess(Request $request)
    {
        Excel::import(new MajorImport, $request->file("nameMajor"));
        return redirect("major");
    }
}
