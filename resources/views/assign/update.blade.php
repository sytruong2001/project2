@extends('layout.sidebar')

<!-- Content Wrapper. Contains page content -->
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @if (session('alert'))
            <section class='alert alert-success'>{{ session('alert') }}</section>
        @endif
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Quản lý lớp học</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Cập nhật phân công</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Hãy điền thông tin đầy đủ theo mẫu:</h3>
                            </div>
                            @if (isset($message))
                                <p style="color:rgb(255, 81, 0);">
                                    {{ $mes }}
                                </p>
                            @endif
                            <!-- /.card-header -->
                            <!-- form start -->
                            @foreach ($assign as $assign)
                                <form action="{{ route('assign.update', $assign->idAssign) }}" method="post">
                                    @method("put")
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="id" value="{{ $assign->idAssign }}">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tên lớp học</label>
                                            <select name="idClass" id="idClass" class="form-control">
                                                @foreach ($class as $class)
                                                    <option value="{{ $class->idClass }}"
                                                        @if ($class->idClass == $assign->idClass) {{ 'selected' }} @endif>
                                                        {{ $class->nameClass }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tên môn học</label>
                                            <select name="idSubject" id="idSubject" class="form-control">
                                                @foreach ($subject as $subject)
                                                    <option value="{{ $subject->idSubject }}"
                                                        @if ($subject->idSubject == $assign->idSubject) {{ 'selected' }} @endif>
                                                        {{ $subject->nameSubject }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tên giảng viên </label>
                                            <select name="idTeacher" id="idTeacher" class="form-control">
                                                @foreach ($teacher as $teacher)
                                                    <option value="{{ $teacher->idTeacher }}"
                                                        @if ($teacher->idTeacher == $assign->idTeacher) {{ 'selected' }} @endif>
                                                        {{ $teacher->lastName }} {{ $teacher->middleName }}
                                                        {{ $teacher->firstName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Ngày bắt đầu </label>
                                            <input type="date" name="startDate" id="startDate" class="form-control"
                                                value="{{ $assign->start_date }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Ngày trong tuần </label>
                                            <select name="date" id="date" class="form-control">
                                                <option value="0"
                                                    @if ($assign->date == 0) {{ 'selected' }} @endif>Thứ 2, 4,
                                                    6</option>
                                                <option value="1"
                                                    @if ($assign->date == 1) {{ 'selected' }} @endif>Thứ 3, 5,
                                                    7, CN</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            Thời gian bắt đầu:
                                            <select name="start" id="start" class="form-control">
                                                <option value="08:00:00"
                                                    @if ($assign->start == '08:00:00') {{ 'selected' }} @endif>8:00
                                                </option>
                                                <option value="10:00:00"
                                                    @if ($assign->start == '10:00:00') {{ 'selected' }} @endif>10:00
                                                </option>
                                                <option value="13:30:00"
                                                    @if ($assign->start == '13:30:00') {{ 'selected' }} @endif>13:30
                                                </option>
                                                <option value="15:30:00"
                                                    @if ($assign->start == '15:30:00') {{ 'selected' }} @endif>15:30
                                                </option>
                                                <option value="17:30:00"
                                                    @if ($assign->start == '17:30:00') {{ 'selected' }} @endif>17:30
                                                </option>
                                                <option value="19:30:00"
                                                    @if ($assign->start == '19:30:00') {{ 'selected' }} @endif>19:30
                                                </option>
                                            </select>
                                            <br>
                                            Thời gian kết thúc:
                                            <select name="end" id="end" class="form-control">
                                                <option value="10:00:00"
                                                    @if ($assign->end == '10:00:00') {{ 'selected' }} @endif>10:00
                                                </option>
                                                <option value="12:00:00"
                                                    @if ($assign->end == '12:00:00') {{ 'selected' }} @endif>12:00
                                                </option>
                                                <option value="15:30:00"
                                                    @if ($assign->end == '15:30:00') {{ 'selected' }} @endif>15:30
                                                </option>
                                                <option value="17:30:00"
                                                    @if ($assign->end == '17:30:00') {{ 'selected' }} @endif>17:30
                                                </option>
                                                <option value="19:30:00"
                                                    @if ($assign->end == '19:30:00') {{ 'selected' }} @endif>19:30
                                                </option>
                                                <option value="21:30:00"
                                                    @if ($assign->end == '21:30:00') {{ 'selected' }} @endif>21:30
                                                </option>
                                            </select>

                                        </div>
                                    </div>

                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary" style="margin:auto;display:block">Cập
                                            nhật</button>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
