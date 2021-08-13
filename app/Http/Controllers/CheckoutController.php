<?php

namespace App\Http\Controllers;

use App\Http\Requests\InfoRequest;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function getInfo($hotelId)
    {
        $hotel = Hotel::findOrFail($hotelId);
        $carts = session()->get('carts');
        $total = 0;
        if (isset($carts[$hotelId])) {
            foreach ($carts[$hotelId] as $cart) {
                $day = $cart['checkOut']->diffInDays($cart['checkIn']);
                $subTotal = $day * $cart['qty'] * $cart['price'];
                $total += $subTotal;
            }
            session()->put('total', $total);

            //show cart in right
            $key = array_keys($carts[$hotelId]);
            //get one booking
            $cart = array_pop($carts[$hotelId]);
            //get name of hotel
            $hotelName = Room::whereIn('id', $key)->first()->hotel->name;

            return view('customer.pages.info', compact('cart', 'hotelName', 'hotel'));
        }

        return view('customer.pages.info', compact('hotel'));
    }

    public function checkOut(InfoRequest $request, $hotelId)
    {
        //update phoneNumber for user
        $user = Auth::user();
        $user->phone_number = $request->phone_number;
        $user->save();

        //handel cart
        $carts = session('carts');
        if (isset($carts[$hotelId])) {
            $booking = array();
            $booking['hotel_id'] = $hotelId;
            $booking['user_id'] = Auth::id();
            $booking['total'] = session('total');
            $booking['status'] = config('user.pending_number');
            $bookingId = Booking::create($booking)->id;

            $details_booking = array();
            foreach ($carts[$hotelId] as $key => $cart) {
                $detail['room_id'] = $key;
                $detail['booking_id'] = $bookingId;
                $detail['qty'] = $cart['qty'];
                $detail['price'] = $cart['price'];
                $detail['checkIn'] = $cart['checkIn'];
                $detail['checkOut'] = $cart['checkOut'];
                $detail['status'] = config('user.pending_number');
                array_push($details_booking, $detail);
                $this->updateRoom($cart['qty'], $key);
            }
            BookingDetail::insert($details_booking);
            unset($carts[$hotelId]);
            session()->put('carts', $carts);
            session()->forget('total');
        }

        return redirect()->route('booking.index')->with('message', __('checkout_success'));
    }

    public function updateRoom($qty, $id)
    {
        $room = Room::findOrFail($id);
        if ($room->remaining >= $qty) {
            $room->remaining -= $qty;
            $room->save();
        }
    }
}
