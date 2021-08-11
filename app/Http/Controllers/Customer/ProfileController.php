<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $orders = Booking::with('hotel')->where('user_id', Auth::id())->get();

        return view('customer.pages.profile', compact('orders'));
    }

    public function comment($id)
    {
        return view('customer.pages.comment', compact('id'));
    }

    public function postComment(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->rate = $request->rating;
        $booking->save();

        return redirect()->route('customer.profile')->with('message', __('comment_success'));
    }
}
