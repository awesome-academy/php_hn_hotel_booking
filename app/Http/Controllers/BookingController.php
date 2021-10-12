<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\HotelRepositoryInterface;
use App\Repositories\Contracts\RoomRepositoryInterface;
use App\Models\BookingDetail;
use App\Models\Room;
use App\Models\Province;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    protected $hotelRepository;
    protected $roomRepository;

    public function __construct(
        HotelRepositoryInterface $hotelRepository,
        RoomRepositoryInterface $roomRepository
    ) {
        $this->hotelRepository = $hotelRepository;
        $this->roomRepository = $roomRepository;
    }

    public function index()
    {
        $condition['where'][] = [
            'status', '=', config('user.approved_number'),
        ];
        $hotels = $this->hotelRepository->getAllWithCondition(['*'], $condition, ['images']);
        $provinces = Province::all();

        return view('customer.pages.index', compact('hotels', 'provinces'));
    }

    public function detailHotel($hotelId)
    {
        $this->getTotal($hotelId);
        $hotel = $this->hotelRepository->findOrFail($hotelId);
        $rooms = $hotel->rooms;
        $images = $hotel->images;
        $image = $images[0]->image;
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
        $room = $this->roomRepository->findOrFail($id);

        return view('customer.pages.room-detail', compact('room'));
        $provinces = Province::all();

        return view('customer.pages.index', compact('hotels', 'provinces'));
    }

    public function saveTimeCheckInOut($checkIn, $checkOut)
    {
        if (isset($checkIn) && isset($checkOut)) {
            session()->put('checkIn', Carbon::parse($checkIn));
            session()->put('checkOut', Carbon::parse($checkOut));
        }
    }

    public function search(Request $request)
    {
        if ($request->checkOut > $request->checkIn && Carbon::parse($request->checkIn)->diffInDays(now()) >= 0) {
            //set session for checkIn, checkOut
            $this->saveTimeCheckInOut($request->checkIn, $request->checkOut);
            //set virtual room = actual room
            $rooms = Room::where('id', '>', 0)->update([
                'virtual_room' => DB::raw('remaining')
            ]);
            //handle virtual room
            $booking_details = BookingDetail::with('room')->get();
            foreach ($booking_details as $detail) {
                if ($detail->checkOut < $request->checkIn) {
                    $room = Room::find($detail->room_id);
                    $room->virtual_room += $detail->qty;
                    $room->save();
                }
            }
            $hotels = DB::table('hotels')
                ->where('hotels.province_id', '=', $request->province)
                ->join('rooms', function ($join) use ($request) {
                    $join->on('hotels.id', '=', 'rooms.hotel_id')
                        ->where('rooms.virtual_room', '>', $request->room);
                })
                ->join('types', function ($join) use ($request) {
                    $join->on('types.id', '=', 'rooms.type_id')
                        ->where('types.number_of_guest', '>=', $request->adult);
                })->get();
            $provinces = Province::all();
            return view('customer.pages.search', compact('hotels', 'provinces', 'request'));
        }
        return redirect()->back()->with('message', trans('customer.not_found_hotel'));
    }
}
