@extends('layout.sidebar')

  <!-- Content Wrapper. Contains page content -->
  @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lý điểm danh</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home">Home</a></li>
              <li class="breadcrumb-item active">Attendance</li>
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
                      @if (isset($message))
                        <h3 style="color: rgb(231, 97, 35); text-align:center"><br>{{ $message }}</h3>
                      @endif
                      @if (isset($success))
                        <h3 style="color: rgb(32, 11, 219); text-align:center"><br>{{ $success }}</h3>
                      @endif
                      <h3>Tên lớp + môn học:</h3>
                      <select name="idAssign" id="idAssign" class="form-control">
                          @foreach ($view as $view)
                              <option value="{{ $view->idAssign}}"> {{ $view->nameClass}}{{ $view->nameFaculty}} + {{ $view->nameSubject}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Điểm danh</button>
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

                  <div class="row" style="color: rgb(10, 2, 29)">
                    <div class="col-sm-4">
                      <!-- radio -->
                      <div class="form-group">
                          <h4>Họ tên sinh viên</h4>
                      </div>
                    </div>
                    <div class="col-sm-8">
                      <!-- radio -->
                      <div class="form-group"> 
                          <h4>Tình trạng điểm danh</h4>
                      </div>
                    </div>
                  </div>

                      @foreach( $student as $student)
                    <form action="{{ route('attendance-post') }}" method="post" >
                      @csrf
                      <div class="row">
                        <div class="col-sm-4">
                          <!-- radio -->
                          <div class="form-group">
                            {{ $index++}})  {{ $student->idStudent}} - {{ $student->lastName}} {{ $student->middleName}} {{ $student->firstName}}
                            <br>
                            ({{ $student->birthday}})
                          </div>
                        </div>
                        <div class="col-sm-8">
                          <!-- radio -->
                          <div class="form-group">
                            <div>
                              <b><input type="radio" id="status" name="{{ $student->idStudent}}" value="0" checked>Đi học</b> &nbsp;
                              <b><input type="radio" id="status" name="{{ $student->idStudent}}" value="1">Nghỉ học</b> &nbsp;
                              <b><input type="radio" id="status" name="{{ $student->idStudent}}" value="2">Muộn</b> &nbsp;
                              <b><input type="radio" id="status" name="{{ $student->idStudent}}" value="3">Có phép</b> &nbsp;
                              <b><input type="radio" id="status" name="{{ $student->idStudent}}" value="4">Không phép</b> &nbsp;
                            </div>                       
                          </div>
                        </div>
                      </div>
                      @endforeach
                      <div class="row">
                        <div class="col-sm-12">
                          <h4>
                            Tên lớp - môn học:
                          </h4>
                          <input type="text" readonly name="idAssign" id="idAssign" value="{{ $assign->idAssign}}" hidden>
                          <select name="idAssign" id="idAssign" class="form-control">
                            <option value="{{ $assign->idAssign}}">{{ $assign->nameClass}}{{ $assign->nameFaculty}} + {{ $assign->nameSubject}}</option>
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
                    </form>

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
