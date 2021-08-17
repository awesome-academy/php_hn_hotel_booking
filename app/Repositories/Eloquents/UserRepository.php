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
}
