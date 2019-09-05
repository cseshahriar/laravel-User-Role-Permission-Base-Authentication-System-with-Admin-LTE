<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('admin/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/AdminLTE.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/square/blue.css') }}">
   {{-- toastr --}}

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
    <div class="login-box">

      <div class="login-logo">
        <a href="{{ route('admin.login') }}"><b>Admin</b> Login</a>    
      </div> 

      <!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="{{ route('admin.login') }}" method="post">
            
            @csrf 

          <div class="form-group @error('email') has-error @enderror">
            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}"  autocomplete="email" autofocus>

             @error('email')
                <p class="text-danger" style="margin-top: 10px">
                <span class="glyphicon glyphicon-envelope"></span>
                    {{ $message }}
                </p>
            @enderror
          </div>

          <div class="form-group @error('password') has-error @enderror">
            <input type="password" name="password" class="form-control" placeholder="Password">
        
            @error('password')
                <p class="text-danger" style="margin-top: 10px">
                <span class="glyphicon glyphicon-lock"></span>
                    {{ $message }}
                </p>
            @enderror
          </div>

          <div class="row">

            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                </label>
              </div>
            </div> 
            <!-- /.col -->

            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Sign In') }}</button> 
            </div>
            <!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center">
        </div>
        <!-- /.social-auth-links -->
      </div>
      <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }}"></script> 
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>

