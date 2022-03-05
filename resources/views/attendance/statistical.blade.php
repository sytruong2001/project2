@extends('layout.sidebar')


  <!-- Content Wrapper. Contains page content -->
  @section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lý thống kê</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home">Trang chủ</a></li>
              <li class="breadcrumb-item active">Thống kê</li>
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
                <h3 class="card-title">Danh sách thống kê</h3>
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
                    <br>
                    <div class="row">
                      <div class="col-4" style="text-align: right">
                        Hoặc 
                      </div>
                    </div>
                    <br>
                    {{-- Chọn giảng viên muốn xem thông tin --}}
                    <div class="row">
                      <div class="col-4" style="text-align: right">
                        Số giờ dạy trong tháng: 
                      </div>
                    
                      <div class="col-4">
                        <select name="idTeacher" class="form-control">
                          <option style="text-align: center" value="">--------------------</option>
                          {{-- @foreach ($teacher as $teacher)
                              <option style="text-align: center" value="{{ $teacher->idTeacher}}"
                                @if ($teacher->idTeacher == $idTeacher)
                                  {{"selected"}}
                                @endif
                              >{{$teacher->lastName}} {{$teacher->middleName}} {{$teacher->firstName}}</option>
                          @endforeach --}}
                        </select>
                      </div>
                    </div>
                    <br>
                    <button class="btn btn-primary" style="margin:auto; display:block">Okkkkkkk</button>
                  </form>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>STT</th>
                    <th>Tên sinh viên</th>
                    <th>Tên lớp</th>
                    <th>Tên môn học</th>
                    <th>Số ngày đi học</th>
                    <th>Số ngày nghỉ(KP)</th>
                    <th>Số ngày nghỉ(P)</th>
                    <th>Số ngày đi muộn</th>
                    <th>Tỉ lệ nghỉ học( /
                      @if (isset($countAttendance))
                        {{$countAttendance}} 
                      @endif
                      buổi)</th>
                    <th>Trạng thái</th>
                  </tr>
                  </thead>
                  <tbody>
                  @if (isset($student))
                    @foreach ($student as $student)
                      <tr>
                        <th>{{ $index++}}</th>
                        <th>
                          {{ $student->lastName}} {{ $student->middleName}} {{ $student->firstName}}
                          <p>
                            ({{$student->birthday}})
                          </p>
                        </th>
                        <th>
                          {{ $student->nameClass}}
                        </th>
                        <th>
                          {{ $student->nameSubject}}
                        </th>
                        {{-- Lấy thông tin thống kê --}}
                          
                          <th style="color:blue; text-align:center">
                            @foreach ($results as $value)
                              @foreach ($value as $result)
                                @if (isset($result->idStudent))
                                  @if ( $result->idStudent == $student->idStudent )
                                    {{ $result->dihoc }}
                                  @endif
                                @endif
                              @endforeach
                            @endforeach
                          </th>
                          <th style="color:red; text-align:center">
                            @foreach ($results as $value)
                              @foreach ($value as $result)
                                @if (isset($result->idStudent))
                                    @if (($result->idStudent) == ($student->idStudent) )
                                        {{ $result->nghiKp }}
                                    @endif
                                @endif
                              @endforeach
                            @endforeach
                          </th>
                          <th style="color:red; text-align:center">
                            @foreach ($results as $value)
                              @foreach ($value as $result)
                                @if (isset($result->idStudent))
                                    @if (($result->idStudent) == ($student->idStudent))
                                      {{ $result->nghiP }}
                                    @endif
                                @endif
                              @endforeach
                            @endforeach
                          </th>
                          <th style="color:rgb(212, 58, 19); text-align:center">
                            @foreach ($results as $value)
                              @foreach ($value as $result)
                                @if (isset($result->idStudent))
                                    @if (($result->idStudent) == ($student->idStudent))
                                      {{ $result->dimuon }}
                                    @endif
                                @endif
                              @endforeach
                            @endforeach
                          </th>
                          
                        {{-- Kết thúc lấy thông tin --}}
                        <th style="text-align:center">
                          @foreach ($results as $value)
                            @foreach ($value as $result)
                              @if ($result->idStudent == $student->idStudent )
                                @if($result->dimuon <= 0 && $result->nghiP <= 0 && $result->nghiKp <= 0)
                                  0%
                                @else
                                {{ number_format((($result->dimuon/3 + ($result->nghiP/2) + $result->nghiKp)*100/$countAttendance),2)}}%
                                @endif
                              @endif
                            @endforeach
                          @endforeach
                        </th>
                        <th>
                          @if(isset($results))
                            @foreach ($results as $value)
                              @foreach ($value as $result)
                              {{-- nếu tỉ lệ nghỉ < 30%: bình thường, >30% <=50%: cấm thi laafn1, >50%: học lại --}}
                                @if (($result->idStudent) == ($student->idStudent))
                                  @if(( ($result->dimuon/3 + ($result->nghiP/2) + $result->nghiKp) *100/$countAttendance) < 30)
                                    <p style="color:blue">Bình thường</p>
                                  @elseif(( ($result->dimuon/3 + ($result->nghiP/2) + $result->nghiKp) *100/$countAttendance) >= 30 && ( ($result->dimuon/3 + ($result->nghiP/2) + $result->nghiKp) *100/$countAttendance) <=50)
                                    <p style="color:rgb(226, 131, 23)">Cấm thi lần 1</p>
                                  @elseif(( ($result->dimuon/3 + ($result->nghiP/2) + $result->nghiKp) *100/$countAttendance) > 50)
                                    <p style="color:red">Học lại</p>
                                  @endif 
                                @endif
                              @endforeach
                            @endforeach
                          @endif
                        </th>
                      </tr>
                    @endforeach
                      
                  @endif
                  </tbody>
                  <tfoot>
                    <tr style="text-align: center">
                      <th colspan="4" style="text-align: right">Tỉ lệ:</th>
                      <th>
                        @if(isset($totals))
                          @foreach ($totals as $value)
                            @if($value->total != 0)
                              {{ number_format( ( ($value->dihoc) / ($value->total) * 100 ) ,2 ) }}%
                            @endif
                          @endforeach
                        @endif
                      </th>
                      <th>
                        @if(isset($totals))
                          @foreach ($totals as $value)
                            @if($value->total != 0)
                              {{ number_format((($value->nghiKp) / ($value->total) * 100),2)}}%
                            @endif
                          @endforeach
                        @endif
                        
                      </th>
                      <th>
                        @if(isset($totals))
                          @foreach ($totals as $value)
                            @if($value->total != 0)
                              {{ number_format((($value->nghiP) / ($value->total) * 100),2)}}%
                            @endif
                          @endforeach
                        @endif
                        
                      </th>
                      <th>
                        @if(isset($totals))
                          @foreach ($totals as $value)
                            @if($value->total != 0)
                              {{ number_format((($value->dimuon) / ($value->total) * 100),2)}}%
                            @endif
                          @endforeach
                        @endif
                        
                      </th>
                      <th colspan="2"></th>
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

