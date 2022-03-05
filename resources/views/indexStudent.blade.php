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
                  <div class="row" style="color: red">
                    @foreach ($student as $item)
                    <div class="col-5" style="text-align: right">
                        <h4> Sinh viên: {{$item->lastName}} {{$item->middleName}} {{$item->firstName}}</h4>
                    </div>
                    <div class="col-3" style="text-align: right">
                        <h4> Lớp: {{$item->nameClass}}</h4>
                    </div>
                    @endforeach
                  </div>
                <br>
                  <form action="" >
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
                              @if ($assign->idAssign == $idAssign)
                                {{"selected"}}
                              @endif
                            >
                              {{$assign->nameClass}}--{{$assign->nameSubject}}
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
                    <th>Mã điểm danh</th>
                    <th>Tên sinh viên</th>
                    <th>Tên lớp</th>
                    <th>Tên môn học</th>
                    <th>Trạng thái</th>
                    <th>Ngày điểm danh</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if(!empty($attendance))
                    @foreach ($attendance as $attendance)
                      <tr>
                        <th>{{ $attendance->idAttendance}}</th>
                        @foreach ($student as $item)
                            <th>{{$item->lastName}} {{$item->middleName}} {{$item->firstName}}</th>
                        @endforeach
                        <th>{{ $attendance->nameClass}}</th>
                        <th>{{ $attendance->nameSubject}}</th>
                        <th>
                            @if($attendance->status == 0 )
                                <span style="color: blue">Đi học</span> 
                            @elseif($attendance->status == 1)
                                <span style="color: rgb(219, 22, 22)">Nghỉ không phép</span> 
                            @elseif($attendance->status == 2)
                                <span style="color: rgb(240, 102, 11)">Đi muộn</span> 
                            @elseif($attendance->status == 3)
                                <span style="color: rgb(9, 214, 26)">Nghỉ có phép</span> 
                            @endif    
                        </th>
                        <th>{{ $attendance->dateAttendance}}</th>
                        
                      </tr>
                    @endforeach
                    @endif
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Mã điểm danh</th>
                    <th>Tên sinh viên</th>
                    <th>Tên lớp</th>
                    <th>Tên môn học</th>
                    <th>Trạng thái</th>
                    <th>Ngày điểm danh</th>
                    
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

