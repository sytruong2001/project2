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
                    @if (isset($countAttendance))
                    <th>Tỉ lệ nghỉ học( /{{$countAttendance}} buổi)</th>
                    @endif
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
                          {{ $student->nameClass}}{{$student->nameFaculty}}
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
                            @foreach ($dimuons as $muon)
                              @foreach ($nghiKps as $nghiKp)
                                @foreach ($nghiPs as $nghiP)
                                  {{-- @if (isset($dihoc->idStudent) || isset($muon->idStudent) || isset($nghiP->idStudent) || isset($nghiKp->idStudent)) --}}
                                      @if ($dihoc->idStudent == $student->idStudent && $muon->idStudent == $student->idStudent && ($nghiP->idStudent) == ($student->idStudent) && ($nghiKp->idStudent) == ($student->idStudent))
                                        {{(($muon->count_dimuon/3 + ($nghiP->count_nghiP/2) + $nghiKp->count_nghiKp)*100/$countAttendance)}}%
                                      @elseif($dihoc->idStudent == $student->idStudent && $muon->idStudent == $student->idStudent && ($nghiP->idStudent) == ($student->idStudent))
                                        {{(($muon->count_dimuon/3 + ($nghiP->count_nghiP/2))*100/$countAttendance)}}%
                                      @elseif($dihoc->idStudent == $student->idStudent && ($nghiP->idStudent) == ($student->idStudent) && ($nghiKp->idStudent) == ($student->idStudent))
                                        {{((($nghiP->count_nghiP/2) + $nghiKp->count_nghiKp)*100/$countAttendance)}}%
                                      @elseif($dihoc->idStudent == $student->idStudent && $muon->idStudent == $student->idStudent && ($nghiKp->idStudent) == ($student->idStudent))
                                        {{(($muon->count_dimuon/3 + $nghiKp->count_nghiKp)*100/$countAttendance)}}%
                                      @elseif($dihoc->idStudent == $student->idStudent && $muon->idStudent == $student->idStudent)
                                        {{(($muon->count_dimuon/3)*100/$countAttendance)}}%
                                      @elseif($dihoc->idStudent == $student->idStudent && ($nghiP->idStudent) == ($student->idStudent))
                                        {{((($nghiP->count_nghiP/2))*100/$countAttendance)}}%
                                      @elseif($dihoc->idStudent == $student->idStudent && ($nghiKp->idStudent) == ($student->idStudent))
                                        {{(($nghiKp->count_nghiKp)*100/$countAttendance)}}%
                                      @elseif($muon->idStudent == $student->idStudent && ($nghiKp->idStudent) == ($student->idStudent))
                                        {{(($muon->count_dimuon/3 + $nghiKp->count_nghiKp)*100/$countAttendance)}}%
                                      @elseif($muon->idStudent == $student->idStudent && ($nghiP->idStudent) == ($student->idStudent))
                                        {{(($muon->count_dimuon/3 + $nghiP->count_nghiP/2)*100/$countAttendance)}}%
                                      @elseif($nghiKp->idStudent == $student->idStudent && ($nghiP->idStudent) == ($student->idStudent))
                                        {{(($nghiKp->count_nghiKp + $nghiP->count_nghiP/2)*100/$countAttendance)}}%
                                      @elseif($dihoc->idStudent == $student->idStudent)
                                        0%
                                      @endif
                                  {{-- @endif --}}
                                @endforeach
                              @endforeach
                            @endforeach
                          @endforeach
                        </th>
                        <th>
                          @foreach ($dihocs as $dihoc)
                            @foreach ($dimuons as $muon)
                              @foreach ($nghiKps as $nghiKp)
                                @foreach ($nghiPs as $nghiP)
                                  {{-- Đi học + muộn + nghỉ phép + nghỉ không phép --}}
                                  @if (($dihoc->idStudent) == ($student->idStudent) && ($muon->idStudent) == ($student->idStudent) && ($nghiP->idStudent) == ($student->idStudent) && ($nghiKp->idStudent) == ($student->idStudent))
                                    @if(( ($muon->count_dimuon/3 + ($nghiP->count_nghiP/2) + $nghiKp->count_nghiKp) *100/$countAttendance) < 30)
                                      <p style="color:blue">Bình thường</p>
                                    @elseif(( ($muon->count_dimuon/3 + ($nghiP->count_nghiP/2) + $nghiKp->count_nghiKp) *100/$countAttendance) >= 30 && ( ($muon->count_dimuon/3 + ($nghiP->count_nghiP/2) + $nghiKp->count_nghiKp) *100/$countAttendance) <=50)
                                      <p style="color:rgb(226, 131, 23)">Cấm thi lần 1</p>
                                    @elseif(( ($muon->count_dimuon/3 + ($nghiP->count_nghiP/2) + $nghiKp->count_nghiKp) *100/$countAttendance) > 50)
                                      <p style="color:red">Học lại</p>
                                    @endif
                                  {{-- Đi học + muộn + nghỉ phép --}}
                                  @elseif (($dihoc->idStudent) == ($student->idStudent) && ($muon->idStudent) == ($student->idStudent) && ($nghiP->idStudent) == ($student->idStudent))
                                    @if( (($muon->count_dimuon/3 + ($nghiP->count_nghiP/2)) *100/$countAttendance) < 30)
                                      <p style="color:blue">Bình thường</p>
                                    @elseif( (($muon->count_dimuon/3 + ($nghiP->count_nghiP/2)) *100/$countAttendance) >= 30 && ( ($muon->count_dimuon/3 + ($nghiP->count_nghiP/2)) *100/$countAttendance) <= 50)
                                      <p style="color:rgb(226, 131, 23)">Cấm thi lần 1</p>
                                    @elseif(( ($muon->count_dimuon/3 + ($nghiP->count_nghiP/2)) *100/$countAttendance) > 50)
                                      <p style="color:red">Học lại</p> 
                                    @endif
                                  {{-- Đi hoc + muộn --}}
                                  @elseif (($dihoc->idStudent) == ($student->idStudent) && ($muon->idStudent) == ($student->idStudent))
                                    @if(( ($muon->count_dimuon/3) *100/$countAttendance) < 30)
                                      <p style="color:blue">Bình thường</p>
                                    @elseif(( ($muon->count_dimuon/3) *100/$countAttendance) >= 30 && ( ($muon->count_dimuon/3) *100/$countAttendance) <=50)
                                      <p style="color:rgb(226, 131, 23)">Cấm thi lần 1</p>
                                    @elseif(( ($muon->count_dimuon/3) *100/$countAttendance) > 50)
                                      <p style="color:red">Học lại</p> 
                                    @endif

                                  {{-- Đi hoc + nghi phép --}}
                                  @elseif (($dihoc->idStudent) == ($student->idStudent) && ($nghiP->idStudent) == ($student->idStudent))
                                    @if(( (($nghiP->count_nghiP/2)) *100/$countAttendance) < 30)
                                      <p style="color:blue">Bình thường</p>
                                    @elseif(( (($nghiP->count_nghiP/2)) *100/$countAttendance) >= 30 && ( (($nghiP->count_nghiP/2)) *100/$countAttendance) <=50)
                                      <p style="color:rgb(226, 131, 23)">Cấm thi lần 1</p>
                                    @elseif(( (($nghiP->count_nghiP/2)) *100/$countAttendance) > 50)
                                      <p style="color:red">Học lại</p> 
                                    @endif

                                  {{-- Đi học + nghỉ không phép --}}
                                  @elseif (($dihoc->idStudent) == ($student->idStudent)  && ($nghiKp->idStudent) == ($student->idStudent))
                                    @if(( ($nghiKp->count_nghiKp) *100/$countAttendance) < 30)
                                      <p style="color:blue">Bình thường</p>
                                    @elseif(( ($nghiKp->count_nghiKp) *100/$countAttendance) >= 30 && ( ($nghiKp->count_nghiKp) *100/$countAttendance) <= 50)
                                      <p style="color:rgb(226, 131, 23)">Cấm thi lần 1</p>
                                    @elseif(( ($nghiKp->count_nghiKp) *100/$countAttendance) > 50)
                                      <p style="color:red">Học lại</p> 
                                    @endif

                                  {{-- Đi học + muộn + nghỉ không phép --}}
                                  @elseif (($dihoc->idStudent) == ($student->idStudent) && ($muon->idStudent) == ($student->idStudent) && ($nghiKp->idStudent) == ($student->idStudent))
                                    @if(( ($muon->count_dimuon/3 + $nghiKp->count_nghiKp) *100/$countAttendance) < 30)
                                      <p style="color:blue">Bình thường</p>
                                    @elseif(( ($muon->count_dimuon/3 + $nghiKp->count_nghiKp) *100/$countAttendance) >= 30 && ( ($muon->count_dimuon/3 + $nghiKp->count_nghiKp) *100/$countAttendance) <= 50)
                                      <p style="color:rgb(226, 131, 23)">Cấm thi lần 1</p>
                                    @elseif(( ($muon->count_dimuon/3 + $nghiKp->count_nghiKp) *100/$countAttendance) > 50)
                                      <p style="color:red">Học lại</p>
                                    @endif

                                  {{-- Đi học + nghỉ phép + nghỉ không phép--}}
                                  @elseif (($dihoc->idStudent) == ($student->idStudent) && ($nghiP->idStudent) == ($student->idStudent) && ($nghiKp->idStudent) == ($student->idStudent))
                                    @if(( (($nghiP->count_nghiP/2) + $nghiKp->count_nghiKp) *100/$countAttendance) < 30)
                                      <p style="color:blue">Bình thường</p>
                                    @elseif(( (($nghiP->count_nghiP/2) + $nghiKp->count_nghiKp) *100/$countAttendance) >= 30 && ( (($nghiP->count_nghiP/2) + $nghiKp->count_nghiKp) *100/$countAttendance) <= 50)
                                      <p style="color:rgb(226, 131, 23)">Cấm thi lần 1</p>
                                    @elseif(( (($nghiP->count_nghiP/2) + $nghiKp->count_nghiKp) *100/$countAttendance) > 50)
                                      <p style="color:red">Học lại</p> 
                                    @endif

                                  {{-- Đi học --}}
                                  @elseif (($dihoc->idStudent) == ($student->idStudent))
                                    <p style="color:blue">Bình thường</p>
                                  @endif
                                @endforeach
                              @endforeach
                            @endforeach
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
                    @if (isset($countAttendance))
                    <th>Tỉ lệ nghỉ học( /{{$countAttendance}} buổi)</th>
                    @endif
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

