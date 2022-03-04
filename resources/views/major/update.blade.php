@extends('layout.sidebar')
  
  <!-- Content Wrapper. Contains page content -->
  @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lý ngành học</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home">Trang chủ </a></li>
              <li class="breadcrumb-item active">Cập nhật ngành học</li>
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
              @foreach ($data as $major)                  
              <form action="{{ route('major.update',$major->idMajor) }}" method="post">
                @method("put")
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden"  name="id" value="{{ $major->idMajor }}">
                <div class="card-body" style="text-align: center">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name Major</label>
                    <input style="text-align: center" type="text" name="nameMajor" value="{{ $major->nameMajor }}"  class="form-control" id="exampleInputEmail1"">
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

