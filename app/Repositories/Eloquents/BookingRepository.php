<?php
namespace App\Repositories\Eloquents;

use App\Models\Booking;
use App\Repositories\Contracts\BookingRepositoryInterface;
use App\Repositories\Contracts\HotelRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingRepository extends BaseRepository implements BookingRepositoryInterface
{
    protected $hotelRepository;
    protected $userRepository;

    public function __construct(
        HotelRepositoryInterface $hotelRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->hotelRepository = $hotelRepository;
        $this->userRepository = $userRepository;
        $this->yearStart = date('Y-m-d 23:59:59', strtotime('Jan 1'));
        $this->yearEnd = date('Y-m-d 00:00:01', strtotime('Dec 31'));
        $this->startWeek = Carbon::now()->startOfWeek()->subDay()->format('Y-m-d 20:00:00');
        $this->endWeek = Carbon::now()->endOfWeek()->format('Y-m-d 20:00:00');
        parent::__construct();
    }

    //lấy model tương ứng
    public function getModel()
    {
        return Booking::class;
    }

    public function getHotelIdOfPartner($idPartner = null)
    {
        $condition['where'][] = [
            'user_id', '=', $idPartner ?? Auth::id(),
        ];
        $hotelId = $this->hotelRepository->pluck('id', $condition);

        return $hotelId;
    }

    public function getTotalRevenue($idPartner = null)
    {
        $totalRevenues = $this->model->where('created_at', '>', $this->yearStart)
            ->where('created_at', '<', $this->yearEnd)
            ->whereIn('hotel_id', $this->getHotelIdOfPartner($idPartner))
            ->where('status', '=', config('user.paid_number'))
            ->select(DB::raw('SUM(total) as totals, DATE_FORMAT(created_at, "%y") as year'))
            ->groupBy('year')
            ->first()->totals;

        return $totalRevenues;
    }

    public function getTotalOrders($idPartner)
    {
        $totalOrders = $this->model->where('created_at', '>', $this->yearStart)
            ->where('created_at', '<', $this->yearEnd)
            ->whereIn('hotel_id', $this->getHotelIdOfPartner($idPartner))->count();

        return $totalOrders;
    }

    public function getTotalRevenueWeekly($idPartner = null)
    {
        $totalRevenues = $this->model->where('created_at', '>', $this->startWeek)
            ->where('created_at', '<', $this->endWeek)
            ->whereIn('hotel_id', $this->getHotelIdOfPartner($idPartner))
            ->where('status', '=', config('user.paid_number'))
            ->select(DB::raw('SUM(total) as totals, DATE_FORMAT(created_at, "%w") as week'))
            ->groupBy('week')->first();

        return $totalRevenues->totals ?? 0;
    }

    public function statisticOrderPerMonth()
    {
        $orders = $this->model->where('created_at', '>', $this->yearStart)
            ->where('created_at', '<', $this->yearEnd)
            ->whereIn('hotel_id', $this->getHotelIdOfPartner())
            ->where('status', '=', config('user.paid_number'))
            ->select(DB::raw('COUNT(*) as orders, DATE_FORMAT(created_at, "%c") as month'))
            ->groupBy('month')
            ->get();

        return $orders;
    }

    public function statisticRevenuePerMonth()
    {
        $orders = $this->model->where('created_at', '>', $this->yearStart)
            ->where('created_at', '<', $this->yearEnd)
            ->whereIn('hotel_id', $this->getHotelIdOfPartner())
            ->where('status', '=', config('user.paid_number'))
            ->select(DB::raw('SUM(total) as totals, DATE_FORMAT(created_at, "%c") as month'))
            ->groupBy('month')
            ->get();

        return $orders;
    }

    public function getOrderWeekly($idPartner)
    {
        $totalOrders = $this->model->where('created_at', '>', $this->startWeek)
            ->where('created_at', '<', $this->endWeek)
            ->whereIn('hotel_id', $this->getHotelIdOfPartner($idPartner))
            ->select(DB::raw('COUNT(*) as totals, DATE_FORMAT(created_at, "%w") as week'))
            ->groupBy('week')
            ->first();

        return $totalOrders->totals ?? 0;
    }

    public function showStatus($status)
    {
        switch ($status) {
            case config('user.approved_number'):
                return __('approved');
            case config('user.denied_number'):
                return __('denied');
            case config('user.pending_number'):
                return __('pending');
            case config('user.paid_number'):
                return __('paid');
        }
    }

    public function getOrderDetailWeekly($idPartner)
    {
        $orders = $this->model->where('created_at', '>', $this->startWeek)
            ->where('created_at', '<', $this->endWeek)
            ->whereIn('hotel_id', $this->getHotelIdOfPartner($idPartner))
            ->get();

        $data = [];
        foreach ($orders as $order) {
            $data[$order->id] = [
                'total' => $order->total,
                'status' => $this->showStatus($order->status),
                'customer' => $this->userRepository->findOrFail($order->user_id)->name,
                'email' => $this->userRepository->findOrFail($order->user_id)->email,
                'phone' => $this->userRepository->findOrFail($order->user_id)->phone_number,
                'hotel_id' => $this->hotelRepository->findOrFail($order->hotel_id)->name,
                'created_at' => $this->model->findOrFail($order->id)->created_at->format('d-M-Y H:i:s')
            ];
        }

        return $data;
    }

    public function getInfoOrderWeekly($idPartner)
    {
        $data['name'] = $this->userRepository->findOrFail($idPartner)->name;
        $data['revenues'] = $this->getTotalRevenueWeekly($idPartner);
        $data['orders'] = $this->getOrderWeekly($idPartner);
        $data['orderDetail'] = $this->getOrderDetailWeekly($idPartner);

        return $data;
    }
}
