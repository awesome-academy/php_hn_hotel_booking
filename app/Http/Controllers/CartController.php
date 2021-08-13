<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $roomId = $request->roomId;
        $hotelId = $request->hotelId;
        $room = Room::findOrFail($roomId);
        $carts = session()->get('carts');
        if (!$carts) {
            $carts[$hotelId] = [
                $roomId => [
                    'name' => $room->type->name,
                    'price' => $room->price,
                    'checkIn' => (session('checkIn')) ? session('checkIn') : Carbon::now(),
                    'checkOut' => (session('checkOut')) ? session('checkOut') : Carbon::now()->addDay(),
                    'qty' => 1,
                ]
            ];
            $data['message'] =  __('add_success');
            session()->put('carts', $carts);
            $this->setTotal($hotelId);
        }

        if (isset($carts[$hotelId][$roomId])) {
            $data =  $this->updateCart($carts, $roomId, $hotelId);
        } else {
            $carts[$hotelId][$roomId] = [
                'name' => $room->type->name,
                'price' => $room->price,
                'checkIn' => (session('checkIn')) ? session('checkIn') : Carbon::now(),
                'checkOut' => (session('checkIn')) ? session('checkOut') : Carbon::now()->addDay(),
                'qty' => 1,
            ];
            session()->put('carts', $carts);
            $this->setTotal($hotelId);
            $data['message'] =  __('add_success');
        }
        $data['carts'] = $this->handeCart(session('carts')[$hotelId], $hotelId);
        $data['total'] = session('total');

        return json_encode($data);
    }

    public function updateCart($carts, $roomId, $hotelId)
    {
        $remainRoom = Room::findOrFail($roomId)->remaining;
        if ($remainRoom > $carts[$hotelId][$roomId]['qty']) {
            $carts[$hotelId][$roomId]['qty']++;
            session()->put('carts', $carts);
            $this->setTotal($hotelId);
            $data['message'] =  __('add_success');
        } else {
            $data['message'] =  __('over_limit_room');
        }

        return  $data;
    }

    public function removeRoom(Request $request)
    {
        $roomId = $request->roomId;
        $hotelId = $request->hotelId;
        $room = Room::findOrFail($roomId);
        $carts = session()->get('carts');
        if (isset($carts[$hotelId][$roomId])) {
            unset($carts[$hotelId][$roomId]);
            session()->put('carts', $carts);
            $this->setTotal($hotelId);
            $data = [
                'message' => __('remove_success'),
                'carts' => session('carts'),
                'total' => session('total'),
            ];

            return json_encode($data);
        }
    }

    public function handeCart($carts, $hotelId)
    {
        $data['hotelName'] = Hotel::find($hotelId)->name;
        //get one room of carts
        $cart = array_pop($carts);
        $data['checkIn'] = $cart['checkIn']->format('d/m/Y');
        $data['checkOut'] = $cart['checkOut']->format('d/m/Y');
        $data['avg_night'] = $cart['checkOut']->diffInDays($cart['checkIn']);
        $data[$hotelId] = session('carts')[$hotelId];

        return $data;
    }

    public function subRoom(Request $request)
    {
        $roomId = $request->roomId;
        $hotelId = $request->hotelId;
        $carts = session()->get('carts');
        if (isset($carts[$hotelId][$roomId]['qty']) && $carts[$hotelId][$roomId]['qty'] > 1) {
            $carts[$hotelId][$roomId]['qty']--;
        } else {
            unset($carts[$hotelId][$roomId]);
        }
        session()->put('carts', $carts);
        $this->setTotal($hotelId);
        if (empty(session('carts')[$hotelId])) {
            $data['carts'] = session('carts');
        } else {
            $data['carts'] = $this->handeCart(session('carts')[$hotelId], $hotelId);
        }
        $data['message'] = __('remove_success');
        $data['total'] = session('total');

        return json_encode($data);
    }

    public function setTotal($hotelId)
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
}
