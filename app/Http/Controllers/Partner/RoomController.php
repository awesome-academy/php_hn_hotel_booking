<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomRequest;
use App\Repositories\Contracts\BookingRepositoryInterface;
use App\Repositories\Contracts\HotelRepositoryInterface;
use App\Repositories\Contracts\ImageRepositoryInterface;
use App\Repositories\Contracts\RoomRepositoryInterface;
use App\Repositories\Contracts\TypeRepositoryInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    protected $roomRepository;
    protected $hotelRepository;
    protected $typeRepository;
    protected $imageRepository;
    protected $bookingRepository;

    public function __construct(
        RoomRepositoryInterface $roomRepository,
        HotelRepositoryInterface $hotelRepository,
        TypeRepositoryInterface $typeRepository,
        ImageRepositoryInterface $imageRepository,
        BookingRepositoryInterface $bookingRepository
    ) {
        $this->roomRepository = $roomRepository;
        $this->hotelRepository = $hotelRepository;
        $this->typeRepository = $typeRepository;
        $this->imageRepository = $imageRepository;
        $this->bookingRepository = $bookingRepository;
    }

    public function statisticForPartner()
    {
        //general information
        $totalRevenue = $this->bookingRepository->getTotalRevenue();
        $condition['where'] = [
            ['user_id', '=', Auth::id()]
        ];
        $numberOfHotel = $this->hotelRepository->getAllWithCondition(['*'], $condition)->count();
        $numberOfOrders = $this->bookingRepository->getTotalOrders(Auth::id());

        // statictis order per month in current year
        $orders = $this->bookingRepository->statisticOrderPerMonth();
        $data['order'] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        foreach ($orders as $order) {
            $data['order'][$order->month] = $order->orders;
        }

        // statictis revenue per month in current year
        $orders = $this->bookingRepository->statisticRevenuePerMonth();
        $data['revenue'] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        foreach ($orders as $order) {
            $data['revenue'][$order->month] = $order->totals;
        }
        $data = json_encode($data);

        return view('cms.pages.partner.dashboard', compact('data', 'totalRevenue', 'numberOfHotel', 'numberOfOrders'));
    }

    public function index()
    {
        $condition['where'][] = [
            'user_id', '=', Auth::user()->id,
        ];
        $rooms = $this->roomRepository->getAllWithCondition(['*'], $condition, ['hotel', 'type']);

        return view('cms.pages.partner.room.index', compact('rooms'));
    }

    public function create()
    {
        $condition['where'][] = [
            'user_id', '=', Auth::user()->id,
        ];
        $hotels = $this->hotelRepository->getAllWithCondition(['*'], $condition);
        $types = $this->typeRepository->getAllWithCondition(['*'], [], ['rooms']);

        return view('cms.pages.partner.room.create', compact('hotels', 'types'));
    }

    public function store(RoomRequest $request)
    {
        $attrs = $request->all();
        $attrs['user_id'] = Auth::user()->id;
        $room = $this->roomRepository->create($attrs);
        // add mutiple images
        $images = $request->images;
        $images_insert = array();
        foreach ($images as $img) {
            $image = array();
            $image['imageable_type'] = config('user.type_room');
            $image['imageable_id'] = $room->id;
            $image['image'] = $img;
            $image['created_at'] = Carbon::now();
            $image['updated_at'] = Carbon::now();
            array_push($images_insert, $image);
        }
        $this->imageRepository->insert($images_insert);

        return redirect()->route('partners.rooms.index')->with('message', __('add_success'));
    }
}
