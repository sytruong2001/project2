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
              <li class="breadcrumb-item active">Cập nhật giảng viên</li>
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
                <h3 class="card-title">Hãy điền thông tin đầy đủ theo mẫu:</h3>
              </div>
              @if(isset($message))
                <p style="color:rgb(255, 81, 0);">
                    {{ $mes }}
                </p>
              @endif
              <!-- /.card-header -->
              <!-- form start -->
              @foreach ($data as $teacher)                  
              <form action="{{ route('teacher.update', $teacher->idTeacher)}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @method("put")
                <input type="hidden"  name="id" value="{{ $teacher->idTeacher }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên giảng viên</label>
                    <input type="text" name="firstName" value="{{ $teacher->firstName }}"  class="form-control" id="exampleInputEmail1" placeholder="Enter first name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên đệm</label>
                    <input type="text" name="middleName" value="{{ $teacher->middleName }}" class="form-control" id="exampleInputEmail1" placeholder="Enter middle name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Họ</label>
                    <input type="text" name="lastName" value="{{ $teacher->lastName }}" class="form-control" id="exampleInputEmail1" placeholder="Enter last name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Giới tính</label><br>
                    <input type="radio" name="gender"  id="exampleInputEmail1" value="1"
                      @if ($teacher->gender == 1)
                        checked
                      @endif
                    >Nam
                    <input type="radio" name="gender"  id="exampleInputEmail1" value="0"
                      @if ($teacher->gender == 0)
                        checked
                      @endif
                    >Nữ
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Địa chỉ email</label>
                    <input type="email" name="email" value="{{ $teacher->email }}" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Mật khẩu</label>
                    <input type="text" name="password" value="{{ $teacher->password }}" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Số điện thoại</label>
                    <input type="number" name="phone" value="{{ $teacher->phone }}" class="form-control" id="exampleInputEmail1" placeholder="Enter phone number">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Ngày sinh</label>
                    <input type="date" name="birthday" value="{{ $teacher->birthday }}" class="form-control" id="exampleInputEmail1" placeholder="Enter birthday">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Địa chỉ</label>
                    <input type="text" name="address" value="{{ $teacher->address }}" class="form-control" id="exampleInputEmail1" placeholder="Enter address">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
              </form>
              @endforeach
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

