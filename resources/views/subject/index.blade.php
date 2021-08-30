@extends('layout.sidebar')
  <!-- Content Wrapper. Contains page content -->
  @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lý môn học</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home">Home</a></li>
              <li class="breadcrumb-item active">Subject</li>
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
                    <h3 class="card-title">Danh sách môn học</h3>
                  </div>
                  <div class="col-sm-2"> 
                    <h3 class="btn btn-success">
                      <a href="{{ route('subject.create')}}">
                        Thêm mới
                      </a>
                    </h3>
                  </div>
                </div>
                <h3 class="btn btn-default">
                  
                  <form action="" >
                    Chọn Ngành: 
                    <select name="idMajor" class="form-control">
                      <option value="">.................................</option>
                      @foreach ($major as $major)
                          <option value="{{$major->idMajor}}"
                            @if ($major->idMajor == $idMajor)
                              {{"selected"}}
                            @endif
                          >{{$major->nameMajor}}</option>
                      @endforeach
                    </select>
                    <br>
                    <button class="btn btn-default">Okkkkkkk</button>
                  </form>
                </h3>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Mã môn học</th>
                    <th>Tên môn học</th>
                    <th>Ngành</th>
                    <th>Thời lượng học(Giờ)</th>
                    <th>Sửa</th>
                    <th>Ẩn</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($subjects as $subject)
                        <tr>
                          <th>{{ $subject->idSubject}}</th>
                          <th>{{ $subject->nameSubject }}</th>
                          <th>{{ $subject->nameMajor }}</th>
                          <th>{{ $subject->duration }}</th>
                          <th><a href="{{ route('subject.edit',$subject->idSubject)}}" class="btn btn-warning">Edit</a></th>
                          <th><a href="{{ route('subject.hide',$subject->idSubject)}}" class="btn btn-danger">Hide</a></th>
                        </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Mã môn học</th>
                    <th>Tên môn học</th>
                    <th>Ngành</th>
                    <th>Thời lượng học(Giờ)</th>
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
