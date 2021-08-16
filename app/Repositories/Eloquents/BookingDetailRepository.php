<?php
namespace App\Repositories\Eloquents;

use App\Models\BookingDetail;
use App\Repositories\Contracts\BookingDetailRepositoryInterface;
use App\Repositories\Contracts\BookingRepositoryInterface;

class BookingDetailRepository extends BaseRepository implements BookingDetailRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return BookingDetail::class;
    }

    public function handelRoomForPartner($order, $status)
    {
        $bookingDetails = BookingDetail::with('room')->where('booking_id', $order->id)->get();
        foreach ($bookingDetails as $detail) {
            //update quantity of room
            $room = $detail->room;
            if ($status == config('user.paid_number')) {
                $room->remaining += $detail->qty;
            } else {
                $room->remaining -= $detail->qty;
            }
            $room->save();
        }
    }
}
