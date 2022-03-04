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
              <li class="breadcrumb-item"><a href="home">Trang chủ</a></li>
              <li class="breadcrumb-item active">Cập nhật lớp học</li>
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
              @foreach ($class as $class)                  
              <form action="{{ route('class.update',$class->idClass)}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @method("put")
                <input type="hidden"  name="id" value="{{ $class->idClass }}">

                <div class="card-body" style="text-align: center">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên lớp học</label>
                    <input style="text-align: center" type="text" name="nameClass" value="{{ $class->nameClass }}"  class="form-control" id="exampleInputEmail1">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên khóa học</label>
                    <select name="idFaculty" id="idFaculty" class="form-control">
                        @foreach ($faculty as $faculty)
                            <option style="text-align: center" value="{{ $faculty->idFaculty }}" 
                                @if( $faculty->idFaculty == $class->idFaculty)
                                    {{"selected"}}
                                @endif
                            >
                                {{ $faculty->nameFaculty }}
                            </option>
                        @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên ngành học</label>
                    <select name="idMajor" id="idMajor" class="form-control">
                        @foreach ($major as $major)
                            <option style="text-align: center" value="{{ $major->idMajor }}" 
                                @if( $major->idMajor == $class->idMajor)
                                  {{"selected"}}
                                @endif
                            >
                                {{ $major->nameMajor }}
                            </option>
                        @endforeach
                    </select>
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


