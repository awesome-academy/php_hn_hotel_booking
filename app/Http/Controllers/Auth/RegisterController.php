<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Role;
use App\Models\User;

class RegisterController extends Controller
{
    public function register()
    {
        return view('cms.register');
    }

    public function handelRegister(RegisterRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = config('user.partner');
        $user->save();

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
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = config('user.customer');
        $user->phone_number = $request->phoneNumber;
        $user->save();

        $message = [
            'message' => __('register_success'),
            'status' => 'success',
        ];

        return redirect()->route('auth.customer.login')->with('message', json_encode($message));
    }
}
