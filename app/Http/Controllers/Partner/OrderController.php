<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\BookingDetailRepositoryInterface;
use App\Repositories\Contracts\BookingRepositoryInterface;
use App\Repositories\Contracts\HotelRepositoryInterface;
use App\Repositories\Contracts\NotificationRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $hotelRepository;
    protected $bookingRepository;
    protected $bookingDetailRepository;
    protected $notificationRepository;

    public function __construct(
        HotelRepositoryInterface $hotelRepository,
        BookingRepositoryInterface $bookingRepository,
        BookingDetailRepositoryInterface $bookingDetailRepository,
        NotificationRepositoryInterface $notificationRepository
    ) {
        $this->hotelRepository = $hotelRepository;
        $this->bookingRepository = $bookingRepository;
        $this->bookingDetailRepository = $bookingDetailRepository;
        $this->notificationRepository = $notificationRepository;
    }

    public function index($order = null)
    {
        if (!empty($order)) {
            $condition['where'][] = [
                'order_id', '=', $order,
            ];
            $this->notificationRepository->getAllWithCondition(['*'], $condition)
                ->first()->update(['read_at' => now()]);
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
        Auth::user()->unreadNotifications->markAsRead();

        return redirect()->back();
    }
}
