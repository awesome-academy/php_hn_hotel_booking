@extends('customer.auth')

@section('content')
    <div class="login-wrap custom">
        <img src="{{ asset('bower_components/assets_travel/blue/images/logo.png') }}" class="login-img"
             alt="logo"/><br/>
        <form action="{{ route('auth.customer.register') }}" method="post">
            @csrf
            <div class="login-c1 custom">
                <div class="cpadding50">
                    @error('name')
                    <small class="text-danger rule">{{ $message }}</small>
                    @enderror
                    <input type="text" class="form-control logpadding" name="name" value="{{ old('name',$request->name ?? null) }}" placeholder="@lang('register.name')">
                    @error('password')
                    <small class="text-danger rule">{{ $message }}</small>
                    @enderror
                    <br/>
                    <input type="password" class="form-control logpadding" name="password" value="{{ old('password',$request->password ?? null) }}" placeholder="@lang('register.password')">
                    @error('password')
                    <small class="text-danger rule">{{ $message }}</small>
                    @enderror
                    <br>
                    <input type="password" class="form-control logpadding" name="password_confirmation"
                           value="{{ old('password_confirmation',$request->password ?? null) }}" placeholder="@lang('register.confirm')">
                    @error('email')
                    <small class="text-danger rule">{{ $message }}</small>
                    @enderror
                    <br>
                    <input type="email" class="form-control logpadding" name="email" value="{{ old('email',$request->email ?? null) }}" placeholder="@lang('register.email')">
                    @error('phoneNumber')
                    <small class="text-danger rule">{{ $message }}</small>
                    @enderror
                    <br>
                    <input type="text" class="form-control logpadding" name="phoneNumber" value="{{ old('email',$request->phoneNumber ?? null) }}" placeholder="{{ __('phone_number') }}">
                </div>
            </div>
            <div class="login-c2 custom center">
                <div class="align-bottom">
                    <button class="btn-search4" type="submit">@lang('register.register')</button>
                </div>
            </div>
        </form>
        <div class="login-c3 custom">
            <div class="left"><a href="#" class="whitelink"><span></span>@lang('register.website')</a></div>
            <div class="right"><a href="{{ route('auth.customer.loginForm') }}" class="whitelink">@lang('register.login_now')</a></div>
        </div>
    </div>
@endsection
