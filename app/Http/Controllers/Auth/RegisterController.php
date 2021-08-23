<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Repositories\Contracts\UserRepositoryInterface;

class RegisterController extends Controller
{
    protected $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function register()
    {
        return view('cms.register');
    }

    public function handelRegister(RegisterRequest $request)
    {
        $this->userRepository->createUserCms($request);

        $message = [
            'message' => __('register_success'),
            'status' => 'success',
        ];

        return redirect()->route('auth.login')->with('message', json_encode($message));
    }

    public function registerCustomer()
    {
        return view('customer.pages.auth.register');
    }

    public function handelRegisterCustomer(RegisterRequest $request)
    {
        $this->userRepository->createUser($request);
        $message = [
            'message' => __('register_success'),
            'status' => 'success',
        ];

        return redirect()->route('auth.customer.login')->with('message', json_encode($message));
    }
}
