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
              <li class="breadcrumb-item"><a href="home">Trang chủ</a></li>
              <li class="breadcrumb-item active">Sinh viên</li>
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
                @if(session('success'))
                  <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title">{{session('success')}}</h3>
                    </div>
                  </div>
                  @endif
                <div class="row">
                  <div class="col-sm-10">
                    <h3 class="card-title">Danh sách sinh viên</h3>
                  </div>
                  <div class="col-sm-2"> 
                    <h3 class="btn btn-success">
                      <a href="{{ route('student.create')}}">
                        Thêm mới
                      </a>
                    </h3>
                    <h3 class="btn btn-warning">
                      <a href="{{ route('student.insert-excel')}}">
                        Thêm bằng excel
                      </a>
                    </h3>
                  </div>
                </div>
                  
                  <form action="" >
                    {{-- Chọn lớp muốn xem thông tin --}}
                  <div class="row">
                    <div class="col-3" style="text-align: right">
                      Chọn lớp: 
                    </div>
                  
                    <div class="col-6">
                      <select name="idClass" class="form-control">
                        <option style="text-align: center" value="">--------------------</option>
                        @foreach ($classs as $class)
                            <option style="text-align: center" value="{{$class->idClass}}"
                              @if ($class->idClass == $idClass)
                                {{"selected"}}
                              @endif
                            >{{$class->nameClass}}</option>
                        @endforeach
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
                                {{ $class->nameClass }}
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
