@extends('layout.sidebar')

  <!-- Content Wrapper. Contains page content -->
  @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lý sinh viên</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home">Home</a></li>
              <li class="breadcrumb-item active">Student</li>
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
                <h3 class="card-title">Danh sách sinh viên</h3>
                <br>
                <h3 class="btn btn-success">
                  <a href="{{ route('student.create')}}">
                    Thêm mới
                  </a>
                </h3>
                <br>
                <h3 class="btn btn-default">
                  
                  <form action="" >
                    Chọn Lớp: 
                    <select name="idClass" class="form-control">
                      <option value="">.................................</option>
                      @foreach ($classs as $class)
                          <option value="{{$class->idClass}}"
                            @if ($class->idClass == $idClass)
                              {{"selected"}}
                            @endif
                          >{{$class->nameClass}}{{$class->nameFaculty}}</option>
                      @endforeach
                    </select>
                    <button class="btn btn-primary">Okkkkkkk</button>
                  </form>
                </h3>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Mã sinh viên</th>
                    <th>Họ tên</th>
                    <th>Giới tính</th>
                    <th>Lớp</th>
                    <th>Email</th>
                    <th>Ngày sinh</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Sửa</th>
                    <th>Ẩn</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($students as $student)
                        <tr>
                          <th>{{ $student->idStudent}}</th>
                          <th>{{ $student->lastName }} {{ $student->middleName }} {{ $student->firstName }}</th>
                          <th>
                            @if( $student->gender == 0)
                              Nam
                            @else
                              Nữ
                            @endif
                          </th>
                          <th>
                            @foreach($classs as $class)
                              @if($student->idClass == $class->idClass)
                                {{ $class->nameClass }}{{ $class->nameFaculty }}
                              @endif
                            @endforeach
                          </th>
                          <th>{{ $student->email}}</th>
                          <th>{{ $student->birthday}}</th>
                          <th>{{ $student->phone}}</th>
                          <th>{{ $student->address}}</th>
                          <th><a href="{{ route('student.edit',$student->idStudent)}}" class="btn btn-warning">Edit</a></th>
                          <th><a href="{{ route('student.hide',$student->idStudent)}}" class="btn btn-danger">Hide</a></th>
                        </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Mã sinh viên</th>
                    <th>Họ tên</th>
                    <th>Giới tính</th>
                    <th>Lớp</th>
                    <th>Email</th>
                    <th>Ngày sinh</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Sửa</th>
                    <th>Ẩn</th>
                  </tr>
                  </tfoot>
                </table>
                {{-- {{ $students->links()}} --}}
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
