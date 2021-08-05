@extends('customer.auth')

@section('content')
    <div class="login-wrap">
        <img src="{{ asset('bower_components/assets_travel/blue/images/logo.png') }}" class="login-img" alt="logo"/><br/>
        <form action="{{ route('auth.customer.login') }}" method="post">
            @csrf
            <div class="login-c1">
                <div class="cpadding50">
                    @error('email')
                    <small class="text-danger rule">{{ $message }}</small>
                    @enderror
                    <input type="email" class="form-control logpadding" name="email" value="{{ old('email',$request->email ?? null) }}" placeholder="@lang('login.email')">
                    <br/>
                    @error('password')
                    <small class="text-danger rule">{{ $message }}</small>
                    @enderror
                    <input type="password" class="form-control logpadding" name="password" value="{{ old('password',$request->password ?? null) }}" placeholder="@lang('login.password')">
                </div>
            </div>
            <div class="login-c2">
                <div class="logmargfix">
                    <div class="chpadding50">
                        <div class="alignbottom">
                            <button class="btn-search4" type="submit">@lang('login.sign_in')</button>
                        </div>
                        <div class="alignbottom2">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox">@lang('login.remember_me')
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="login-c3">
            <div class="left"><a href="#" class="whitelink"><span></span>@lang('register.website')</a></div>
            <div class="right"><a href="#" class="whitelink">@lang('register.lost_password')</a></div>
        </div>
    </div>
@endsection

@include('cms.sweetAlert2')
<?php
$result = json_decode(session('message'));
?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if (session('message'))
        Toast.fire({
            icon: '{{ $result->status }}',
            title: '{{ $result->message }}'
        })
        @endif
    });
</script>
