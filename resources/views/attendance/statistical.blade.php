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
                    <th>Tỉ lệ nghỉ</th>
                    <th>Trạng thái</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($attendance as $attendance)
                      <tr>
                        <th>{{ $index++}}</th>
                        <th>
                            @foreach ($students as $student)
                                @if ($student->idStudent != null)
                                    @if (($student->idStudent) == ($attendance->idStudent))
                                        {{ $student->lastName}} {{ $student->middleName}} {{ $student->firstName}}
                                    @endif
                                @endif
                            @endforeach
                        
                        </th>
                        <th>{{ $attendance->nameClass}}</th>
                        <th>{{ $attendance->nameSubject}}</th>
                        <th style="color:blue; text-align:center">
                            @foreach ($dihocs as $dihoc)
                                @if ($dihoc->idStudent != null)
                                    @if (($dihoc->idStudent) == ($attendance->idStudent))
                                        {{ $dihoc->count_dihoc}}
                                    @endif
                                @endif
                            @endforeach
                        </th>
                        <th style="color:red; text-align:center">
                            @foreach ($nghiKps as $nghiKp)
                                @if ($nghiKp->idStudent != null)
                                    @if (($nghiKp->idStudent) == ($attendance->idStudent))
                                        @if ($nghiKp->count_nghiKp > 0)
                                            {{ $nghiKp->count_nghiKp }}
                                        @elseif($nghiKp->count_nghiKp == null )
                                            {{ "0"}}
                                        @endif
                                    @endif
                                @endif
                            @endforeach
                        </th>
                        <th style="color:red; text-align:center">
                            @foreach ($nghiPs as $nghiP)
                                @if ($nghiP->idStudent != null)
                                    @if (($nghiP->idStudent) == ($attendance->idStudent))
                                        @if ($nghiP->count_nghiP > 0)
                                            {{ $nghiP->count_nghiP }}
                                        @elseif($nghiP->count_nghiP == null )
                                            {{ "0"}}
                                        @endif
                                    @endif
                                @endif
                            @endforeach
                        </th>
                        <th style="color:rgb(212, 58, 19); text-align:center">
                            @foreach ($dimuons as $muon)
                                @if ($muon->idStudent != null)
                                    @if (($muon->idStudent) == ($attendance->idStudent))
                                        @if ($muon->count_dimuon > 0)
                                            {{ $muon->count_dimuon }}
                                        @elseif($muon->count_dimuon == null )
                                            {{ "0"}}
                                        @endif
                                    @endif
                                @endif
                            @endforeach
                        </th>
                        <th style="text-align:center">
                            /{{$countAttendance}}
                        </th>
                        <th></th>
                      </tr>
                    @endforeach
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
                    <th>Tỉ lệ nghỉ</th>
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

