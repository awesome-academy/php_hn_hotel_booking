<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\BookingDetailRepositoryInterface;
use App\Repositories\Contracts\BookingRepositoryInterface;
use App\Repositories\Contracts\HotelRepositoryInterface;
use App\Repositories\Contracts\NotificationRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $hotelRepository;
    protected $bookingRepository;
    protected $bookingDetailRepository;
    protected $notificationRepository;
    protected $userRepository;

    public function __construct(
        HotelRepositoryInterface $hotelRepository,
        BookingRepositoryInterface $bookingRepository,
        BookingDetailRepositoryInterface $bookingDetailRepository,
        NotificationRepositoryInterface $notificationRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->hotelRepository = $hotelRepository;
        $this->bookingRepository = $bookingRepository;
        $this->bookingDetailRepository = $bookingDetailRepository;
        $this->notificationRepository = $notificationRepository;
        $this->userRepository = $userRepository;
    }

    public function index($order = null)
    {
        if (!empty($order)) {
            $condition['where'][] = [
                'order_id', '=', $order,
            ];
            $notify =  $this->notificationRepository->getAllWithCondition(['*'], $condition, [], [], 'first');
            $this->notificationRepository->update($notify->id, ['read_at' => now()]);
        }
        $conditions['where'][] = [
            'user_id', '=', Auth::id(),
        ];
        $hotelsId = $this->hotelRepository->pluck('id', $conditions);
        unset($conditions);
        $conditions['whereIn']['hotel_id'] = $hotelsId;
        $orders = $this->bookingRepository->paginateList(config('user.paginate_order'), $conditions, ['hotel', 'user']);

        return view('cms.pages.partner.order.index', compact('orders'));
    }

    public function detail(Request $request)
    {
        $condition['where'][] = [
            'booking_id', '=', $request->id
        ];
        $detail = $this->bookingDetailRepository->getAllWithCondition(['*'], $condition);

        return json_encode($detail);
    }

    public function markAllAsRead()
    {
        $this->userRepository->markAllAsRead(Auth::user());

        return redirect()->back();
    }
}
