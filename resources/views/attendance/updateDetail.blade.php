@extends('layout.sidebar')


  <!-- Content Wrapper. Contains page content -->
  @section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lý nhật ký điểm danh</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home">Home</a></li>
              <li class="breadcrumb-item active">Diary</li>
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
                  @foreach( $detail as $detail)
                  <div class="row">
                    <div class="col-sm-4">
                      <!-- radio -->
                      <div class="form-group">
                        {{ $index++}})  {{ $detail->idStudent}} - {{ $detail->lastName}} {{ $detail->middleName}} {{ $detail->firstName}}
                        
                      </div>
                    </div>
                    <div class="col-sm-8">
                      <!-- radio -->
                      <div class="form-group">
                        <div>
                          <b><input type="radio" id="status" name="{{ $detail->idStudent}}" value="0" @if($detail->status == 0){{ "checked" }}@endif>Đi học</b> &nbsp;
                          <b><input type="radio" id="status" name="{{ $detail->idStudent}}" value="1" @if($detail->status == 1){{ "checked" }}@endif>Nghỉ học</b> &nbsp;
                          <b><input type="radio" id="status" name="{{ $detail->idStudent}}" value="2" @if($detail->status == 2){{ "checked" }}@endif>Muộn</b> &nbsp;
                          <b><input type="radio" id="status" name="{{ $detail->idStudent}}" value="3" @if($detail->status == 3){{ "checked" }}@endif>Có phép</b> &nbsp;
                          <b><input type="radio" id="status" name="{{ $detail->idStudent}}" value="4" @if($detail->status == 4){{ "checked" }}@endif>Không phép</b> &nbsp;
                        </div>                       
                      </div>
                    </div>
                  </div>
                  @endforeach
                  <div >
                    <button class="btn btn-success">Cập nhật</button>
                  </div>
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

