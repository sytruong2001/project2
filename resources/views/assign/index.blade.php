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
                <div class="row">
                  <div class="col-sm-10">
                    <h3 class="card-title">Danh sách phân công</h3>
                  </div>
                  <div class="col-sm-2"> 
                    <h3 class="btn btn-success">
                      <a href="{{ route('assign.create')}}">
                        Thêm mới
                      </a>
                    </h3>
                    <h3 class="btn btn-warning">
                      <a href="{{ route('assign.insert-excel')}}">
                        Thêm bằng excel
                      </a>
                    </h3>
                  </div>
                </div>
                <h3 class="btn btn-default"> 
                  <form action="" >
                    Chọn lớp: 
                    <select name="idClass" class="form-control">
                      <option value="">.................................</option>
                      @foreach ($class as $class)
                          <option value="{{$class->idClass}}"
                            @if ($class->idClass == $idClass)
                              {{"selected"}}
                            @endif
                          >{{$class->nameClass}}{{$class->nameFaculty}}</option>
                      @endforeach
                    </select>
                    <button class="btn btn-default">Okkkkkkk</button>
                  </form>
                </h3>
                <h3 class="btn btn-default">
                  
                  <form action="" >
                    Chọn giảng viên: 
                    <select name="idTeacher" class="form-control">
                      <option value="">.................................</option>
                      @foreach ($teacher as $teacher)
                          <option value="{{ $teacher->idTeacher}}"
                            @if ($teacher->idTeacher == $idTeacher)
                              {{"selected"}}
                            @endif
                          >{{$teacher->lastName}} {{$teacher->middleName}} {{$teacher->firstName}}</option>
                      @endforeach
                    </select>
                    <button class="btn btn-default">Okkkkkkk</button>
                  </form>
                </h3>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Mã số</th>
                    <th>Tên lớp</th>
                    <th>Tên khóa</th>
                    <th>Tên môn học</th>
                    <th>Tên giảng viên</th>
                    <th>Thời gian bắt đầu</th>
                    <th>Thời lượng học</th>
                    <th>Tình trạng dạy</th>
                    <th>Sửa</th>
                    <th>Ẩn</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $assign)
                      <tr>
                        <th>{{ $assign->idAssign}}</th>
                        <th>{{ $assign->nameClass}}</th>
                        <th>{{ $assign->nameFaculty}}</th>
                        <th>{{ $assign->nameSubject}}</th>
                        <th>{{ $assign->lastName}} {{ $assign->middleName}} {{ $assign->firstName}}</th>
                        <th>{{ $assign->start_date }}</th>
                        <th>{{ $assign->duration }}</th>
                        <th>
                          @foreach ($timeStarts as $start)
                            @foreach ($timeEnds as $end)
                              @if ($assign->idClass == $start->idClass && $assign->idClass == $end->idClass && $assign->idSubject == $start->idSubject && $assign->idSubject == $end->idSubject)
                                @if ((($end->sum_end - $start->sum_start) / 10000) > 0 && (($end->sum_end - $start->sum_start) / 10000) < $assign->duration)
                                  <p style="color:blue">Đang dạy (Hoàn thành {{ ($end->sum_end - $start->sum_start) / 10000}} giờ)</p> 
                                @elseif((($end->sum_end - $start->sum_start) / 10000) == $assign->duration)
                                  <p style="color:green">Đã hoàn thành</p> 
                                @else
                                  <p style="color: rgb(248, 107, 14)">Chưa dạy</p>
                                @endif
                              @endif
                            @endforeach
                          @endforeach
                        </th>
                        <th><a href="{{ route('assign.edit',$assign->idAssign)}}" class="btn btn-warning">Edit</a></th>
                        <th><a href="{{ route('assign.hide', $assign->idAssign)}}" class="btn btn-danger">Hide</a></th>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Mã số</th>
                    <th>Tên lớp</th>
                    <th>Tên khóa</th>
                    <th>Tên môn học</th>
                    <th>Tên giảng viên</th>
                    <th>Thời gian bắt đầu</th>
                    <th>Thời lượng học</th>
                    <th>Tình trạng dạy</th>
                    <th>Sửa</th>
                    <th>Ẩn</th>
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

