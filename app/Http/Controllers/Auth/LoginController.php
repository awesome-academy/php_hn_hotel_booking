<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login()
    {
        return view('cms.login');
    }

    public function handelLogin(LoginRequest $request)
    {
        $attrs = $request->except('_token');
        if ($this->userRepository->attempt($attrs)) {
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
        if ($this->userRepository->attempt($attrs) && Auth::user()->role == config('user.customer')) {
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
