@extends('layout.sidebar')

  <!-- Content Wrapper. Contains page content -->
  @section('content')
      

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lý lịch học</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home">Trang chủ</a></li>
              <li class="breadcrumb-item active">Lịch học</li>
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

            <div class="card">

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped" style="text-align: center">
                  <thead>
                  <tr>
                    <th>Mã số</th>
                    <th>Tên giảng viên</th>
                    <th>Tên lớp</th>
                    <th>Tên môn</th>
                    <th>Thời lượng học</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày trong tuần</th>
                    <th>Trạng thái</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if(!empty($assign))
                    @foreach ($assign as $data)
                      <tr>
                        <th>{{ $data->idAssign}}</th>
                        <th>{{ $data->lastName }} {{ $data->middleName }} {{ $data->firstName }}</th>
                        <th>{{ $data->nameClass}}</th>
                        <th>{{ $data->nameSubject}}</th>
                        <th>{{ $data->duration}}</th>
                        <th>{{ $data->start_date}}</th>
                        <th>
                          @if( $data->date == 0)
                            T2, 4, 6
                          @elseif( $data->date == 1)
                            T3, 5, 7
                          @endif
                        </th>
                        <th>
                            @foreach ($timeStart as $start)
                                @foreach ($timeEnd as $end)
                                    @if ($data->idAssign == $start->idAssign && $data->idAssign == $end->idAssign)
                                        @if ((($end->sum_end - $start->sum_start) / 10000) > 0 && (($end->sum_end - $start->sum_start) / 10000) < $data->duration)
                                            <p style="color:blue">Đang dạy (Hoàn thành {{ ($end->sum_end - $start->sum_start) / 10000}} giờ)</p> 
                                        @elseif((($end->sum_end - $start->sum_start) / 10000) == $data->duration)
                                            <p style="color:green">Đã hoàn thành</p>
                                        @endif
                                    @endif
                                @endforeach
                            @endforeach
                        </th>
                      </tr>
                    @endforeach
                    @endif
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Mã số</th>
                    <th>Tên giảng viên</th>
                    <th>Tên lớp</th>
                    <th>Tên môn</th>
                    <th>Thời lượng học</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày trong tuần</th>
                    <th>Trạng thái</th>
                  </tr>
                  </tfoot>
                </table>
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

