<?php

namespace App\Http\Controllers;

use App\Http\Requests\PartnerRequest;
use App\Models\Hotel;
use App\Models\Image;
use App\Models\Province;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PartnerController extends Controller
{
    public function index()
    {
        $hotels = Hotel::with('users', 'province')->where('user_id', Auth::id())->get();

        return view('cms.pages.partner.index', compact('hotels'));
    }

    public function create()
    {
        $provinces = Province::all();

        return view('cms.pages.partner.create', compact('provinces'));
    }

    public function store(PartnerRequest $request)
    {
        $attr = $request->all();
        $attr['user_id'] = Auth::id();
        $attr['rate'] = config('user.rate_partner');
        $attr['status'] = config('user.pending_number');
        $hotel = Hotel::create($attr);
        // add images
        $images = $request->images;
        $images_insert = array();
        foreach ($images as $img) {
            $image = array();
            $image['imageable_type'] = config('user.type_room');
            $image['imageable_id'] = $hotel->id;
            $image['image'] = $img;
            $image['created_at'] = Carbon::now();
            $image['updated_at'] = Carbon::now();
            array_push($images_insert, $image);
        }
        Image::insert($images_insert);

        return redirect()->route('partners.hotels.index')->with('message', __('add_success'));
    }
}
