<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\BookingDetailRepositoryInterface;
use App\Repositories\Contracts\BookingRepositoryInterface;
use App\Repositories\Contracts\HotelRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $hotelRepository;
    protected $bookingRepository;
    protected $bookingDetailRepository;

    public function __construct(
        HotelRepositoryInterface $hotelRepository,
        BookingRepositoryInterface $bookingRepository,
        BookingDetailRepositoryInterface $bookingDetailRepository
    ) {
        $this->hotelRepository = $hotelRepository;
        $this->bookingRepository = $bookingRepository;
        $this->bookingDetailRepository = $bookingDetailRepository;
    }

    public function index()
    {
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
        $detail = $this->bookingDetailRepository->all(['*'], $condition);

        return json_encode($detail);
    }
}
