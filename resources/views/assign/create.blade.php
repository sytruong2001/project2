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
                        <h1>Quản lý phân công</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Thêm phân công</li>
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
                                <h3 class="card-title">Phân công lịch dạy</h3>
                            </div>
                            @if (isset($errors))
                                <p style="color:red;">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                                </p>
                            @endif
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('assign.store') }}" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên lớp</label>
                                        <select name="idClass" id="idClass" class="form-control">
                                            @foreach ($class as $class)
                                                <option value="{{ $class->idClass }}">{{ $class->nameClass }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên môn học</label>
                                        <select name="idSubject" id="idSubject" class="form-control">
                                            @foreach ($subject as $subject)
                                                <option value="{{ $subject->idSubject }}">{{ $subject->nameSubject }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên giảng viên</label>
                                        <select name="idTeacher" id="idTeacher" class="form-control">
                                            @foreach ($teacher as $teacher)
                                                <option value="{{ $teacher->idTeacher }}">{{ $teacher->lastName }}
                                                    {{ $teacher->middleName }} {{ $teacher->firstName }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ngày bắt đầu</label>
                                        <input type="date" name="startDate" id="startDate" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ngày trong tuần </label>
                                        <select name="date" id="date" class="form-control">
                                            <option value="0">Thứ 2, 4, 6</option>
                                            <option value="1">Thứ 3, 5, 7</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        Thời gian bắt đầu:
                                        <select name="start" id="start" class="form-control">
                                            <option value="08:00:00">8:00</option>
                                            <option value="10:00:00">10:00</option>
                                            <option value="13:30:00">13:30</option>
                                            <option value="15:30:00">15:30</option>
                                            <option value="17:30:00">17:30</option>
                                            <option value="19:30:00">19:30</option>
                                        </select>
                                        <br>
                                        Thời gian kết thúc:
                                        <select name="end" id="end" class="form-control">
                                            <option value="10:00:00">10:00</option>
                                            <option value="12:00:00">12:00</option>
                                            <option value="15:30:00">15:30</option>
                                            <option value="17:30:00">17:30</option>
                                            <option value="19:30:00">19:30</option>
                                            <option value="21:30:00">21:30</option>
                                        </select>

                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary"
                                            style="margin:auto;display:block">Thêm</button>
                                    </div>
                            </form>
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
