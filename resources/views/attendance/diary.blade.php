@extends('layout.sidebar')


<!-- Content Wrapper. Contains page content -->
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Quản lý nhật ký điểm danh</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Nhật ký điểm danh</li>
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
                                <h3 class="card-title">Danh sách điểm danh</h3>
                                <br>
                                <form action="">
                                    {{-- Chọn những phân công muốn xem --}}
                                    <div class="row">
                                        <div class="col-4" style="text-align: right">
                                            Chọn lớp + môn học:
                                        </div>

                                        <div class="col-4">
                                            <select name="idAssign" class="form-control">
                                                <option style="text-align: center" value="">--------------------</option>
                                                @foreach ($assign as $assign)
                                                    <option style="text-align: center" value="{{ $assign->idAssign }}"
                                                        @if ($assign->idAssign == $idAssign) {{ 'selected' }} @endif>
                                                        {{ $assign->nameClass }}--{{ $assign->nameSubject }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <br><br>
                                    </div>
                                    <button class="btn btn-primary" style="margin:auto; display:block">Okkkkkkk</button>
                                </form>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Buổi</th>
                                            <th>Mã điểm danh</th>
                                            <th>Tên lớp</th>
                                            <th>Tên môn học</th>
                                            <th>Ngày điểm danh</th>
                                            <th>Thời gian bắt đầu</th>
                                            <th>Thời gian kết thúc</th>
                                            <th>Thời gian điểm danh</th>
                                            <th>Cập nhật</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($attendance as $attendance)
                                            <tr>
                                                <th>{{ $index++ }}</th>
                                                <th>{{ $attendance->idAttendance }}</th>
                                                <th>{{ $attendance->nameClass }}</th>
                                                <th>{{ $attendance->nameSubject }}</th>
                                                <th>{{ $attendance->dateAttendance }}</th>
                                                <th>{{ $attendance->start }}</th>
                                                <th>{{ $attendance->end }}</th>
                                                <th>{{ $attendance->created_at }}</th>
                                                {{-- <th><a href="{{ route('detailattendance.show', $attendance->idAttendance) }}" class="btn btn-success">Detail</a></th> --}}
                                                <th><a href="{{ route('detailattendance.edit', $attendance->idAttendance) }}"
                                                        class="btn btn-warning">Edit</a></th>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Buổi</th>
                                            <th>Mã điểm danh</th>
                                            <th>Tên lớp</th>
                                            <th>Tên môn học</th>
                                            <th>Ngày điểm danh</th>
                                            <th>Thời gian bắt đầu</th>
                                            <th>Thời gian kết thúc</th>
                                            <th>Thời gian điểm danh</th>
                                            <th>Cập nhật</th>
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
