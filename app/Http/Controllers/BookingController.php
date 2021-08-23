<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\HotelRepositoryInterface;
use App\Repositories\Contracts\RoomRepositoryInterface;

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
        $hotels = $this->hotelRepository->all(['*'], $condition, ['images']);
        if (!empty($hotels)) {
            return view('customer.pages.index', compact('hotels'));
        }
    }

    public function detailHotel($hotelId)
    {
        $this->getTotal($hotelId);
        $hotel = $this->hotelRepository->findOrFail($hotelId);
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
        $room = $this->roomRepository->findOrFail($id);

        return view('customer.pages.room-detail', compact('room'));
    }
}
