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
              <li class="breadcrumb-item"><a href="home">Home</a></li>
              <li class="breadcrumb-item active">Information</li>
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
              @foreach ($data as $admin)
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                         src="asset/dist/img/user4-128x128.jpg"
                         alt="User profile picture">
                  </div>
                  
                  <h3 class="profile-username text-center">{{ $admin->lastName}} {{ $admin->middleName}} {{ $admin->firstName}}</h3>
                  <p class="profile-username text-center">
                      @if (Session::exists("admin_id"))
                        {{"(Giáo vụ)"}}                          
                      @endif
                  </p>
                  <ul class="list-group list-group-unbordered mb-1">
                    <li class="list-group-item">
                        <b>Địa chỉ email:  {{ $admin->email}}</b> 
                    </li>

                    <li class="list-group-item">
                        <b>Giới tính: 
                            @if ($admin->gender == 1)
                                {{ "Nam"}}
                            @elseif ($admin->gender == 0)
                                {{ "Nữ"}}
                            @endif
                            
                        </b> 
                    </li>

                    <li class="list-group-item">
                        <b>Ngày sinh:  {{ $admin->birthday}}</b> 

                    </li>

                    <li class="list-group-item">
                        <b>Số điện thoại:  {{ $admin->phone}}</b> 

                    </li>

                    <li class="list-group-item">
                        <b>Địa chỉ:  {{ $admin->address}}</b> 

                    </li>
                  </ul>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
  
              <!-- About Me Box -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Thay đổi mật khẩu</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('admin.changePassword',$admin->idAdmin) }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden"  name="id" value="{{ $admin->idAdmin }}">
                        <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mật khẩu hiện tại(Đã mã hóa):</label>
                            <input type="text" readonly value="{{ $admin->password }}"  class="form-control">

                            <label for="exampleInputEmail1">Mật khẩu mới:</label>
                            <input type="text" name="newPassword"  class="form-control">

                            <label for="exampleInputEmail1">Nhập lại mật khẩu:</label>
                            <input type="text" name="rePassword" class="form-control">
                        </div>
                        @if(isset($error))
                            <p style="color:red;">
                                {{ $error }}
                            </p>
                        @endif
                        @if(isset($message))
                            <p style="color:blue;">
                                {{ $message }}
                            </p>
                        @endif
                        </div>
                        <!-- /.card-body -->
        
                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              @endforeach
            </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @stop()
