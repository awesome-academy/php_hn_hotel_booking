<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomRequest;
use App\Models\Hotel;
use App\Models\Image;
use App\Models\Room;
use App\Models\Type;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with(['hotel', 'type'])->where('user_id', Auth::user()->id)->get();

        return view('cms.pages.partner.room.index', compact('rooms'));
    }

    public function create()
    {
        $hotels = Hotel::where('user_id', Auth::user()->id)->get();
        $types = Type::with('rooms')->get();

        return view('cms.pages.partner.room.create', compact('hotels', 'types'));
    }

    public function store(RoomRequest $request)
    {
        $attrs = $request->all();
        $attrs['user_id'] = Auth::user()->id;
        $room = Room::create($attrs);
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
        Image::insert($images_insert);

        return redirect()->route('partners.rooms.index')->with('message', __('add_success'));
    }
}
