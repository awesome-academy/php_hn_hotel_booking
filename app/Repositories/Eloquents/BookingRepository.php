<?php
namespace App\Repositories\Eloquents;

use App\Models\Booking;
use App\Repositories\Contracts\BookingRepositoryInterface;
use Illuminate\Support\Facades\DB;

class BookingRepository extends BaseRepository implements BookingRepositoryInterface
{
    public function __construct()
    {
        $this->yearStart = date('Y-m-d 23:59:59', strtotime('Jan 1'));
        $this->yearEnd = date('Y-m-d 00:00:01', strtotime('Dec 31'));
        parent::__construct();
    }

    //lấy model tương ứng
    public function getModel()
    {
        return Booking::class;
    }

    public function getTotalRevenue()
    {
        $totalRevenues = $this->model->where('created_at', '>', $this->yearStart)
            ->where('created_at', '<', $this->yearEnd)
            ->select(DB::raw('SUM(total) as totals, DATE_FORMAT(created_at, "%y") as year'))
            ->groupBy('year')
            ->first()->totals;

        return $totalRevenues;
    }

    public function statisticOrderPerMonth()
    {
        $orders = $this->model->where('created_at', '>', $this->yearStart)
            ->where('created_at', '<', $this->yearEnd)
            ->select(DB::raw('COUNT(*) as orders, DATE_FORMAT(created_at, "%c") as month'))
            ->groupBy('month')
            ->get();

        return $orders;
    }

    public function statisticRevenuePerMonth()
    {
        $orders = $this->model->where('created_at', '>', $this->yearStart)
            ->where('created_at', '<', $this->yearEnd)
            ->select(DB::raw('SUM(total) as totals, DATE_FORMAT(created_at, "%c") as month'))
            ->groupBy('month')
            ->get();

        return $orders;
    }
}
