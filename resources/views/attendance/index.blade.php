@extends('layout.sidebar')

<!-- Content Wrapper. Contains page content -->
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Quản lý điểm danh ngày
                            <span style="color: rgb(241, 50, 50)">
                                <?php
                                // Set the new timezone
                                date_default_timezone_set('Asia/Ho_Chi_Minh');
                                $date = date('d-m-Y');
                                echo '"' . $date . '"';
                                ?>
                            </span>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Điểm danh</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if (isset($view))
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Chọn lớp cần điểm danh</h3>
                                </div>

                                <!-- /.card-header -->
                                <form method="post" action="/attendance/create">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row margin">
                                            <div class="col-sm-12">
                                                {{-- Chức năng tìm kiếm --}}
                                                <div class="row">
                                                    <div class="col-5" style="text-align: right">
                                                        <h3>
                                                            Tên lớp + môn học:
                                                        </h3>
                                                    </div>
                                                    <div class="col-4">
                                                        <select name="idAssign" id="idAssign" class="form-control">
                                                            @foreach ($view as $view)
                                                                <option style="text-align: center"
                                                                    value="{{ $view->idAssign }}">
                                                                    {{ $view->nameClass }}
                                                                    + {{ $view->nameSubject }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                {{-- Kết thúc chức năng tìm kiếm --}}

                                                {{-- Thông báo ngày hôm nay đã điểm danh và chọn lại từ đầu --}}
                                                @if (isset($message))
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-5" style="text-align: right">
                                                            <h4>Trạng thái:</h4>
                                                        </div>
                                                        <div class="col-7">
                                                            <h4 style="color: rgb(231, 97, 35); text-align:left">
                                                                {{ $message }}</h4>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-5" style="text-align: right">
                                                            <h4>Thời gian:</h4>
                                                        </div>
                                                        <div class="col-7">
                                                            @foreach ($infoError as $item)
                                                                <h4 style="color:green"> {{ $item->created_at }}</h4>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                                {{-- Kết thúc thông báo --}}

                                                {{-- Thông báo điểm danh thành công và số liệu từ buổi điểm danh --}}
                                                @if (isset($success))
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-5" style="text-align: right">
                                                            <h4>Trạng thái điểm danh:</h4>
                                                        </div>
                                                        <div class="col-7">
                                                            <h3 style="color: rgb(32, 11, 219); text-align:left">
                                                                {{ $success }}</h3>
                                                        </div>
                                                    </div>

                                                    {{-- Số sinh viên đi học --}}
                                                    <div class="row">
                                                        <div class="col-5" style="text-align: right">
                                                            <h4>Đi học:</h4>
                                                        </div>
                                                        <div class="col-3">
                                                            @if ($countDH != 0)
                                                                @foreach ($dihoc as $item)
                                                                    <h4 style="color:green"> {{ $item->count_dihoc }} sinh
                                                                        viên</h4>
                                                                @endforeach
                                                            @else
                                                                <h4 style="color:green"> {{ $dihoc }} sinh viên</h4>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    {{-- Số sinh viên đi muộn --}}
                                                    <div class="row">
                                                        <div class="col-5" style="text-align: right">
                                                            <h4>Đi muộn:</h4>
                                                        </div>
                                                        <div class="col-3">
                                                            @if ($countDM != 0)
                                                                @foreach ($dimuon as $item)
                                                                    <h4 style="color:rgb(241, 142, 12)">
                                                                        {{ $item->count_dimuon }} sinh viên</h4>
                                                                @endforeach
                                                            @else
                                                                <h4 style="color:rgb(241, 142, 12)"> {{ $dimuon }}
                                                                    sinh viên</h4>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    {{-- Số sinh viên nghỉ học có phép --}}
                                                    <div class="row">
                                                        <div class="col-5" style="text-align: right">
                                                            <h4>Nghỉ học có phép:</h4>
                                                        </div>
                                                        <div class="col-3">
                                                            @if ($countNP != 0)
                                                                @foreach ($nghiP as $item)
                                                                    <h4 style="color:rgb(226, 27, 210)">
                                                                        {{ $item->count_nghiP }} sinh viên</h4>
                                                                @endforeach
                                                            @else
                                                                <h4 style="color:rgb(226, 27, 210)"> {{ $nghiP }}
                                                                    sinh viên</h4>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    {{-- Số sinh viên nghỉ học không phép --}}
                                                    <div class="row">
                                                        <div class="col-5" style="text-align: right">
                                                            <h4>Nghỉ học không phép:</h4>
                                                        </div>
                                                        <div class="col-3">
                                                            @if ($countNKP != 0)
                                                                @foreach ($nghiKp as $item)
                                                                    <h4 style="color:rgb(207, 13, 13)">
                                                                        {{ $item->count_nghiKp }} sinh viên</h4>
                                                                @endforeach
                                                            @else
                                                                <h4 style="color:rgb(207, 13, 13)"> {{ $nghiKp }}
                                                                    sinh viên</h4>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    {{-- Thời lượng môn học --}}

                                                    <div class="row">
                                                        <div class="col-4" style="text-align: left">
                                                            <h4>
                                                                Thời lượng môn học -
                                                                @foreach ($duration as $duration)
                                                                    {{ $duration->duration }} giờ.
                                                                @endforeach
                                                            </h4>
                                                        </div>
                                                        <div class="col-4" style="text-align: left">
                                                            @if (isset($inforAttendance) || isset($timeDone))
                                                                @foreach ($inforAttendance as $item)
                                                                    <h4>
                                                                        Thời lượng giờ đã dạy -
                                                                        {{ $timeDone }} giờ ~
                                                                        {{ $item->count_attendance }} buổi.
                                                                    </h4>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="col-4" style="text-align: left">
                                                            @if (isset($timeHave))
                                                                <h4>
                                                                    Thời lượng giờ còn lại -
                                                                    {{ $timeHave }} giờ.
                                                                </h4>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary"
                                            style="margin: auto; display: block">Điểm danh</button>
                                    </div>
                                </form>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                @endif
                <!-- /.row -->
                @if (isset($student))
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Điểm danh</h3>
                                </div>
                                <div class="card-body">
                                    {{-- test --}}
                                    <form action="{{ route('attendance-post') }}" method="post">
                                        @csrf
                                        <table id="example" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Họ tên sinh viên(Nghỉ/Tổng số buổi)</th>
                                                    <th>Tình trạng điểm danh</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($student as $student)
                                                    <tr>
                                                        <th>
                                                            @if ($countAttendance != 0)
                                                                @foreach ($results as $value)
                                                                    @foreach ($value as $result)
                                                                        {{-- nếu tỉ lệ nghỉ < 30%: bình thường, >30% <=50%: cấm thi lần 1, >50%: học lại --}}
                                                                        @if ($result->idStudent == $student->idStudent)
                                                                            @if ((($result->dimuon / 3 + $result->nghiP / 2 + $result->nghiKp) * 100) / $countAttendance < 30)
                                                                                <p style="color:blue">
                                                                                    {{ $index++ }})
                                                                                    {{ $student->idStudent }} -
                                                                                    {{ $student->lastName }}
                                                                                    {{ $student->middleName }}
                                                                                    {{ $student->firstName }}
                                                                                    ({{ number_format($result->dimuon / 3 + $result->nghiP / 2 + $result->nghiKp, 1) }}/{{ $countAttendance }})
                                                                                    <br>
                                                                                    ({{ $student->birthday }})
                                                                                </p>
                                                                            @elseif((($result->dimuon / 3 + $result->nghiP / 2 + $result->nghiKp) * 100) / $countAttendance >= 30 && (($result->dimuon / 3 + $result->nghiP / 2 + $result->nghiKp) * 100) / $countAttendance <= 50)
                                                                                <p style="color:rgb(226, 131, 23)">
                                                                                    {{ $index++ }})
                                                                                    {{ $student->idStudent }} -
                                                                                    {{ $student->lastName }}
                                                                                    {{ $student->middleName }}
                                                                                    {{ $student->firstName }}
                                                                                    ({{ number_format($result->dimuon / 3 + $result->nghiP / 2 + $result->nghiKp, 1) }}/{{ $countAttendance }})
                                                                                    <br>
                                                                                    ({{ $student->birthday }})
                                                                                </p>
                                                                            @elseif((($result->dimuon / 3 + $result->nghiP / 2 + $result->nghiKp) * 100) / $countAttendance > 50)
                                                                                <p style="color:red">
                                                                                    {{ $index++ }})
                                                                                    {{ $student->idStudent }} -
                                                                                    {{ $student->lastName }}
                                                                                    {{ $student->middleName }}
                                                                                    {{ $student->firstName }}
                                                                                    ({{ number_format($result->dimuon / 3 + $result->nghiP / 2 + $result->nghiKp, 1) }}/{{ $countAttendance }})
                                                                                    <br>
                                                                                    ({{ $student->birthday }})
                                                                                </p>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach
                                                                {{-- @endif --}}
                                                            @else
                                                                <p style="color:blue">
                                                                    {{ $index++ }}) {{ $student->idStudent }} -
                                                                    {{ $student->lastName }}
                                                                    {{ $student->middleName }}
                                                                    {{ $student->firstName }} (0/0)
                                                                    <br>
                                                                    ({{ $student->birthday }})
                                                                </p>
                                                            @endif
                                                        </th>
                                                        <th>
                                                            <b><input type="radio" id="status"
                                                                    name="{{ $student->idStudent }}" value="0" checked>
                                                                Đi
                                                                học</b> &nbsp;
                                                            <b><input type="radio" id="status"
                                                                    name="{{ $student->idStudent }}" value="1"> Nghỉ
                                                                học</b> &nbsp;
                                                            <b><input type="radio" id="status"
                                                                    name="{{ $student->idStudent }}" value="2"> Muộn</b>
                                                            &nbsp;
                                                            <b><input type="radio" id="status"
                                                                    name="{{ $student->idStudent }}" value="3"> Có
                                                                phép</b> &nbsp;
                                                        </th>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="2">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <hr style="color: rgb(131, 23, 23)">
                                                                <h4>
                                                                    Tên lớp - môn học:
                                                                </h4>
                                                                <input type="text" readonly name="idAssign" id="idAssign"
                                                                    value="{{ $assign->idAssign }}" hidden>
                                                                <select name="idAssign" id="idAssign"
                                                                    class="form-control">
                                                                    <option value="{{ $assign->idAssign }}">
                                                                        {{ $assign->nameClass }} +
                                                                        {{ $assign->nameSubject }}</option>
                                                                </select>
                                                                <br>
                                                                Thời gian bắt đầu:
                                                                <select name="start" id="start" class="form-control">
                                                                    <option value="08:00:00"
                                                                        @if ($assign->start == '08:00:00') {{ 'selected' }} @endif>
                                                                        8:00
                                                                    </option>
                                                                    <option value="10:00:00"
                                                                        @if ($assign->start == '10:00:00') {{ 'selected' }} @endif>
                                                                        10:00
                                                                    </option>
                                                                    <option value="13:30:00"
                                                                        @if ($assign->start == '13:30:00') {{ 'selected' }} @endif>
                                                                        13:30
                                                                    </option>
                                                                    <option value="15:30:00"
                                                                        @if ($assign->start == '15:30:00') {{ 'selected' }} @endif>
                                                                        15:30
                                                                    </option>
                                                                    <option value="17:30:00"
                                                                        @if ($assign->start == '17:30:00') {{ 'selected' }} @endif>
                                                                        17:30
                                                                    </option>
                                                                    <option value="19:30:00"
                                                                        @if ($assign->start == '19:30:00') {{ 'selected' }} @endif>
                                                                        19:30
                                                                    </option>
                                                                </select>
                                                                <br>
                                                                Thời gian kết thúc:
                                                                <select name="end" id="end" class="form-control">
                                                                    <option value="10:00:00"
                                                                        @if ($assign->end == '10:00:00') {{ 'selected' }} @endif>
                                                                        10:00
                                                                    </option>
                                                                    <option value="12:00:00"
                                                                        @if ($assign->end == '12:00:00') {{ 'selected' }} @endif>
                                                                        12:00
                                                                    </option>
                                                                    <option value="15:30:00"
                                                                        @if ($assign->end == '15:30:00') {{ 'selected' }} @endif>
                                                                        15:30
                                                                    </option>
                                                                    <option value="17:30:00"
                                                                        @if ($assign->end == '17:30:00') {{ 'selected' }} @endif>
                                                                        17:30
                                                                    </option>
                                                                    <option value="19:30:00"
                                                                        @if ($assign->end == '19:30:00') {{ 'selected' }} @endif>
                                                                        19:30
                                                                    </option>
                                                                    <option value="21:30:00"
                                                                        @if ($assign->end == '21:30:00') {{ 'selected' }} @endif>
                                                                        21:30
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-5">
                                                            </div>
                                                            <div class="col-sm-7">
                                                                <br>
                                                                <button type="submit" class="btn btn-success"> Cập nhật
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </form>
                                    {{-- end test --}}
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
            </div>
            @endif
            <!-- /.row -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
