<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@lang('login.booking') | @lang('login.login')</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/all.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('bower_components/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('bower_components/adminlte3/assets_adminlte3/dist/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="{{ asset('bower_components/sweetalert2/src/sweetalert2.scss') }}">

</head>

<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <b>@lang('login.cms_booking')</b>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">@lang('login.start_session')</p>
            <form action="{{ route('auth.login') }}" method="post">
                @csrf
                @error('email')
                <small class="text-danger rule">{{ $message }}</small>
                @enderror
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" value="{{ old('email',$request->email ?? null) }}" placeholder="@lang('login.email')">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                @error('password')
                <small class="text-danger rule">{{ $message }}</small>
                @enderror
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" value="{{ old('password',$request->password ?? null) }}" placeholder="@lang('login.password')">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                @lang('login.remember_me')
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">@lang('login.sign_in')</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center mb-3">
                <p>- @lang('login.or') -</p>
                <a href="#" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i> @lang('login.facebook')
                </a>
                <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i> @lang('login.google')
                </a>
            </div>
            <!-- /.social-auth-links -->
            <p class="mb-0">
                <a href="{{ route('auth.register') }}" class="text-center"> @lang('login.register')</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('bower_components/adminlte3/assets_adminlte3/dist/js/adminlte.js') }}"></script>

@include('cms.sweetAlert2')
<?php
    $result = json_decode(session('message'));
?>
<script>
    @if (session('message'))
        Toast.fire({
        icon: '{{ $result->status }}',
        title: '{{ $result->message }}'
    })
    @endif
</script>
</body>
</html>
