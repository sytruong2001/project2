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
                  echo $date;
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
        @if(isset($view))
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
                                <option style="text-align: center" value="{{ $view->idAssign}}"> {{ $view->nameClass}} + {{ $view->nameSubject}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      {{-- Kết thúc chức năng tìm kiếm --}}
                      
                      {{-- Thông báo ngày hôm nay đã điểm danh và chọn lại từ đầu --}}
                        @if (isset($message))
                          <h3 style="color: rgb(231, 97, 35); text-align:center"><br>{{ $message }}</h3>
                        @endif
                      {{-- Kết thúc thông báo --}}

                      {{-- Thông báo điểm danh thành công và số liệu từ buổi điểm danh --}}
                      @if (isset($success))
                        <h3 style="color: rgb(32, 11, 219); text-align:center"><br>{{ $success }}</h3>
                        {{-- Số sinh viên đi học --}}
                        <div class="row">
                          <div class="col-5" style="text-align: right">
                            <h4>Đi học:</h4>
                          </div>
                          <div class="col-3">
                            @if ($countDH != 0)
                              @foreach ($dihoc as $item)
                                <h4 style="color:green"> {{$item->count_dihoc}} sinh viên</h4>
                              @endforeach
                            @else
                            <h4 style="color:green"> {{$dihoc}} sinh viên</h4>
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
                                <h4 style="color:rgb(241, 142, 12)"> {{$item->count_dimuon}} sinh viên</h4>
                              @endforeach
                            @else
                            <h4 style="color:rgb(241, 142, 12)"> {{$dimuon}} sinh viên</h4>
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
                                <h4 style="color:rgb(226, 27, 210)"> {{$item->count_nghiP}} sinh viên</h4>
                              @endforeach
                            @else
                            <h4 style="color:rgb(226, 27, 210)"> {{$nghiP}} sinh viên</h4>
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
                                <h4 style="color:rgb(207, 13, 13)"> {{$item->count_nghiKp}} sinh viên</h4>
                              @endforeach
                            @else
                            <h4 style="color:rgb(207, 13, 13)"> {{$nghiKp}} sinh viên</h4>
                            @endif
                          </div>
                        </div>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" style="margin: auto; display: block">Điểm danh</button>
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
        @if(isset($student))
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Điểm danh</h3>
              </div>
                <div class="card-body">
                  {{-- test  --}}
                  <form action="{{ route('attendance-post') }}" method="post" >
                    @csrf
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Họ tên sinh viên</th>
                      <th>Tình trạng điểm danh</th>
                    </tr>
                    </thead>
                    <tbody>
                      
                        @foreach( $student as $student)
                        <tr>
                          <th>
                                {{ $index++}})  {{ $student->idStudent}} - {{ $student->lastName}} {{ $student->middleName}} {{ $student->firstName}}
                                <br>
                                ({{ $student->birthday}})
                          </th>
                          <th>
                              <b><input type="radio" id="status" name="{{ $student->idStudent}}" value="0" checked> Đi học</b> &nbsp;
                              <b><input type="radio" id="status" name="{{ $student->idStudent}}" value="1"> Nghỉ học</b> &nbsp;
                              <b><input type="radio" id="status" name="{{ $student->idStudent}}" value="2"> Muộn</b> &nbsp;
                              <b><input type="radio" id="status" name="{{ $student->idStudent}}" value="3"> Có phép</b> &nbsp;
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
                            <input type="text" readonly name="idAssign" id="idAssign" value="{{ $assign->idAssign}}" hidden>
                            <select name="idAssign" id="idAssign" class="form-control">
                              <option value="{{ $assign->idAssign}}">{{ $assign->nameClass}} + {{ $assign->nameSubject}}</option>
                            </select>
                            <br>
                            Thời gian bắt đầu:
                            <select name="start" id="start" class="form-control">
                              <option value="08:00:00">8:00</option>
                              <option value="10:00:00">10:00</option>
                              <option value="13:30:00">13:30</option>
                              <option value="15:30:00">15:30</option>
                            </select>
                            <br>
                            Thời gian kết thúc:
                            <select name="end" id="end" class="form-control">
                              <option value="10:00:00">10:00</option>
                              <option value="12:00:00">12:00</option>
                              <option value="15:30:00">15:30</option>
                              <option value="17:30:00">17:30</option>
                            </select>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-5">
                          </div>
                          <div class="col-sm-7"> 
                            <br>
                            <button type="submit" class="btn btn-success"> Cập nhật </button>
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
