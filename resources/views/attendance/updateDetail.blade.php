@extends('layout.sidebar')


  <!-- Content Wrapper. Contains page content -->
  @section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @if(session('alert'))
      <section class='alert alert-success'>{{session('alert')}}</section>
    @endif

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lý nhật ký điểm danh</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home">Trang chủ</a></li>
              <li class="breadcrumb-item active">Cập nhật điểm danh</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Cập nhật điểm danh</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ route('detailattendance.update', $idAttendance ) }}" method="post">
                  @csrf
                  @method("put")
                  <table id="example" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Họ tên sinh viên</th>
                        <th>Tình trạng điểm danh</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach( $detail as $detail)
                        <tr>
                          <th>
                            {{ $index++}})  {{ $detail->idStudent}} - {{ $detail->lastName}} {{ $detail->middleName}} {{ $detail->firstName}}
                            <br>
                            ({{ $detail->birthday}})
                          </th>
                          <th>
                            <b><input type="radio" id="status" name="{{ $detail->idStudent}}" value="0" @if($detail->status == 0){{ "checked" }}@endif> Đi học</b> &nbsp;
                                <b><input type="radio" id="status" name="{{ $detail->idStudent}}" value="1" @if($detail->status == 1){{ "checked" }}@endif> Nghỉ học</b> &nbsp;
                                <b><input type="radio" id="status" name="{{ $detail->idStudent}}" value="2" @if($detail->status == 2){{ "checked" }}@endif> Muộn</b> &nbsp;
                                <b><input type="radio" id="status" name="{{ $detail->idStudent}}" value="3" @if($detail->status == 3){{ "checked" }}@endif> Có phép</b> &nbsp;
                          </th>
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th colspan="2">
                          <div class="row">
                            <div class="col-sm-5">
                            </div>
                            <div class="col-sm-7"> 
                              <br>
                              <button type="submit" class="btn btn-success"> Cập nhật </button>
                            </div>
                          </div>
                        </th>
                      </tr>
                    </tfoot>
                  </table>
                </form>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  @endsection

