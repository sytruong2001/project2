@extends('layout.sidebar')


  <!-- Content Wrapper. Contains page content -->
  @section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lý lớp học</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home">Home</a></li>
              <li class="breadcrumb-item active">Class</li>
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
                    <h3 class="card-title">Danh sách lớp học</h3>
                  </div>
                  <div class="col-sm-2"> 
                    <h3 class="btn btn-success">
                      <a href="{{ route('class.create')}}">
                        Thêm mới
                      </a>
                    </h3>
                    <h3 class="btn btn-warning">
                      <a href="{{ route('class.insert-excel')}}">
                        Thêm bằng excel
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
                    <button class="btn btn-default">Okkkkkkk</button>
                  </form>
                </h3>
                <h3 class="btn btn-default">
                  
                  <form action="" >
                    Chọn Khóa: 
                    <select name="idFaculty" class="form-control">
                      <option value="">.................................</option>
                      @foreach ($faculty as $faculty)
                          <option value="{{ $faculty->idFaculty}}"
                            @if ($faculty->idFaculty == $idFaculty)
                              {{"selected"}}
                            @endif
                          >{{$faculty->nameFaculty}}</option>
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
                    <th>Mã lớp</th>
                    <th>Tên lớp</th>
                    <th>Tên khóa</th>
                    <th>Tên ngành</th>
                    <th>Sửa</th>
                    <th>Ẩn</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $class)
                      <tr>
                        <th>{{ $class->idClass}}</th>
                        <th>{{ $class->nameClass}}</th>
                        <th>{{ $class->nameFaculty}}</th>
                        <th>{{ $class->nameMajor}}</th>
                        <th><a href="{{ route('class.edit',$class->idClass)}}" class="btn btn-warning">Edit</a></th>
                        <th><a href="{{ route('class.hide',$class->idClass)}}" class="btn btn-danger">Hide</a></th>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Mã lớp</th>
                    <th>Tên lớp</th>
                    <th>Tên khóa</th>
                    <th>Tên ngành</th>
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

