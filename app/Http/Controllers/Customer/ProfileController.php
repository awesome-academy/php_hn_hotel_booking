<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\BookingRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $bookingRepository;

    public function __construct(
        BookingRepositoryInterface $bookingRepository
    ) {
        $this->bookingRepository = $bookingRepository;
    }

    public function index()
    {
        $condition['where'][] = [
            'user_id', '=', Auth::id(),
        ];
        $orders = $this->bookingRepository->all(['*'], $condition, ['hotel']);

        return view('customer.pages.profile', compact('orders'));
    }

    public function comment($id)
    {
        return view('customer.pages.comment', compact('id'));
    }

    public function postComment(Request $request, $id)
    {
        $booking = $this->bookingRepository->findOrFail($id);
        $attrs['rate'] = $request->rating;
        $this->bookingRepository->update($id, $attrs);

        return redirect()->route('customer.profile')->with('message', __('comment_success'));
    }
}
