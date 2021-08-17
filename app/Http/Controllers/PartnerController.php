<?php

namespace App\Http\Controllers;

use App\Http\Requests\PartnerRequest;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\Hotel;
use App\Models\Image;
use App\Repositories\Contracts\BookingDetailRepositoryInterface;
use App\Repositories\Contracts\BookingRepositoryInterface;
use App\Repositories\Contracts\HotelRepositoryInterface;
use App\Repositories\Contracts\ImageRepositoryInterface;
use App\Repositories\Contracts\ProvinceRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PartnerController extends Controller
{
    protected $userRepository;
    protected $provinceRepository;
    protected $hotelRepository;
    protected $imageRepository;
    protected $bookingRepository;
    protected $bookingDetailRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        ProvinceRepositoryInterface $provinceRepository,
        HotelRepositoryInterface $hotelRepository,
        ImageRepositoryInterface $imageRepository,
        BookingRepositoryInterface $bookingRepository,
        BookingDetailRepositoryInterface $bookingDetailRepository
    ) {
        $this->userRepository = $userRepository;
        $this->provinceRepository = $provinceRepository;
        $this->hotelRepository = $hotelRepository;
        $this->imageRepository = $imageRepository;
        $this->bookingRepository = $bookingRepository;
        $this->bookingDetailRepository = $bookingDetailRepository;
    }

    public function index()
    {
        $hotels = $this->userRepository->getHotelForPartner();

        return view('cms.pages.partner.index', compact('hotels'));
    }

    public function create()
    {
        $provinces = $this->provinceRepository->getAll();

        return view('cms.pages.partner.create', compact('provinces'));
    }

    public function store(PartnerRequest $request)
    {
        $attr = $request->all();
        $attr['user_id'] = Auth::id();
        $attr['rate'] = config('user.rate_partner');
        $attr['status'] = config('user.pending_number');
        $hotel = $this->hotelRepository->create($attr);
        // add images
        $images = $request->images;
        $images_insert = array();
        foreach ($images as $img) {
            $image = array();
            $image['imageable_type'] = config('user.type_hotel');
            $image['imageable_id'] = $hotel->id;
            $image['image'] = $img;
            $image['created_at'] = Carbon::now();
            $image['updated_at'] = Carbon::now();
            array_push($images_insert, $image);
        }
        $this->imageRepository->insert($images_insert);

        return redirect()->route('partners.hotels.index')->with('message', __('add_success'));
    }

    public function upload(Request $request, $id)
    {
        $attrs['status'] = $request->status;
        $this->bookingRepository->update($id, $attrs);

        return redirect()->route('partners.order')->with('message', __('approve_success'));
    }

    public function deny(Request $request, $id)
    {
        $attrs['status'] = $request->status;
        $order = $this->bookingRepository->update($id, $attrs);
        $this->bookingDetailRepository->handelRoomForPartner($order, $request->status);

        return redirect()->route('partners.order')->with('message', __('deny_success'));
    }

    public function checkOut(Request $request, $id)
    {
        $attrs['status'] = $request->status;
        $order = $this->bookingRepository->update($id, $attrs);

        $this->bookingDetailRepository->handelRoomForPartner($order, $request->status);

        return redirect()->route('partners.order')->with('message', __('paid_success'));
    }
}
