<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session, DateTime;
use App\Models\Attendance;
use App\Models\DetailAttendance;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Function dùng cho việc truy xuất dữ liệu điểm danh
    public function index(Request $request)
    {
        // dành cho giáo vụ
        if (Session::exists("admin_id")) {
            // nhận mã phân công dạy
            $idAssign = $request->get("idAssign");
            // nếu có mã phân công được gửi lên
            if (isset($idAssign)) {
                // lấy dữ liệu liên quan đến bảng phân công
                $assign = DB::table('assign')
                    ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                    ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                    ->select('assign.*', 'classroom.nameClass', 'subject.nameSubject')
                    ->where('assign.available', '=', 1)
                    ->get();

                // lấy dữ liệu điểm danh dựa trên mã phân công
                $attendance = DB::table('attendance')
                    ->join('assign', 'attendance.idAssign', '=', 'assign.idAssign')
                    ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                    ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                    ->where('attendance.idAssign', '=', $idAssign)
                    ->select('attendance.*', 'classroom.nameClass', 'subject.nameSubject')
                    ->get();
                // trả về trang view
                return view('attendance.diary', [
                    'index' => 1,
                    'attendance' => $attendance,
                    'assign' => $assign,
                    'idAssign' => $idAssign,
                ]);
                // nếu không có mã phân công gửi lên
            } else {
                $idAssign = '';
                // lấy dữ liệu phân công
                $assign = DB::table('assign')
                    ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                    ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                    ->select('assign.*', 'classroom.nameClass', 'subject.nameSubject')
                    ->where('assign.available', '=', 1)
                    ->get();
                // lấy dữ liệu điểm danh
                $attendance = DB::table('attendance')
                    ->join('assign', 'attendance.idAssign', '=', 'assign.idAssign')
                    ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                    ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                    ->where('attendance.idAssign', '=', $idAssign)
                    ->select('attendance.*', 'classroom.nameClass', 'subject.nameSubject')
                    ->get();
                // trả về trang view
                return view('attendance.diary', [
                    'index' => 1,
                    'attendance' => $attendance,
                    'assign' => $assign,
                    'idAssign' => $idAssign
                ]);
            }
            // dành cho giảng viên
        } elseif (Session::exists("user_id")) {
            // lấy mã phân công + mã giảng viên
            $idAssign = $request->get("idAssign");
            $idTeacher = Session::get("user_id");
            // nếu có mã phân công
            if (isset($idAssign)) {
                $assign = DB::table('assign')
                    ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                    ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                    ->select('assign.*', 'classroom.nameClass', 'subject.nameSubject')
                    ->where('assign.available', '=', 1)
                    ->where('idTeacher', '=', $idTeacher)
                    ->get();
                // lấy dữ liệu điểm danh dựa vào mã phân công
                $attendance = DB::table('attendance')
                    ->join('assign', 'attendance.idAssign', '=', 'assign.idAssign')
                    ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                    ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                    ->where('attendance.idAssign', '=', $idAssign)
                    ->select('attendance.*', 'classroom.nameClass', 'subject.nameSubject')
                    ->get();

                return view('attendance.diary', [
                    'index' => 1,
                    'attendance' => $attendance,
                    'assign' => $assign,
                    'idAssign' => $idAssign,
                ]);
                // nếu không có mã phân công
            } else {
                $idAssign = '';
                $assign = DB::table('assign')
                    ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                    ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                    ->select('assign.*', 'classroom.nameClass', 'subject.nameSubject')
                    ->where('assign.available', '=', 1)
                    ->where('idTeacher', '=', $idTeacher)
                    ->get();

                $attendance = DB::table('attendance')
                    ->join('assign', 'attendance.idAssign', '=', 'assign.idAssign')
                    ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                    ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                    ->where('attendance.idAssign', '=', $idAssign)
                    ->select('attendance.*', 'classroom.nameClass', 'subject.nameSubject')
                    ->get();

                return view('attendance.diary', [
                    'index' => 1,
                    'attendance' => $attendance,
                    'assign' => $assign,
                    'idAssign' => $idAssign
                ]);
            }
        }
    }
    // function dùng để xử lý điểm danh rồi hay chưa?
    public function search(Request $request)
    {
        if ($request->isMethod("post")) {
            // lấy mã phân công
            $idAssign = $request->input("idAssign");
            // return $idAssign;
            // lấy thông tin về phân công dựa vào mã lấy được
            $getID = DB::table('assign')
                ->select('assign.*', 'classroom.nameClass', 'subject.nameSubject')
                ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                ->distinct('assign.idSubject', 'assign.idClass', 'assign.start', 'assign.end')
                ->where('idAssign', '=', $idAssign)
                ->get();
            // return $idClass;
            // return $getID;
            // kiểm tra thông tin có tồn tại hoặc rỗng hay không?
            if ($getID != null || count($getID) > 0) {
                foreach ($getID as $getID) {
                    $mydate = new DateTime();
                    $mydate->modify('+7 hours');
                    $curentDate = $mydate->format('Y-m-d');

                    // đếm xem nay đã điểm danh cho mã phân công được nhận hay chưa
                    $count = DB::table('attendance')
                        ->where('idAssign', '=', $getID->idAssign)
                        ->where('created_at', '>=', $curentDate)
                        ->select('*')
                        ->count();
                    // nếu chưa điểm danh thì lấy dữ liệu về sinh viên sẽ được điểm danh
                    if ($count == null || $count == 0) {
                        // lấy dữ liệu bảng lớp
                        $idClass = DB::table('assign')
                            ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                            ->select('assign.idClass')
                            ->where('assign.available', '=', 1)
                            ->where('assign.idAssign', '=', $idAssign)
                            ->get();
                        // lấy dữ liệu bảng môn học
                        $idSubject = DB::table('assign')
                            ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                            ->select('assign.idSubject')
                            ->where('assign.available', '=', 1)
                            ->where('assign.idAssign', '=', $idAssign)
                            ->get();

                        foreach ($idClass as $idClass) {

                            foreach ($idSubject as $idSubject) {

                                $countAttendance = DB::table('attendance')
                                    ->where('attendance.idAssign', '=', $idAssign)
                                    ->count();

                                // test thống kê
                                $idStudent = DB::table('assign')
                                    ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                                    ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                                    ->join('student', 'classroom.idClass', '=', 'student.idClass')
                                    ->where('assign.idClass', '=', $idClass->idClass)
                                    ->where('assign.idSubject', '=', $idSubject->idSubject)
                                    ->select('student.idStudent')
                                    ->get();
                                $resultArray = [];
                                foreach ($idStudent as $student) {
                                    $query = DB::table('attendance')
                                        ->join('detailattendance', 'attendance.idAttendance', '=', 'detailattendance.idAttendance')
                                        ->where('attendance.idAssign', $idAssign)
                                        ->where('detailattendance.idStudent', $student->idStudent)
                                        ->selectRaw('idStudent,SUM(IF(detailattendance.status = 0, 1, 0)) as dihoc,
                                            SUM(IF(detailattendance.status = 1, 1, 0)) as nghiKp,
                                            SUM(IF(detailattendance.status = 2, 1, 0)) as dimuon,
                                            SUM(IF(detailattendance.status = 3, 1, 0)) as nghiP')
                                        ->groupBy('idStudent')
                                        ->get();
                                    array_push($resultArray, $query);
                                }
                            }
                        }
                        $student = DB::table('student')
                            ->where('idClass', '=', $getID->idClass)
                            ->get();
                        // nếu điểm danh rồi thì quay về trang ban đầu và hiện thông báo
                    } else {
                        if (Session::exists("user_id")) {
                            $idTeacher = Session::get("user_id");
                            $view = DB::table('assign')
                                ->select('assign.*', 'classroom.nameClass', 'subject.nameSubject')
                                ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                                ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                                ->distinct('assign.idSubject', 'assign.idClass')
                                ->where('assign.idTeacher', '=', $idTeacher)
                                ->get();
                            // return $subject;
                            $infoError = DB::table('attendance')
                                ->where('idAssign', '=', $getID->idAssign)
                                ->where('created_at', '>=', $curentDate)
                                ->select('*')
                                ->get();
                            return view('attendance.index', ['view' => $view, 'infoError' => $infoError])->with("message", "Lớp bạn vừa lựa chọn hôm nay đã được điểm danh =((");
                        }
                    }
                }
            }
            // dd($resultArray);
            return view('attendance.index', [
                'index' => 1,
                'student' => $student,
                'count' => $count,
                'results' => $resultArray,
                'countAttendance' => $countAttendance,
                'assign' => $getID
            ]);
        }
        if (Session::exists("user_id")) {
            $idTeacher = Session::get("user_id");
            $date = Carbon::now()->dayOfWeek;
            if ($date == 1 || $date == 3 || $date == 5) {
                $date = 0;
            } elseif ($date == 2 || $date == 4 || $date == 6) {
                $date = 1;
            }
            $view = DB::table('assign')
                ->select('assign.*', 'classroom.nameClass', 'subject.nameSubject')
                ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                ->distinct('assign.idSubject', 'assign.idClass')
                ->where('assign.idTeacher', '=', $idTeacher)
                ->where('assign.date', '=', $date)
                ->where('assign.available', '=', 1)
                ->get();
            // return $subject;

            return view('attendance.index', ['view' => $view]);
        }
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

    // function dùng để lưu thông tin điểm danh
    public function store(Request $request)
    {
        //lấy dữ liệu từ form khi điểm danh
        $idAssign = $request->get("idAssign");
        $assign = DB::table("assign")
            ->where("idAssign", "=", $idAssign)
            ->get();
        //từ mã phân công có thể lấy ra được mã lớp và mã môn học
        foreach ($assign as $assign) {
            $idClass = $assign->idClass;
            $idSubject = $assign->idSubject;
        }
        //thời gian bắt đầu và kết thúc
        $start = $request->get("start");

        $end = $request->get("end");
        //dữ liệu của sinh viên được lấy ra dựa vào mã lớp lấy được ở trên
        $student = DB::table("student")
            ->where("idClass", "=", $idClass)
            ->get();
        // lưu tất cả dữ liệu lấy được ở trên đưa vào bảng điểm danh
        $date = new Datetime();

        $attendance = new Attendance();
        $attendance->dateAttendance = new Datetime();
        $attendance->idAssign = $idAssign;
        $attendance->start = $start;
        $attendance->end = $end;
        $attendance->save();

        // sau khi lưu vào bảng điểm danh thì lấy mã điểm danh vừa mới thêm
        $Att = DB::table('Attendance')->orderBy('idAttendance', 'desc')->first();
        $idAttendance = $Att->idAttendance;
        //dùng vòng lặp để lấy ra được mã sinh viên và trạng thái điểm danh lấy từ mã sinh viên request từ bên form gửi qua
        foreach ($student as $student) {
            $idStudent = $student->idStudent;
            $status = $request[$student->idStudent];
            // lưu dữ liệu vào bảng điểm danh chi tiết
            $data = new DetailAttendance();
            $data->idStudent = $idStudent;
            $data->idAttendance = $idAttendance;
            $data->status = $status;
            $data->save();
        }
        // sau khi lưu thành công thì lấy dữ liệu cuổi lần điểm danh vừa nãy
        if (Session::exists("user_id")) {
            $idTeacher = Session::get("user_id");
            // lấy dữ liệu phân công
            $view = DB::table('assign')
                ->select('assign.*', 'classroom.nameClass', 'subject.*')
                ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                ->join('classroom', 'assign.idClass', '=', 'classroom.idClass')
                ->distinct('assign.idSubject', 'assign.idClass')
                ->where('assign.idTeacher', '=', $idTeacher)
                ->get();
            // lấy dữ liệu điểm danh
            $inforAttendance = DB::table('attendance')
                ->select(DB::raw('idAssign, COUNT(idAttendance) AS count_attendance'))
                ->where('attendance.idAssign', $idAssign)
                ->groupBy('idAssign')
                ->orderBy('count_attendance', 'desc')
                ->get();
            // Thời lượng môn học
            $duration = DB::table('assign')
                ->select('subject.duration')
                ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                ->where('assign.idTeacher', '=', $idTeacher)
                ->where('assign.idAssign', '=', $idAssign)
                ->get();
            // Thời lượng đã dạy học
            $timeStart = DB::table('attendance')
                ->select(DB::raw('idAssign, SUM(start) AS sum_start'))
                ->where('attendance.idAssign', $idAssign)
                ->groupBy('idAssign')
                ->orderBy('sum_start', 'desc')
                ->get();
            $timeEnd = DB::table('attendance')
                ->select(DB::raw('idAssign, SUM(end) AS sum_end'))
                ->where('attendance.idAssign', $idAssign)
                ->groupBy('idAssign')
                ->orderBy('sum_end', 'desc')
                ->get();
            foreach ($duration as $duration) {
                foreach ($timeStart as $timeStart) {
                    foreach ($timeEnd as $timeEnd) {
                        $timeDone = ($timeEnd->sum_end - $timeStart->sum_start) / 10000;
                        $timeHave = ($duration->duration - $timeDone);
                    }
                }
            }

            $duration1 = DB::table('assign')
                ->select('subject.duration')
                ->join('subject', 'assign.idSubject', '=', 'subject.idSubject')
                ->where('assign.idTeacher', '=', $idTeacher)
                ->where('assign.idAssign', '=', $idAssign)
                ->get();
            // Tình trạng điểm danh của buổi hôm nay
            $dihocs = DB::table('detailattendance')
                ->select(DB::raw('idAttendance, COUNT(status) AS count_dihoc'))
                ->where('status', 0)
                ->where('idAttendance', '=', $idAttendance)
                ->groupBy('idAttendance')
                ->orderBy('count_dihoc', 'desc')
                ->get();
            $countDH = $dihocs->count();
            if ($countDH == 0) {
                $dihocs = $countDH;
            }
            $dimuons = DB::table('detailattendance')
                ->select(DB::raw('idAttendance, COUNT(status) AS count_dimuon'))
                ->where('status', 2)
                ->where('idAttendance', '=', $idAttendance)
                ->groupBy('idAttendance')
                ->orderBy('count_dimuon', 'desc')
                ->get();
            $countDM = $dimuons->count();
            if ($countDM == 0) {
                $dimuons = $countDM;
            }
            $nghiPs = DB::table('detailattendance')
                ->select(DB::raw('idAttendance, COUNT(status) AS count_nghiP'))
                ->where('status', '=', 3)
                ->where('idAttendance', '=', $idAttendance)
                ->groupBy('idAttendance')
                ->orderBy('count_nghiP', 'desc')
                ->get();
            $countNP = $nghiPs->count();
            if ($countNP == 0) {
                $nghiPs = $countNP;
            }
            $nghiKps = DB::table('detailattendance')
                ->select(DB::raw('idAttendance, COUNT(status) AS count_nghiKp'))
                ->where('status', '=', 1)
                ->where('idAttendance', '=', $idAttendance)
                ->groupBy('idAttendance')
                ->orderBy('count_nghiKp', 'desc')
                ->get();
            $countNKP = $nghiKps->count();
            if ($countNKP == 0) {
                $nghiKps = $countNKP;
            }
            return view(
                'attendance.index',
                [
                    'view' => $view,
                    'dihoc' => $dihocs,
                    'dimuon' => $dimuons,
                    'nghiP' => $nghiPs,
                    'nghiKp' => $nghiKps,
                    'countDH' => $countDH,
                    'countDM' => $countDM,
                    'countNP' => $countNP,
                    'countNKP' => $countNKP,
                    'inforAttendance' => $inforAttendance,
                    'timeHave' => $timeHave,
                    'timeDone' => $timeDone,
                    'duration' => $duration1,

                ]
            )->with("success", "Đã điểm danh thành công");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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