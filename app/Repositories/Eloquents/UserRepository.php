<?php
namespace App\Repositories\Eloquents;

use App\Models\Hotel;
use App\Models\User;
use App\Notifications\OrderNotification;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

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

    public function notifyForPartner($partnerId, $orderId)
    {
        $data['title'] = Auth::user()->name;
        $data['content'] = Auth::user()->name .trans('partner.notify_order');
        $data['created_at'] = now()->format('d-m-y');
        $data['route'] = route('partners.order', $orderId);
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true,
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options,
        );
        $user = $this->model->findOrFail($partnerId);
        $user->notify(new OrderNotification($data, $orderId));
        $pusher->trigger('Notify', 'send-message', $data);
    }

    public function markAllAsRead($user)
    {
        $user->unreadNotifications->markAsRead();

        return redirect()->back();
    }

    public function attempt($attrs)
    {
        return Auth::attempt($attrs);
    }
}
