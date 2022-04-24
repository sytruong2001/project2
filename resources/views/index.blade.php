@extends('layout.sidebar')

<!-- Content Wrapper. Contains page content -->
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Trang chủ</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h1>
                                    @if ($class != null)
                                        {{ $class }}
                                    @endif
                                </h1>

                                <h3>Lớp Học</h3>
                            </div>
                            <div class="icon">

                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('class.index') }}" class="small-box-footer">Xem thêm <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h1>
                                    @if ($student != null)
                                        {{ $student }}
                                    @endif
                                </h1>

                                <h3>Sinh Viên</h3>
                            </div>
                            <div class="icon">

                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ route('student.index') }}" class="small-box-footer">Xem thêm <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h1>
                                    @if ($teacher != null)
                                        {{ $teacher }}
                                    @endif
                                </h1>

                                <h3>Giảng Viên</h3>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ route('teacher.index') }}" class="small-box-footer">Xem thêm <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h1>
                                    @if ($faculty != null)
                                        {{ $faculty }}
                                    @endif
                                </h1>

                                <h3>Niên Khóa</h3>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ route('faculty.index') }}" class="small-box-footer">Xem thêm <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h1>
                                    @if ($major != null)
                                        {{ $major }}
                                    @endif
                                </h1>

                                <h3>Ngành học</h3>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ route('major.index') }}" class="small-box-footer">Xem thêm <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h1>
                                    @if ($subject != null)
                                        {{ $subject }}
                                    @endif
                                </h1>

                                <h3>Môn học</h3>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ route('subject.index') }}" class="small-box-footer">Xem thêm <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h1>
                                    @if ($assign != null)
                                        {{ $assign }}
                                    @endif
                                </h1>

                                <h3>Phân công</h3>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ route('assign.index') }}" class="small-box-footer">Xem thêm <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@stop()
