<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@lang('register.booking') | @lang('register.register')</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/all.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('bower_components/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('bower_components/adminlte3/assets_adminlte3/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition register-page">
<div class="register-box">
    <div class="register-logo">
        <b>@lang('register.cms_booking')</b>
    </div>
    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">@lang('register.partner')</p>
            <form action="{{ route('auth.register') }}" method="post">
                @csrf
                @error('name')
                <small class="text-danger rule">{{ $message }}</small>
                @enderror
                <div class="input-group mb-3">
                    <input type="text" name="name" class="form-control" value="{{ old('name',$request->name ?? null) }}" placeholder="@lang('register.name')">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                @error('email')
                <small class="text-danger rule">{{ $message }}</small>
                @enderror
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" value="{{ old('email',$request->email ?? null) }}" placeholder="@lang('register.email')">
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
                    <input type="password" name="password" class="form-control" value="{{ old('password',$request->password ?? null) }}" placeholder="@lang('register.password')">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                @error('password')
                <small class="text-danger rule">{{ $message }}</small>
                @enderror
                <div class="input-group mb-3">
                    <input type="password" name="password_confirmation" class="form-control" value="{{ old('password',$request->password ?? null) }}" placeholder="@lang('register.confirm')">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="container">
                        <button type="submit" class="btn btn-primary btn-block">@lang('register.register')</button>
                    </div>
                </div>
            </form>

            <div class="social-auth-links text-center">
                <p>- @lang('register.or') -</p>
                <a href="#" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i>
                    @lang('register.facebook')
                </a>
                <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i>
                    @lang('register.google')
                </a>
            </div>

            <a href="{{ asset('auth.registerForm') }}" class="text-center">@lang('register.have_account')</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('bower_components/adminlte3/assets_adminlte3/dist/js/adminlte.js') }}"></script>

<script src="{{ asset('js/app.js') }}"></script>

@yield('js')
</body>
</html>
