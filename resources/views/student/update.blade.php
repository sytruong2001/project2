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
              <li class="breadcrumb-item active">Cập nhật sinh viên</li>
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
              @foreach ($student as $student)                  
              <form action="{{ route('student.update',$student->idStudent) }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @method("put")
                <input type="hidden"  name="id" value="{{ $student->idStudent }}">

                <div class="card-body">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Tên sinh viên</label>
                        <input type="text" name="firstName" value="{{ $student->firstName }}"  class="form-control" id="exampleInputEmail1" placeholder="Enter first name">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Tên đệm</label>
                        <input type="text" name="middleName" value="{{ $student->middleName }}" class="form-control" id="exampleInputEmail1" placeholder="Enter middle name">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Họ</label>
                        <input type="text" name="lastName" value="{{ $student->lastName }}" class="form-control" id="exampleInputEmail1" placeholder="Enter last name">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Giới tính</label><br>
                        <input type="radio" name="gender"  id="exampleInputEmail1" value="0" @if( $student->gender == 0) {{ "checked" }} @endif>Nam
                        <input type="radio" name="gender"  id="exampleInputEmail1" value="1" @if( $student->gender == 1) {{ "checked" }} @endif>Nữ
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Lớp học</label>
                        <select name="idClass" id="idClass" class="form-control">
                            @foreach ($class as $class)
                                <option value="{{ $class->idClass }}"
                                  @if($class->idClass == $student->idClass)
                                    {{ "selected" }}
                                  @endif
                                >
                                  {{ $class->nameClass }}
                                </option>
                            @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Địa chỉ email</label>
                        <input type="email" name="email" value="{{ $student->email }}" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Số điện thoại</label>
                        <input type="number" name="phone" value="{{ $student->phone }}" class="form-control" id="exampleInputEmail1" placeholder="Enter phone number">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Ngày sinh</label>
                        <input type="date" name="birthday" value="{{ $student->birthday }}" class="form-control" id="exampleInputEmail1" placeholder="Enter birthday">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Địa chỉ</label>
                        <input type="text" name="address" value="{{ $student->address }}" class="form-control" id="exampleInputEmail1" placeholder="Enter address">
                      </div>
                    </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" style="margin:auto;display:block">Cập nhật</button>
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

