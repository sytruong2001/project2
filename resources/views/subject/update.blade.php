@extends('layout.sidebar')
  
  <!-- Content Wrapper. Contains page content -->
  @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lý môn học</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home">Trang chủ</a></li>
              <li class="breadcrumb-item active">Cập nhật môn học</li>
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
              @foreach ($subjects as $subject)                  
              <form action="{{ route('subject.update',$subject->idSubject) }}" method="post">
                @method("put")
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden"  name="id" value="{{ $subject->idSubject }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên môn học</label>
                    <input type="text" name="nameSubject" value="{{ $subject->nameSubject }}"  class="form-control" id="exampleInputEmail1">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Ngành</label>
                    <select name="idMajor" id="idMajor" class="form-control" >
                        @foreach ($majors as $major)
                            <option value="{{ $major->idMajor }}"
                              @if($major->idMajor == $subject->idMajor)
                                {{ "selected" }}
                              @endif
                            >
                              {{ $major->nameMajor }}
                            </option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Thời lượng học</label>
                    <input type="number" name="duration" value="{{ $subject->duration }}" class="form-control" id="exampleInputEmail1" >
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

