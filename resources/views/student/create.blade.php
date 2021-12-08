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
              <li class="breadcrumb-item active">Thêm mới sinh viên</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Thêm mới sinh viên</h3>
              </div>
              @if(isset($message))
                <p style="color:rgb(255, 81, 0);">
                    {{ $mes }}
                </p>
              @endif
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('student.store')}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên sinh viên</label>
                    <input type="text" name="firstName"  class="form-control" id="exampleInputEmail1" placeholder="Nhập tên sinh viên">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên đệm</label>
                    <input type="text" name="middleName" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên đệm sinh viên">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Họ</label>
                    <input type="text" name="lastName" class="form-control" id="exampleInputEmail1" placeholder="Nhập họ sinh viên">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Giới tính</label><br>
                    <input type="radio" name="gender"  id="exampleInputEmail1" value="0">Nam
                    <input type="radio" name="gender"  id="exampleInputEmail1" value="1">Nữ
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Lớp học</label>
                    <select name="idClass" id="idClass" class="form-control">
                        @foreach ($class as $class)
                            <option value="{{ $class->idClass }}">{{ $class->nameClass }}{{ $class->nameFaculty }}</option>
                        @endforeach
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Địa chỉ email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Nhập email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Số điện thoại</label>
                    <input type="number" name="phone" class="form-control" id="exampleInputEmail1" placeholder="Nhập số điện thoại">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Ngày sinh</label>
                    <input type="date" name="birthday" class="form-control" id="exampleInputEmail1" placeholder="Nhập ngày sinh">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Địa chỉ</label>
                    <input type="text" name="address" class="form-control" id="exampleInputEmail1" placeholder="Nhập địa chỉ">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @endsection

