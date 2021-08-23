<?php
namespace App\Repositories\Eloquents;

use App\Models\Hotel;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return User::class;
    }

    public function getUser()
    {
        return $this->model->select('email')->take(config('user.number_of_user'))->get();
    }

    //partner

    public function getHotelForPartner()
    {
        $hotels = Hotel::with('users', 'province')->where('user_id', Auth::id())->get();

        return $hotels;
    }

    public function createUserCms($request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = config('user.partner');
        $user->save();
    }

    public function createUser($request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = config('user.customer');
        $user->phone_number = $request->phoneNumber;
        $user->save();
    }
}
