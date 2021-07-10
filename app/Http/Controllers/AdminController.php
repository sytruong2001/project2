<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Admin;

class AdminController extends Controller
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
        $data = DB::table("admin")
            ->where("idAdmin", "=", $id)
            ->get();
        return view("info.infoAdmin", [ "data" => $data]);
    }

    public function changePassword(Request $request, $id)
    {
        $newPass = $request->input("newPassword");
        $rePass = $request->input("rePassword");
        if($newPass != $rePass){
            $data = DB::table("admin")->where("idAdmin", "=", $id)->get();
            // return $data;
            return view("info.infoAdmin",['data' => $data ])->with("error","Mật khẩu không trùng khớp! Vui lòng nhập lại");
        }else{
            $data = Admin::find($id);       
            $data->password = md5($newPass);
            $data->save();
            $admin = DB::table("admin")->where("idAdmin", "=", $id)->get();
            return view("info.infoAdmin",['data' => $admin])->with("message","Thay đổi mật khẩu thành công");
        }
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
