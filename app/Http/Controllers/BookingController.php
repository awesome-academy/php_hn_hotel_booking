<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Room;

class BookingController extends Controller
{
    public function index()
    {
        $hotels = Hotel::with('images')->where('status', config('user.approved_number'))->get();

        return view('customer.pages.index', compact('hotels'));
    }

    public function detailHotel($id)
    {
        $hotel = Hotel::findOrFail($id);
        $rooms = Room::with(['images', 'type'])->where('hotel_id', $id)->get();
        $images = $hotel->images;

        return view('customer.pages.detail', compact('rooms', 'images'));
    }
}
