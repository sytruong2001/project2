<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Project 2 | ST </title>
  <base href="{{ asset('') }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="asset/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Ion Slider -->
  <link rel="stylesheet" href="asset/plugins/ion-rangeslider/css/ion.rangeSlider.min.css">
  <!-- bootstrap slider -->
  <link rel="stylesheet" href="asset/plugins/bootstrap-slider/css/bootstrap-slider.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="asset/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="asset/plugins/jqvmap/jqvmap.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="asset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="asset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="asset/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="asset/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="asset/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="asset/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="asset/plugins/summernote/summernote-bs4.min.css">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="asset/plugins/fullcalendar/main.css">
</head>
<body class="hold-transition sidebar-mini sidebar-collapse">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      @if(Session::exists('admin_name'))
      <li class="nav-item d-none d-sm-inline-block">
        <a href="home" class="nav-link">Trang chủ</a>
      </li>
      @endif
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user-graduate"></i>
          @if(Session::exists('admin_name'))
            {{ Session::get('admin_name')[2] }}
            {{ Session::get('admin_name')[1] }}
            {{ Session::get('admin_name')[0] }}
            {{ "(Giáo vụ)"}}
          @elseif (Session::exists('user_name'))
            {{ Session::get('user_name')[2] }}
            {{ Session::get('user_name')[1] }}
            {{ Session::get('user_name')[0] }}
            {{ "(Giảng viên)"}}
          @elseif (Session::exists('student_name'))
            {{ Session::get('student_name')[2] }}
            {{ Session::get('student_name')[1] }}
            {{ Session::get('student_name')[0] }}
            {{ "(Sinh viên)"}}
          @endif
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          
        <div class="dropdown-divider"></div>
          <a href="/logout" class="dropdown-item dropdown-footer">Đăng xuất</a>
        </div>
      </li>
      {{-- <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li> --}}
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="asset/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Project 3 | L-S</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            
            @if(Session::exists('user_id'))
              {{-- Thao tác diểm danh --}}
              <li class="nav-item">
                <a href="/attendance/create" class="nav-link">
                  <i class="nav-icon fas fa-edit"></i>
                  <p>Điểm danh</p>
                </a>
              </li>

              {{-- Thao tác với giảng viên --}}
              {{-- Thông tin cá nhân --}}
              <li class="nav-item">
                <a href="{{ route('teacher.show', Session::get('user_id'))}}" class="nav-link">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    Thông tin cá nhân & lịch dạy
                  </p>
                </a>
              </li>
              {{-- Đổi mật khẩu --}}
              <li class="nav-item">
                <a href="{{ route('teacher.showPassword', Session::get('user_id'))}}" class="nav-link">
                  <i class="nav-icon fas fa-edit"></i>
                  <p>
                    Đổi mật khẩu
                  </p>
                </a>
              </li>
            
            @endif
          @if(Session::exists('admin_id') || Session::exists('user_id'))
            <li class="nav-item">
              <a href="/attendance" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>Nhật ký điểm danh</p>
              </a>
            </li>
          @endif
          {{-- Dành cho sinh viên --}}
          @if(Session::exists('student_id')) 
            <li class="nav-item">
              <a href="/homeStudent/index" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>Nhật ký điểm danh</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/schedule/search/{{Session::get('student_id')}}" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>Lịch học</p>
              </a>
            </li>
          @endif
          {{-- Dành cho giáo vụ --}}
          @if(Session::exists('admin_id'))

            {{-- Thao tác với thống kê --}}
            <li class="nav-item">
              <a href="{{ route('detailattendance.index')}}" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Thống kê
                </p>
              </a>
            </li>

            <!-- Thao tác phân công -->
            <li class="nav-item">
              <a href="{{ route('assign.index')}}" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Phân công
                </p>
              </a>
            </li>

            <!-- Thao tác với giảng viên -->
            <li class="nav-item">
              <a href="{{ route('teacher.index')}}" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Quản lý giảng viên
                </p>
              </a>

            </li>

            {{-- Thao tác với sinh viên --}}
            <li class="nav-item">
              <a href="{{ route('student.index')}}" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Quản lý sinh viên
                </p>
              </a>
            </li>

            {{-- Thao tác với lớp --}}
            <li class="nav-item">
              <a href="{{ route('class.index')}}" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Quản lý lớp
                </p>
              </a>
            </li>

            <!-- Thao tác với khóa học -->
            <li class="nav-item">
              <a href="{{ route('faculty.index')}}" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  Quản lý niên khóa
                </p>
              </a>
            </li>

            <!-- Thao tác với ngành học -->
            <li class="nav-item">
              <a href="{{ route('major.index')}}" class="nav-link">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                  Quản lý ngành học
                </p>
              </a>
            </li>

            <!-- Thao tác với môn học -->
            <li class="nav-item">
              <a href="{{ route('subject.index')}}" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Quản lý môn học
                </p>
              </a>
            </li>

            

            {{-- Thao tác với thông tin cá nhân giáo vụ --}}
            <li class="nav-item">
              <a href="{{ route('admin.show', Session::get('admin_id') ) }}" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Thông tin cá nhân
                </p>
              </a>
            </li>
          @endif

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  @yield('content')
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0
    </div>
    <strong>Copyright &copy; 2022-2023 <a href="https://adminlte.io">Project3-LS</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="asset/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery UI -->
<script src="asset/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- bs-custom-file-input -->
<script src="asset/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="asset/plugins/moment/moment.min.js"></script>
<script src="asset/plugins/fullcalendar/main.js"></script>
<!-- DataTables  & Plugins -->
<script src="asset/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="asset/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="asset/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="asset/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="asset/plugins/jszip/jszip.min.js"></script>
<script src="asset/plugins/pdfmake/pdfmake.min.js"></script>
<script src="asset/plugins/pdfmake/vfs_fonts.js"></script>
<script src="asset/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="asset/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="asset/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Ion Slider -->
<script src="asset/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
<!-- Bootstrap slider -->
<script src="asset/plugins/bootstrap-slider/bootstrap-slider.min.js"></script>
<!-- AdminLTE App -->
<script src="asset/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="asset/dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>

  <!-- Page specific script -->
<script>
  $(function () {
    bsCustomFileInput.init();
  });
  </script>


<script>
  $(function () {
    /* BOOTSTRAP SLIDER */
    $('.slider').bootstrapSlider()

    /* ION SLIDER */
    $('#range_1').ionRangeSlider({
      min     : 0,
      max     : 5000,
      from    : 1000,
      to      : 4000,
      type    : 'double',
      step    : 1,
      prefix  : '$',
      prettify: false,
      hasGrid : true
    })
    $('#range_2').ionRangeSlider()

    $('#range_5').ionRangeSlider({
      min     : 0,
      max     : 10,
      type    : 'single',
      step    : 0.1,
      postfix : ' mm',
      prettify: false,
      hasGrid : true
    })
    $('#range_6').ionRangeSlider({
      min     : -50,
      max     : 50,
      from    : 0,
      type    : 'single',
      step    : 1,
      postfix : '°',
      prettify: false,
      hasGrid : true
    })

    $('#range_4').ionRangeSlider({
      type      : 'single',
      step      : 100,
      postfix   : ' light years',
      from      : 55000,
      hideMinMax: true,
      hideFromTo: false
    })
    $('#range_3').ionRangeSlider({
      type    : 'double',
      postfix : ' miles',
      step    : 10000,
      from    : 25000000,
      to      : 35000000,
      onChange: function (obj) {
        var t = ''
        for (var prop in obj) {
          t += prop + ': ' + obj[prop] + '\r\n'
        }
        $('#result').html(t)
      },
      onLoad  : function (obj) {
        //
      }
    })
  })
</script>
</body>
</html>
