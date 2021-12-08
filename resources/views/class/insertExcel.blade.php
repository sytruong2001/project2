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
              <li class="breadcrumb-item active">Thêm mới lớp</li>
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
                <h3 class="card-title">Thêm mới lớp học</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('class.insert-excel-process')}}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Yêu cầu file phải đầy đủ các cột sau: Tên lớp, Tên khóa, Tên ngành</label>
                    <input type="file" name="nameClass" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"  class="form-control" id="exampleInputEmail1" placeholder="Nhập tên ngành">
                  </div>
                <!-- /.card-body -->
                  @if(session()->has('failures'))
                    <table id="example1" class="table table-bordered table-striped">
                      <tr>
                        <th>Hàng</th>
                        <th>Thuộc tính</th>
                        <th>Lỗi</th>
                        <th>Giá trị</th>
                        @foreach(session()->get('failures') as $vali)
                          <tr>
                            <td>{{$vali->row()}}</td>
                            <td>{{$vali->attribute()}}</td>
                            <td>
                              @foreach($vali->errors() as $e)
                                <div>{{$e}}</div>
                              @endforeach
                            </td>
                            <td>{{$vali->values()[$vali->attribute()] ?? 'NULL'}}</td>
                          </tr>
                        @endforeach
                      </tr>
                    </table>
                  @endif
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

