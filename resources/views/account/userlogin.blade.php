<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Project 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="asset/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="asset/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>Đăng nhập</b>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Hãy đăng nhập để bắt đầu </p>
      <p class="login-box-msg">Dành cho sinh viên của LS </p>
      <h4 class="login-box-msg">
        <?php
          // Set the new timezone
          date_default_timezone_set('Asia/Ho_Chi_Minh');
          $date = date('d-m-y h:i:s');
          echo "(".$date.")";
        ?>
      </h4>
      <form action="/loginStudent-process" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          
        </div>
        @if(Session::exists("errors"))
          <p style="color:red; text-align:center;">      
              {{ Session::get("errors") }}
          </p>
        @endif
        <div class="row">
        
        <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
        <!-- /.col -->
        </div>
        <br>
        <div class="row" style="text-align:center">
          <div class="col-12">
            <th><a href="/login" class="btn btn-success">Đăng nhập cho giảng viên & giáo vụ</a></th>
          </div>
        </div>
      </form>
      

      <!-- /.social-auth-links -->

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="asset/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="asset/dist/js/adminlte.min.js"></script>
</body>
</html>
