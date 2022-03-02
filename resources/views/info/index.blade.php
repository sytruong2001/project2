@extends('layout.sidebar')

  <!-- Content Wrapper. Contains page content -->
  @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Thông tin cá nhân</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home">Trang chủ</a></li>
              <li class="breadcrumb-item active">Thông tin cá nhân</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
  
              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                         src="asset/dist/img/user4-128x128.jpg"
                         alt="User profile picture">
                  </div>
                  @foreach ($data as $teacher)
                      
                  @endforeach
                  <h3 class="profile-username text-center">{{ $teacher->lastName}} {{ $teacher->middleName}} {{ $teacher->firstName}}</h3>
                  <p class="profile-username text-center">
                      @if (Session::exists("user_id"))
                        {{"(Giảng viên)"}}                          
                      @endif
                  </p>
                  <ul class="list-group list-group-unbordered mb-1">
                    <li class="list-group-item">
                        <b>Địa chỉ email:  {{ $teacher->email}}</b> 
                    </li>

                    <li class="list-group-item">
                        <b>Giới tính: 
                            @if ($teacher->gender == 0)
                                {{ "Nam"}}
                            @elseif ($teacher->gender == 1)
                                {{ "Nữ"}}
                            @endif
                            
                        </b> 
                    </li>

                    <li class="list-group-item">
                        <b>Ngày sinh:  {{ $teacher->birthday}}</b> 

                    </li>

                    <li class="list-group-item">
                        <b>Số điện thoại:  {{ $teacher->phone}}</b> 

                    </li>

                    <li class="list-group-item">
                        <b>Địa chỉ:  {{ $teacher->address}}</b> 

                    </li>
                  </ul>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
  
              <!-- About Me Box -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Danh sách lớp dạy</h3>
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>STT</th>
                    <th>Tên lớp</th>
                    <th>Môn học</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($class as $class)
                      <tr>
                        <th>{{ $index++}}</th>
                        <th>{{ $class->nameClass}}</th>
                        <th>{{ $class->nameSubject}}</th>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>STT</th>
                    <th>Tên lớp</th>
                    <th>Môn học</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @stop()
