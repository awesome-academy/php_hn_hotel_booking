<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\HotelRepositoryInterface;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $hotelRepository;
    public function __construct(
        HotelRepositoryInterface $hotelRepository
    ) {
        $this->hotelRepository = $hotelRepository;
    }

    public function index()
    {
        $hotels = $this->hotelRepository->paginateList(config('user.number_of_hotel'), [], ['province']);

        return view('cms.pages.admin.index', compact('hotels'));
    }

    public function upload(Request $request)
    {
        $hotel = $this->hotelRepository->find($request->id);
        if (!empty($hotel)) {
            $attrs['status'] = $request->status;
            $this->hotelRepository->update($request->id, $attrs);

            return redirect()->route('admin.index')->with('message', __('approve_success'));
        }

        return redirect()->route('admin.index')->with('message', __('approve_failed'));
    }

    public function deny(Request $request)
    {
        $hotel = $this->hotelRepository->find($request->id);
        if (!empty($hotel)) {
            $attrs['status'] = $request->status;
            $this->hotelRepository->update($request->id, $attrs);

            return redirect()->route('admin.index')->with('message', __('deny_success'));
        }

        return redirect()->route('admin.index')->with('message', __('deny_failed'));
    }
}
