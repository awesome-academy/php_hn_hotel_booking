<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $hotelsId = Hotel::where('user_id', Auth::id())->pluck('id')->toArray();
        $orders = Booking::whereIn('hotel_id', $hotelsId)->with(['hotel', 'user'])
            ->paginate(config('user.paginate_order'));

        return view('cms.pages.partner.order.index', compact('orders'));
    }

    public function detail(Request $request)
    {
        $detail = BookingDetail::where('booking_id', $request->id)->get();

        return json_encode($detail);
    }
}
