<?php

namespace App\Http\Controllers;

use App\Http\Requests\InfoRequest;
use App\Notifications\OrderNotification;
use App\Repositories\Contracts\BookingDetailRepositoryInterface;
use App\Repositories\Contracts\BookingRepositoryInterface;
use App\Repositories\Contracts\HotelRepositoryInterface;
use App\Repositories\Contracts\RoomRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class CheckoutController extends Controller
{
    protected $hotelRepository;
    protected $bookingRepository;
    protected $roomRepository;
    protected $userRepository;
    protected $bookingDetailRepository;

    public function __construct(
        HotelRepositoryInterface $hotelRepository,
        BookingRepositoryInterface $bookingRepository,
        RoomRepositoryInterface $roomRepository,
        UserRepositoryInterface $userRepository,
        BookingDetailRepositoryInterface $bookingDetailRepository
    ) {
        $this->hotelRepository = $hotelRepository;
        $this->bookingRepository = $bookingRepository;
        $this->roomRepository = $roomRepository;
        $this->userRepository = $userRepository;
        $this->bookingDetailRepository = $bookingDetailRepository;
    }

    public function getInfo($hotelId)
    {
        $hotel = $this->hotelRepository->findOrFail($hotelId);
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
            $hotelName = $this->roomRepository->getFirstNameHotel($key);

            return view('customer.pages.info', compact('cart', 'hotelName', 'hotel'));
        }

        return view('customer.pages.info', compact('hotel'));
    }

    public function checkOut(InfoRequest $request, $hotelId)
    {
        //update phoneNumber for user
        $user = Auth::user();
        $bookingId = null;
        $attrs['phone_number'] = $request->phone_number;
        $this->userRepository->update(Auth::id(), $attrs);
        //handel cart
        $carts = session('carts');
        if (isset($carts[$hotelId])) {
            $booking = array();
            $booking['hotel_id'] = $hotelId;
            $booking['user_id'] = Auth::id();
            $booking['total'] = session('total');
            $booking['status'] = config('user.pending_number');
            $bookingId = $this->bookingRepository->create($booking)->id;

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
            $this->bookingDetailRepository->insert($details_booking);
            unset($carts[$hotelId]);
            session()->put('carts', $carts);
            session()->forget('total');
        }
        $partnerId = $this->hotelRepository->findOrFail($hotelId)->user_id;
        $this->notifyForPartner($partnerId, $bookingId);

        return redirect()->route('booking.index')->with('message', __('checkout_success'));
    }

    public function notifyForPartner($partnerId, $orderId)
    {
        $data['title'] = Auth::user()->name;
        $data['content'] = Auth::user()->name .trans('partner.notify_order');
        $data['created_at'] = now()->format('d-m-y');
        $data['route'] = route('partners.order', $orderId);
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true,
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options,
        );
        $user = $this->userRepository->findOrFail($partnerId);
        $user->notify(new OrderNotification($data, $orderId));
        $pusher->trigger('Notify', 'send-message', $data);
    }

    public function updateRoom($qty, $id)
    {
        $room = $this->roomRepository->findOrFail($id);
        if ($room->remaining >= $qty) {
            $room->remaining -= $qty;
            $attrs['remaining'] = $room->remaining;
            $this->roomRepository->update($id, $attrs);
        }
    }
}
