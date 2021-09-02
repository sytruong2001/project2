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
              <li class="breadcrumb-item"><a href="home">Home</a></li>
              <li class="breadcrumb-item active">Diary</li>
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
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>STT</th>
                    <th>Mã điểm danh</th>
                    <th>Tên sinh viên</th>
                    <th>Tên lớp</th>
                    <th>Tên môn học</th>
                    <th>Ngày điểm danh</th>
                    <th>Thời gian bắt đầu</th>
                    <th>Thời gian kết thúc</th>
                    <th>Trạng thái</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($detail as $detail)
                      <tr>
                        <th>{{ $index++}}</th>
                        <th>{{ $detail->idAttendance}}</th>
                        <th>{{ $detail->lastName}} {{ $detail->middleName}} {{ $detail->firstName}}</th>
                        <th>
                          @if (!empty($classs))
                            @foreach ($classs as $class)
                              @if ($class->idClass == $detail->idClass)
                                @foreach ($facultys as $faculty)
                                  @if ($faculty->idFaculty == $class->idFaculty)
                                      {{$class->nameClass}}{{$faculty->nameFaculty}}
                                  @endif
                                @endforeach  
                              @endif
                            @endforeach
                          @endif
                        </th>
                        <th>
                          @if (!empty($subjects))
                            @foreach ($subjects as $subject)
                              @if ($subject->idSubject == $detail->idSubject)
                                      {{$subject->nameSubject}}
                              @endif
                            @endforeach
                          @endif
                        </th>
                        <th>{{ $detail->dateAttendance}}</th>
                        <th>{{ $detail->start}}</th>
                        <th>{{ $detail->end}}</th>
                        <th>
                          @if ($detail->status == 0)
                            {{ "Đi học" }}
                          @elseif($detail->status == 1)
                            {{ "Nghỉ học"}}
                          @elseif($detail->status == 2)
                            {{ "Muộn"}}
                          @elseif($detail->status == 3)
                            {{ "Nghỉ có phép" }}
                          @endif
                        </th>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>STT</th>
                    <th>Mã điểm danh</th>
                    <th>Tên sinh viên</th>
                    <th>Tên lớp</th>
                    <th>Tên môn học</th>
                    <th>Ngày điểm danh</th>
                    <th>Thời gian bắt đầu</th>
                    <th>Thời gian kết thúc</th>
                    <th>Trạng thái</th>
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

