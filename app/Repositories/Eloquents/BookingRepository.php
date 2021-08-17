<?php
namespace App\Repositories\Eloquents;

use App\Models\Booking;
use App\Models\Province;
use App\Repositories\Contracts\BookingRepositoryInterface;

class BookingRepository extends BaseRepository implements BookingRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return Booking::class;
    }
}
