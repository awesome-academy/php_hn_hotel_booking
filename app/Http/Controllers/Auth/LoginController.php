<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('cms.login');
    }

    public function handelLogin(LoginRequest $request)
    {
        $attrs = $request->except('_token');
        if (Auth::attempt($attrs)) {
            if (Auth::user()->role == config('user.admin')) {
                return  redirect()->route('admin.index')->with('message', __('login_success'));
            }

            return redirect()->route('partners.hotels.index')->with('message', __('login_success'));
        }
        $message = [
            'message' => __('login_failed'),
            'status' => 'error',
        ];

        return redirect()->route('auth.loginForm')->with('message', json_encode($message));
    }

    public function logOut()
    {
        Auth::logout();
        $message = [
            'message' => __('logout_success'),
            'status' => 'success',
        ];

        return redirect()->route('auth.loginForm')->with('message', json_encode($message));
    }

    public function loginCustomer()
    {
        return view('customer.pages.auth.login');
    }

    public function handelLoginCustomer(LoginRequest $request)
    {
        $attrs = $request->except('_token');
        if (Auth::attempt($attrs) && Auth::user()->role == config('user.customer')) {
            return  redirect()->route('booking.index')->with('message', __('login_success'));
        }
        $message = [
            'message' => __('login_failed'),
            'status' => 'error',
        ];

        return redirect()->route('auth.customer.loginForm')->with('message', json_encode($message));
    }

    public function logOutCustomer()
    {
        Auth::logout();
        $message = [
            'message' => __('logout_success'),
            'status' => 'success',
        ];

        return redirect()->route('auth.customer.loginForm')->with('message', json_encode($message));
    }
}
