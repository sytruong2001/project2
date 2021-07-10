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
              <li class="breadcrumb-item active">Edit Student</li>
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
                  <div class="form-group">
                    <label for="exampleInputEmail1">First Name</label>
                    <input type="text" name="firstName" value="{{ $student->firstName }}"  class="form-control" id="exampleInputEmail1" placeholder="Enter first name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Middle Name</label>
                    <input type="text" name="middleName" value="{{ $student->middleName }}" class="form-control" id="exampleInputEmail1" placeholder="Enter middle name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Last Name</label>
                    <input type="text" name="lastName" value="{{ $student->lastName }}" class="form-control" id="exampleInputEmail1" placeholder="Enter last name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Gender</label><br>
                    <input type="radio" name="gender"  id="exampleInputEmail1" value="0" @if( $student->gender == 0) {{ "checked" }} @endif>Nam
                    <input type="radio" name="gender"  id="exampleInputEmail1" value="1" @if( $student->gender == 1) {{ "checked" }} @endif>Nữ
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Classroom</label>
                    <select name="idClass" id="idClass" class="form-control">
                        @foreach ($class as $class)
                            <option value="{{ $class->idClass }}"
                              @if($class->idClass == $student->idClass)
                                {{ "selected" }}
                              @endif
                            >
                              {{ $class->nameClass }}{{ $class->nameFaculty }}
                            </option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" value="{{ $student->email }}" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Phone Number</label>
                    <input type="number" name="phone" value="{{ $student->phone }}" class="form-control" id="exampleInputEmail1" placeholder="Enter phone number">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Birthday</label>
                    <input type="date" name="birthday" value="{{ $student->birthday }}" class="form-control" id="exampleInputEmail1" placeholder="Enter birthday">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Address</label>
                    <input type="text" name="address" value="{{ $student->address }}" class="form-control" id="exampleInputEmail1" placeholder="Enter address">
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

