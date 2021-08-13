<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Room;

class BookingController extends Controller
{
    public function index()
    {
        $hotels = Hotel::with('images')->where('status', config('user.approved_number'))->get();
        if (!empty($hotels)) {
            return view('customer.pages.index', compact('hotels'));
        }
    }

    public function detailHotel($hotelId)
    {
        $this->getTotal($hotelId);
        $hotel = Hotel::findOrFail($hotelId);
        $rooms = $hotel->rooms;
        $images = $hotel->images;
        $image = $images->first()->image;
        //handel cart
        $carts = session()->get('carts');
        if (!empty($carts[$hotelId])) {
            $key = array_keys($carts[$hotelId]);
            //get one booking
            $cart = array_pop($carts[$hotelId]);

            return view('customer.pages.detail', compact('cart', 'images', 'rooms', 'image', 'hotel'));
        }

        return view('customer.pages.detail', compact('images', 'rooms', 'image', 'hotel'));
    }

    //get session total price
    public function getTotal($hotelId)
    {
        $carts = session()->get('carts');
        $total = 0;
        if (isset($carts[$hotelId])) {
            foreach ($carts[$hotelId] as $cart) {
                $day = $cart['checkOut']->diffInDays($cart['checkIn']);
                $subTotal = $day * $cart['qty'] * $cart['price'];
                $total += $subTotal;
            }
            session()->put('total', $total);
        }
    }

    public function roomDetail($id)
    {
        $room = Room::findOrFail($id);

        return view('customer.pages.room-detail', compact('room'));
    }
}
