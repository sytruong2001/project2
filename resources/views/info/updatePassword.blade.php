@extends('layout.sidebar')

  <!-- Content Wrapper. Contains page content -->
  @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Thông tin cá nhân</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home">Trang chủ</a></li>
              <li class="breadcrumb-item active">Cập nhật mật khẩu</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Thay đổi mật khẩu:</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    @foreach ($data as $teacher)                  
                    <form action="{{ route('teacher.changePassword',$teacher->idTeacher) }}" method="post">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden"  name="id" value="{{ $teacher->idTeacher }}">
                      <div class="card-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Mật khẩu hiện tại(Đã mã hóa):</label>
                          <input type="text" readonly value="{{ $teacher->password }}"  class="form-control">

                          <label for="exampleInputEmail1">Mật khẩu mới:</label>
                          <input type="text" name="newPassword"  class="form-control">

                          <label for="exampleInputEmail1">Nhập lại mật khẩu:</label>
                          <input type="text" name="rePassword" class="form-control">
                        </div>
                        @if(isset($error))
                          <p style="color:red;">
                              {{ $error }}
                          </p>
                        @endif
                        @if(isset($message))
                          <p style="color:blue;">
                              {{ $message }}
                          </p>
                        @endif
                      </div>
                      <!-- /.card-body -->
      
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                      </div>
                    </form>
                    @endforeach
                  </div>
            </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @stop()
