<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomRequest;
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

    public function __construct(
        RoomRepositoryInterface $roomRepository,
        HotelRepositoryInterface $hotelRepository,
        TypeRepositoryInterface $typeRepository,
        ImageRepositoryInterface $imageRepository
    ) {
        $this->roomRepository = $roomRepository;
        $this->hotelRepository = $hotelRepository;
        $this->typeRepository = $typeRepository;
        $this->imageRepository = $imageRepository;
    }

    public function index()
    {
        $condition['where'][] = [
            'user_id', '=', Auth::user()->id,
        ];
        $rooms = $this->roomRepository->all(['*'], $condition, ['hotel', 'type']);

        return view('cms.pages.partner.room.index', compact('rooms'));
    }

    public function create()
    {
        $condition['where'][] = [
            'user_id', '=', Auth::user()->id,
        ];
        $hotels = $this->hotelRepository->all(['*'], $condition);
        $types = $this->typeRepository->all(['*'], [], ['rooms']);

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
