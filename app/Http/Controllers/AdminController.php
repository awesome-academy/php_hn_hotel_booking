<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $hotels = Hotel::with('province')->paginate(config('user.number_of_hotel'));

        return view('cms.pages.admin.index', compact('hotels'));
    }

    public function upload(Request $request)
    {
        $hotel = Hotel::find($request->id);
        if (!empty($hotel)) {
            $hotel->status = $request->status;
            $hotel->save();

            return redirect()->route('admin.index')->with('message', __('approve_success'));
        }

        return redirect()->route('admin.index')->with('message', __('approve_failed'));
    }

    public function deny(Request $request)
    {
        $hotel = Hotel::find($request->id);
        if (!empty($hotel)) {
            $hotel->status = $request->status;
            $hotel->save();

            return redirect()->route('admin.index')->with('message', __('deny_success'));
        }

        return redirect()->route('admin.index')->with('message', __('deny_failed'));
    }
}
