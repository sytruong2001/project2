<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Session::exists('admin_id')) {
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

            return view('index', [
                'teacher' => $teacher,
                'student' => $student,
                'subject' => $subject,
                'class' => $class,
                'major' => $major,
                'faculty' => $faculty,
                'assign' => $assign
            ]);
        } else {
            return redirect('logout');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //  Chức năng xem thông tin điểm danh dành cho sinh viên
    public function create(Request $request)
    {

        if (Session::exists("student_id")) {
            $idStudent = Session::get("student_id");
        }
        // lấy mã lớp từ bảng student thông qua mã idStudent
        $student = DB::table('student')->select('student.*')->where('idStudent', $idStudent)->get();
        foreach ($student as $student) {
            $idClass = $student->idClass;
        }
        // nhận mã phân công khi sinh viên chọn 1 môn được phân công học
        $idAssign = $request->get("idAssign");
        if (isset($idAssign)) {
            // lấy thông tin bảng điểm danh dựa vào mã phân công và mã sinh viên
            $attendance = DB::table('attendance')
                ->join('assign', 'attendance.idAssign', '=', 'assign.idAssign')
                ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                ->join('detailattendance', 'attendance.idAttendance', '=', 'detailattendance.idAttendance')
                ->where('attendance.idAssign', '=', $idAssign)
                ->where('detailattendance.idStudent', '=', $idStudent)
                ->select('attendance.*', 'classroom.nameClass', 'subject.nameSubject', 'detailattendance.status')
                ->get();
            $idAtt = DB::table('attendance')
                ->join('assign', 'attendance.idAssign', '=', 'assign.idAssign')
                ->where('attendance.idAssign', '=', $idAssign)
                ->select('attendance.idAttendance')
                ->get();
            // lấy thông tin của sinh viên
            $info = DB::table('student')
                ->join('classroom', 'student.idClass', '=', 'classroom.idClass')
                ->select('student.*', 'classroom.nameClass')
                ->where('idStudent', $idStudent)
                ->get();
            // lấy thông tin phân công của lớp mà sinh viên có mặt
            $resultAssign = DB::table('assign')
                ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                ->select('assign.*', 'classroom.nameClass', 'subject.nameSubject')
                ->where('assign.available', '=', 1)
                ->where('assign.idClass', '=', $idClass)
                ->get();
            return view('indexStudent', [
                'index' => 1,
                'attendance' => $attendance,
                'assign' => $resultAssign,
                'idAssign' => $idAssign,
                'student' => $info,
                // 'status' => $status,
            ]);
            // Nếu không nhận được mã phân công
        } else {
            $idAssign = '';
            // lấy thông tin phân công dựa vào mã lớp
            $assign = DB::table('assign')
                ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                ->select('assign.*', 'classroom.nameClass', 'subject.nameSubject')
                ->where('assign.available', '=', 1)
                ->where('assign.idClass', '=', $idClass)
                ->get();
            // gán biến kiểm tra thông tin phân công có tồn tại dữ liệu hay không nếu có giá trị được gán vào là 1 ngược lại là 2
            $checkAssign = empty($assign) ? 1 : 2;
            if ($checkAssign == 1 && $checkAssign != 2) {
                // dùng vòng lặp để lấy dữ liệu điểm danh cho từng mã phân công tìm thấy
                foreach ($assign as $assign) {
                    $attendance = DB::table('attendance')
                        ->join('assign', 'attendance.idAssign', '=', 'assign.idAssign')
                        ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                        ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                        ->where('attendance.idAssign', '=', $assign->idAssign)
                        ->select('attendance.*', 'classroom.nameClass', 'subject.nameSubject')
                        ->get();
                }
                // thông tin sinh viên
                $info = DB::table('student')
                    ->join('classroom', 'student.idClass', '=', 'classroom.idClass')
                    ->select('student.*', 'classroom.nameClass')
                    ->where('idStudent', $idStudent)
                    ->get();
                // thông tin phân công
                $resultAssign = DB::table('assign')
                    ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                    ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                    ->select('assign.*', 'classroom.nameClass', 'subject.nameSubject')
                    ->where('assign.available', '=', 1)
                    ->where('assign.idClass', '=', $idClass)
                    ->get();
                return view('indexStudent', [
                    'index' => 1,
                    'attendance' => $attendance,
                    'assign' => $resultAssign,
                    'idAssign' => $idAssign,
                    'student' => $info,
                ]);
                // những sinh viên chưa được phân công học bất cứ môn nào
            } else {
                $attendance = "";
                $info = DB::table('student')
                    ->join('classroom', 'student.idClass', '=', 'classroom.idClass')
                    ->select('student.*', 'classroom.nameClass')
                    ->where('idStudent', $idStudent)
                    ->get();
                $resultAssign = DB::table('assign')
                    ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                    ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                    ->select('assign.*', 'classroom.nameClass', 'subject.nameSubject')
                    ->where('assign.available', '=', 1)
                    ->where('assign.idClass', '=', $idClass)
                    ->get();
                return view('indexStudent', [
                    'index' => 1,
                    'attendance' => $attendance,
                    'assign' => $resultAssign,
                    'idAssign' => $idAssign,
                    'student' => $info,
                ]);
            }
        }
        // return view('indexStudent');
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
    // Chức năng dành cho xem lịch học
    public function show($id)
    {
        if (Session::exists("student_id")) {
            $idStudent = Session::get("student_id");
        }
        // lấy mã lớp từ bảng student thông qua mã idStudent
        $student = DB::table('student')->select('student.*')->where('idStudent', $idStudent)->get();
        foreach ($student as $student) {
            $idClass = $student->idClass;
        }
        $assign = DB::table("assign")
            ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
            ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
            ->join('teacher', 'assign.idTeacher', '=', 'teacher.idTeacher')
            ->select("assign.*", "teacher.*", "classroom.nameClass", "subject.*")
            ->where("assign.idClass", $idClass)
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


        return view("student.ScheduleStudent", [
            'assign' => $assign,
            'timeStart' => $timeStart,
            'timeEnd' => $timeEnd,
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