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
              <li class="breadcrumb-item active">Edit Class</li>
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
              @foreach ($assign as $assign)                  
              <form action="{{ route('assign.update',$assign->idAssign )}}" method="post">
                @method("put")
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden"  name="id" value="{{ $assign->idAssign }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên lớp học</label>
                    <select name="idClass" id="idClass" class="form-control">
                        @foreach ($class as $class)
                            <option value="{{ $class->idClass }}" 
                                @if( $class->idClass == $assign->idClass)
                                    {{"selected"}}
                                @endif
                            >
                                {{ $class->nameClass }}
                            </option>
                        @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên khóa học</label>
                    <select name="idFaculty" id="idFaculty" class="form-control">
                        @foreach ($faculty as $faculty)
                            <option value="{{ $faculty->idFaculty }}" 
                                @if( $faculty->idFaculty == $assign->idFaculty)
                                    {{"selected"}}
                                @endif
                            >
                                {{ $faculty->nameFaculty }}
                            </option>
                        @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên môn học</label>
                    <select name="idSubject" id="idSubject" class="form-control">
                        @foreach ($subject as $subject)
                            <option value="{{ $subject->idSubject }}" 
                                @if( $subject->idSubject == $assign->idSubject)
                                    {{"selected"}}
                                @endif
                            >
                                {{ $subject->nameSubject }}
                            </option>
                        @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên giảng viên </label>
                    <select name="idTeacher" id="idTeacher" class="form-control">
                        @foreach ($teacher as $teacher)
                            <option value="{{ $teacher->idTeacher }}" 
                                @if( $teacher->idTeacher == $assign->idTeacher)
                                  {{"selected"}}
                                @endif
                            >
                                {{ $teacher->lastName }} {{ $teacher->middleName }} {{ $teacher->firstName }}
                            </option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Ngày bắt đầu </label>
                    <input type="date" name="startDate" id="startDate" class="form-control" value="{{ $assign->start_date }}">
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


