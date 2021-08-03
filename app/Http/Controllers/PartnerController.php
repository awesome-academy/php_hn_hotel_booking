<?php

namespace App\Http\Controllers;

use App\Http\Requests\PartnerRequest;
use App\Models\Hotel;
use App\Models\Image;
use App\Models\Province;
use Illuminate\Support\Facades\Auth;

class PartnerController extends Controller
{
    public function index()
    {
        $hotels = Hotel::with('users')->where('user_id', Auth::id())->get();

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
        $attr['status'] = config('user.pending');
        $hotel = Hotel::create($attr);
        // add images
        $images = $request->images;
        foreach ($images as $img) {
            $image = array();
            $image['imageable_type'] = config('user.type_hotel');
            $image['imageable_id'] = $hotel->id;
            $image['image'] = $img;
            Image::create($image);
        }

        $message = [
            'message' => __('add_success'),
            'status' => 'success',
        ];

        return redirect()->route('partner.index')->with('message', json_encode($message));
    }
}
