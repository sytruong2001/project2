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
              <li class="breadcrumb-item"><a href="home">Home</a></li>
              <li class="breadcrumb-item active">Statistical</li>
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
                <h3 class="btn btn-default"> 
                  <form action="" >
                    Chọn lớp + môn học: 
                    <select name="idAssign" class="form-control">
                        <option value="">...............................................................</option>
                        @foreach ($assign as $assign)
                            <option value="{{ $assign->idAssign }}"
                                @if ($assign->idAssign == $idAssign)
                                {{"selected"}}
                                @endif
                                >
                                {{$assign->nameClass}}{{$assign->nameFaculty}}--{{$assign->nameSubject}}
                            </option> 
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
                    <th>STT</th>
                    <th>Tên sinh viên</th>
                    <th>Tên lớp</th>
                    <th>Tên môn học</th>
                    <th>Số ngày đi học</th>
                    <th>Số ngày nghỉ(KP)</th>
                    <th>Số ngày nghỉ(P)</th>
                    <th>Số ngày đi muộn</th>
                    <th>Tỉ lệ đi học(/{{$countAttendance}})</th>
                    <th>Trạng thái</th>
                  </tr>
                  </thead>
                  <tbody>
                  @if (isset($students))
                    @foreach ($students as $student)
                      <tr>
                        <th>{{ $index++}}</th>
                        <th>
                          {{ $student->lastName}} {{ $student->middleName}} {{ $student->firstName}}
                        </th>
                        <th>
                          {{ $student->nameClass}}
                        </th>
                        <th>
                          {{ $student->nameSubject}}
                        </th>
                        <th style="color:blue; text-align:center">
                            @foreach ($dihocs as $dihoc)
                              @if (isset($dihoc->idStudent))
                                  @if (($dihoc->idStudent) == ($student->idStudent))
                                    {{($dihoc->count_dihoc)}}
                                  @endif
                              @endif
                            @endforeach
                            
                        </th>
                        <th style="color:red; text-align:center">
                            @foreach ($nghiKps as $nghiKp)
                                @if (isset($nghiKp->idStudent))
                                    @if (($nghiKp->idStudent) == ($student->idStudent)  )
                                      {{ $nghiKp->count_nghiKp }}
                                    @endif
                                @endif
                            @endforeach
                        </th>
                        <th style="color:red; text-align:center">
                            @foreach ($nghiPs as $nghiP)
                                @if (isset($nghiP->idStudent))
                                    @if (($nghiP->idStudent) == ($student->idStudent))
                                      {{ $nghiP->count_nghiP }}
                                    @endif
                                @endif
                            @endforeach
                        </th>
                        <th style="color:rgb(212, 58, 19); text-align:center">
                            @foreach ($dimuons as $muon)
                                @if (isset($muon->idStudent))
                                    @if (($muon->idStudent) == ($student->idStudent))
                                      {{ $muon->count_dimuon }}
                                    @endif
                                @endif
                            @endforeach
                        </th>
                        <th style="text-align:center">
                            @foreach ($dihocs as $dihoc)
                              @if (isset($dihoc->idStudent))
                                  @if (($dihoc->idStudent) == ($student->idStudent))
                                    {{($dihoc->count_dihoc)}}
                                  @endif
                              @endif
                            @endforeach
                            {{"/"}}{{$countAttendance}}
                        </th>
                        <th>
                            @foreach ($dihocs as $dihoc)
                              @if (isset($student->idStudent))
                                  @if (($dihoc->idStudent) == ($student->idStudent))
                                    @if (($dihoc->count_dihoc/$countAttendance) >= 0.7)
                                      <p style="color:blue">Bình thường</p> 
                                    @elseif(($dihoc->count_dihoc/$countAttendance) < 0.7 && ($dihoc->count_dihoc/$countAttendance) >= 0.5)
                                      <p style="color:rgb(226, 131, 23)">Cấm thi lần 1</p>
                                    @elseif(($dihoc->count_dihoc/$countAttendance) < 0.3)
                                      <p style="color:red">Học lại</p>
                                    @endif
                                  @endif
                              @else
                                
                              @endif
                            @endforeach
                          
                        </th>
                      </tr>
                    @endforeach
                  @endif
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>STT</th>
                    <th>Tên sinh viên</th>
                    <th>Tên lớp</th>
                    <th>Tên môn học</th>
                    <th>Số ngày đi học</th>
                    <th>Số ngày nghỉ(KP)</th>
                    <th>Số ngày nghỉ(P)</th>
                    <th>Số ngày đi muộn</th>
                    <th>Tỉ lệ đi học(/{{$countAttendance}})</th>
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

