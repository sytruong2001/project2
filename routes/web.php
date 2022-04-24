<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticateController;
use App\Http\Middleware\CheckLogin;
use App\Http\Middleware\CheckLoginStudent;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Đăng nhập dành cho giảng viên và giáo vụ
Route::get('/login', [AuthenticateController::class, "login"])->name("login");
Route::post('/login-process', [AuthenticateController::class, "loginProcess"])->name("login-process");

// Đăng nhập dành cho sinh viên
Route::get('/loginStudent', [AuthenticateController::class, "loginStudent"])->name("loginStudent");
Route::post('/loginStudent-process', [AuthenticateController::class, "loginStudentProcess"])->name("loginStudent-process");

//  Middleware của sinh viên
Route::middleware([CheckLoginStudent::class])->group(function () {
    Route::get('/logout', [AuthenticateController::class, "logout"])->name("logout");
    Route::match(["get", "post"], '/homeStudent/index', ["as" => '/homeStudent/index', "uses" => "DashboardController@create"]);
    // Route::get('/homeStudent', 'DashboardController@create');
    Route::get('/schedule/search/{id}', 'DashboardController@show');
});


// Middleware của giảng viên & giáo vụ
Route::middleware([CheckLogin::class])->group(function () {
    Route::get('/logout', [AuthenticateController::class, "logout"])->name("logout");

    Route::get('/', 'DashboardController@index');

    Route::get('/home', 'DashboardController@index');

    // Thao tác với admin
    Route::resource("admin", AdminController::class);
    Route::prefix("admin")->name('admin.')->group(function () {
        // Route::get('/hide/{id}','TeacherController@hide')->name('hide');
        // Route::get('/showPassword/{id}','TeacherController@showPassword')->name('showPassword');
        Route::post('/changePassword/{id}', 'AdminController@changePassword')->name('changePassword');
        // Route::get('/insert/excel','TeacherController@insertExcel')->name('insert-excel');
        // Route::post('/insert/excel/process','TeacherController@insertExcelProcess')->name('insert-excel-process');
    });

    // Thao tác với teacher
    Route::resource("teacher", TeacherController::class);
    Route::prefix("teacher")->name('teacher.')->group(function () {
        Route::get('/hide/{id}', 'TeacherController@hide')->name('hide');
        Route::get('/showPassword/{id}', 'TeacherController@showPassword')->name('showPassword');
        Route::post('/changePassword/{id}', 'TeacherController@changePassword')->name('changePassword');
        Route::get('/insert/excel', 'TeacherController@insertExcel')->name('insert-excel');
        Route::post('/insert/excel/process', 'TeacherController@insertExcelProcess')->name('insert-excel-process');
    });

    // Thao tác với sinh viên
    Route::resource("student", StudentController::class);
    Route::prefix("student")->name('student.')->group(function () {
        Route::get('/hide/{id}', 'StudentController@hide')->name('hide');
        Route::get('/insert/excel', 'StudentController@insertExcel')->name('insert-excel');
        Route::post('/insert/excel/process', 'StudentController@insertExcelProcess')->name('insert-excel-process');
    });
    // Thao tác với lớp
    Route::resource("class", ClassroomController::class);
    Route::prefix("class")->name('class.')->group(function () {
        Route::get('/hide/{id}', 'ClassroomController@hide')->name('hide');
        Route::get('/insert/excel', 'ClassroomController@insertExcel')->name('insert-excel');
        Route::post('/insert/excel/process', 'ClassroomController@insertExcelProcess')->name('insert-excel-process');
    });
    // Thao tác với ngành
    Route::resource("major", MajorController::class);
    Route::prefix("major")->name('major.')->group(function () {
        Route::get('/hide/{id}', 'MajorController@hide')->name('hide');
        Route::get('/insert/excel', 'MajorController@insertExcel')->name('insert-excel');
        Route::post('/insert/excel/process', 'MajorController@insertExcelProcess')->name('insert-excel-process');
    });
    // Thao tác với khóa
    Route::resource("faculty", FacultyController::class);
    Route::prefix("faculty")->name('faculty.')->group(function () {
        Route::get('/hide/{id}', 'FacultyController@hide')->name('hide');
        Route::get('/insert/excel', 'FacultyController@insertExcel')->name('insert-excel');
        Route::post('/insert/excel/process', 'FacultyController@insertExcelProcess')->name('insert-excel-process');
    });

    // Thao tác với môn học
    Route::resource("subject", SubjectController::class);
    Route::prefix("subject")->name('subject.')->group(function () {
        Route::get('/hide/{id}', 'SubjectController@hide')->name('hide');
        Route::get('/insert/excel', 'SubjectController@insertExcel')->name('insert-excel');
        Route::post('/insert/excel/process', 'SubjectController@insertExcelProcess')->name('insert-excel-process');
    });

    // Thao tác với phân công
    Route::resource("assign", AssignController::class);
    Route::prefix("assign")->name('assign.')->group(function () {
        Route::get('/hide/{id}', 'AssignController@hide')->name('hide');
        Route::get('/showInfo', 'AssignController@showInfo')->name('showInfo');
        Route::get('/insert/excel', 'AssignController@insertExcel')->name('insert-excel');
        Route::post('/insert/excel/process', 'AssignController@insertExcelProcess')->name('insert-excel-process');
    });
    // Thao tác với điểm danh
    Route::match(["get", "post"], '/attendance/create', ["as" => '/attendance/create', "uses" => "AttendanceController@search"]);
    Route::get("/attendance", "AttendanceController@index")->name("attendance");
    Route::post("/attendance/store", "AttendanceController@store")->name("attendance-post");
    Route::get("/attendance/show/{id}", "AttendanceController@show");
    Route::get("/attendance/edit/{id}", "AttendanceController@edit");
    Route::post("/attendance/update/{id}", "AttendanceController@update");
    Route::get("/attendance/destroy/{id}", "AttendanceController@destroy");

    // Thao tác với điểm danh chi tiết
    Route::resource("detailattendance", DetailAttendanceController::class);
    // Route::prefix("detailattendance")->name('detailattendance.')->group( function(){
    // Route::get('/hide/{id}','AssignController@hide')->name('hide');
    // });

});