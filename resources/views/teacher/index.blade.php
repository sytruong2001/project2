@extends('layout.sidebar')

  <!-- Content Wrapper. Contains page content -->
  @section('content')
      

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lý giảng viên</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home">Trang chủ</a></li>
              <li class="breadcrumb-item active">Giảng viên</li>
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
                    <h3 class="card-title">Danh sách giảng viên</h3>
                  </div>
                  <div class="col-sm-2"> 
                    <h3 class="btn btn-success">
                      <a href="{{ route('teacher.create')}}">
                        Thêm mới
                      </a>
                    </h3>
                    <h3 class="btn btn-warning">
                      <a href="{{ route('teacher.insert-excel')}}">
                        Thêm bằng excel
                      </a>
                    </h3>
                  </div>
                </div>                
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Mã giảng viên</th>
                    <th>Họ tên</th>
                    <th>Giới tính</th>
                    <th>Email</th>
                    <th>Mật khẩu</th>
                    <th>Ngày sinh</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Sửa</th>
                    <th>Ẩn</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $teacher)
                        <tr>
                          <th>{{ $teacher->idTeacher}}</th>
                          <th>{{ $teacher->lastName }} {{ $teacher->middleName }} {{ $teacher->firstName }}</th>
                          <th>
                            @if( $teacher->gender == 1)
                              Nam
                            @else
                              Nữ
                            @endif
                          </th>
                          <th>{{ $teacher->email}}</th>
                          <th>{{ $teacher->password}}</th>
                          <th>{{ $teacher->birthday}}</th>
                          <th>{{ $teacher->phone}}</th>
                          <th>{{ $teacher->address}}</th>
                          <th><a href="{{ route('teacher.edit', $teacher->idTeacher)}}" class="btn btn-warning">Edit</a></th>
                          <th><a href="{{ route('teacher.hide', $teacher->idTeacher)}}" class="btn btn-danger">Hide</a></th>
                        </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Mã giảng viên</th>
                    <th>Họ tên</th>
                    <th>Giới tính</th>
                    <th>Email</th>
                    <th>Mật khẩu</th>
                    <th>Ngày sinh</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Sửa</th>
                    <th>Ẩn</th>
                  </tr>
                  </tfoot>
                </table>
                {{ $data->links()}}
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

