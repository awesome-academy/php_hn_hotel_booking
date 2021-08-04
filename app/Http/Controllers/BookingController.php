<?php

namespace App\Http\Controllers;

use App\Models\Hotel;

class BookingController extends Controller
{
    public function index()
    {
        $hotels = Hotel::with('images')->where('status', config('user.approved_number'))->get();

        return view('customer.pages.index', compact('hotels'));
    }
}
