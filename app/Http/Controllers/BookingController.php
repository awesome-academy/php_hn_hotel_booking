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

    public function detailHotel($id)
    {
        $hotel = Hotel::findOrFail($id);
        $rooms = $hotel->rooms;
        $images = $hotel->images;
        $image = $hotel->images->first()->image;

        return view('customer.pages.detail', compact('rooms', 'image', 'images'));
    }

    public function roomDetail($id)
    {
        $room = Room::findOrFail($id);

        return view('customer.pages.room-detail', compact('room'));
    }
}
