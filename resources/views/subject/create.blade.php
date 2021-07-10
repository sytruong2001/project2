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
              <li class="breadcrumb-item"><a href="home">Home</a></li>
              <li class="breadcrumb-item active">Add Subject</li>
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
                <h3 class="card-title">Thêm mới môn học</h3>
              </div>
              @if(isset($message))
                <p style="color:rgb(255, 81, 0);">
                    {{ $mes }}
                </p>
              @endif
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('subject.store')}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên môn học</label>
                    <input type="text" name="nameSubject"  class="form-control" id="exampleInputEmail1" placeholder="Nhập tên môn học">
                  </div>
                  

                  <div class="form-group">
                    <label for="exampleInputEmail1">Ngành</label>
                    <select name="idMajor" id="idMajor" class="form-control">
                        @foreach ($major as $major)
                            <option value="{{ $major->idMajor }}">{{ $major->nameMajor }}</option>
                        @endforeach
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Thời lượng học</label><br>
                    <input type="number" name="duration" class="form-control"  id="exampleInputEmail1" placeholder="Nhập thời lượng học">
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

