@extends('layout.sidebar')


<!-- Content Wrapper. Contains page content -->
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Quản lý bảng phân công dạy</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Phân công</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                @if (session('success'))
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">{{ session('success') }}</h3>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-sm-10">
                                        <h3 class="card-title">Danh sách phân công</h3>
                                    </div>
                                    <div class="col-sm-2">
                                        <h3 class="btn btn-success">
                                            <a href="{{ route('assign.create') }}">
                                                Thêm mới
                                            </a>
                                        </h3>
                                        <h3 class="btn btn-warning">
                                            <a href="{{ route('assign.insert-excel') }}">
                                                Thêm bằng excel
                                            </a>
                                        </h3>
                                    </div>
                                </div>
                                {{-- Phần chức năng tìm kiếm --}}
                                <form action="">
                                    {{-- Chọn lớp muốn xem thông tin --}}
                                    <div class="row">
                                        <div class="col-3" style="text-align: right">
                                            Chọn lớp:
                                        </div>

                                        <div class="col-6">
                                            <select name="idClass" class="form-control">
                                                <option style="text-align: center" value="">--------------------</option>
                                                @foreach ($class as $class)
                                                    <option style="text-align: center" value="{{ $class->idClass }}"
                                                        @if ($class->idClass == $idClass) {{ 'selected' }} @endif>
                                                        {{ $class->nameClass }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-3" style="text-align: right">
                                            Hoặc
                                        </div>
                                    </div>
                                    <br>
                                    {{-- Chọn giảng viên muốn xem thông tin --}}
                                    <div class="row">
                                        <div class="col-3" style="text-align: right">
                                            Chọn giảng viên:
                                        </div>

                                        <div class="col-6">
                                            <select name="idTeacher" class="form-control">
                                                <option style="text-align: center" value="">--------------------</option>
                                                @foreach ($teacher as $teacher)
                                                    <option style="text-align: center" value="{{ $teacher->idTeacher }}"
                                                        @if ($teacher->idTeacher == $idTeacher) {{ 'selected' }} @endif>
                                                        {{ $teacher->lastName }} {{ $teacher->middleName }}
                                                        {{ $teacher->firstName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    {{-- Chọn giảng viên muốn xem thông tin --}}
                                    <div class="row">
                                        <div class="col-3" style="text-align: right">
                                            Chức năng khác:
                                        </div>

                                        <div class="col-6">
                                            <select name="date" class="form-control">
                                                <option style="text-align: center" value="">--------------------</option>
                                                <option style="text-align: center" value="<?php
// Set the new timezone
date_default_timezone_set('Asia/Ho_Chi_Minh');
$date = date('y-m-d');
echo "$date";
?>">
                                                    Buổi học hôm nay
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <button class="btn btn-primary" style="margin:auto; display:block">Okkkkkkk</button>
                                </form>
                                <br>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr style="text-align: center">
                                            <th>Mã số</th>
                                            <th>Tên lớp</th>
                                            <th>Tên khóa</th>
                                            <th>Tên môn học</th>
                                            <th>Tên giảng viên</th>
                                            <th>Thời gian bắt đầu</th>
                                            <th>Giờ bắt đầu</th>
                                            <th>Giờ kết thúc</th>
                                            <th>Ngày trong tuần</th>
                                            <th>Thời lượng học</th>
                                            <th>Tình trạng dạy</th>
                                            @if (!isset($attendance))
                                                <th>Sửa</th>
                                                <th>Hoàn thành</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $assign)
                                            <tr>
                                                <th style="text-align: center">{{ $assign->idAssign }}</th>
                                                <th style="text-align: center">{{ $assign->nameClass }}</th>
                                                <th style="text-align: center">{{ $assign->nameFaculty }}</th>
                                                <th style="text-align: center">{{ $assign->nameSubject }}</th>
                                                <th style="text-align: center">{{ $assign->lastName }}
                                                    {{ $assign->middleName }} {{ $assign->firstName }}</th>
                                                <th style="text-align: center">{{ $assign->start_date }}</th>
                                                <th style="text-align: center">{{ $assign->start }}</th>
                                                <th style="text-align: center">{{ $assign->end }}</th>
                                                <th style="text-align: center">
                                                    @if ($assign->date == 0)
                                                        T2, 4, 6
                                                    @elseif($assign->date == 1)
                                                        T3, 5, 7
                                                    @endif
                                                </th>
                                                <th style="text-align: center">{{ $assign->duration }}</th>
                                                <th style="text-align: center">
                                                    @if ($assign->assAvai == 0)
                                                        Đã hoàn thành
                                                    @else
                                                        @if (isset($attendance))
                                                            @foreach ($attendance as $value)
                                                                @foreach ($value as $item)
                                                                    @if ($item->idAssign == $assign->idAssign)
                                                                        <p style="color:blue">Đã điểm danh</p>
                                                                    @endif
                                                                @endforeach
                                                            @endforeach
                                                        @else
                                                            @foreach ($timeStarts as $start)
                                                                @foreach ($timeEnds as $end)
                                                                    @if ($assign->idAssign == $start->idAssign && $assign->idAssign == $end->idAssign)
                                                                        @if (($end->sum_end - $start->sum_start) / 10000 > 0 && ($end->sum_end - $start->sum_start) / 10000 < $assign->duration)
                                                                            <p style="color:blue">Đang dạy (Hoàn thành
                                                                                {{ ($end->sum_end - $start->sum_start) / 10000 }}
                                                                                giờ)</p>
                                                                        @elseif(($end->sum_end - $start->sum_start) / 10000 == $assign->duration)
                                                                            <p style="color:green">Đã hoàn thành</p>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                </th>
                                                @if (!isset($attendance))
                                                    <th style="text-align: center"><a
                                                            href="{{ route('assign.edit', $assign->idAssign) }}"
                                                            class="btn btn-warning">Sửa</a></th>
                                                    @if ($assign->assAvai == 0)
                                                        <th style="text-align: center"><a
                                                                href="{{ route('assign.hide', $assign->idAssign) }}"
                                                                class="btn btn-success">Dạy tiếp</a></th>
                                                    @else
                                                        <th style="text-align: center"><a
                                                                href="{{ route('assign.hide', $assign->idAssign) }}"
                                                                class="btn btn-danger">Hoàn thành</a></th>
                                                    @endif
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr style="text-align: center">
                                            <th>Mã số</th>
                                            <th>Tên lớp</th>
                                            <th>Tên khóa</th>
                                            <th>Tên môn học</th>
                                            <th>Tên giảng viên</th>
                                            <th>Thời gian bắt đầu</th>
                                            <th>Giờ bắt đầu</th>
                                            <th>Giờ kết thúc</th>
                                            <th>Ngày trong tuần</th>
                                            <th>Thời lượng học</th>
                                            <th>Tình trạng dạy</th>
                                            @if (!isset($attendance))
                                                <th>Sửa</th>
                                                <th>Hoàn thành</th>
                                            @endif
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
