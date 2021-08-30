<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\CheckoutController;
use App\Http\Requests\InfoRequest;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Room;
use App\Repositories\Contracts\BookingDetailRepositoryInterface;
use App\Repositories\Contracts\BookingRepositoryInterface;
use App\Repositories\Contracts\HotelRepositoryInterface;
use App\Repositories\Contracts\RoomRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Carbon;
use Tests\TestCase;
use Mockery as m;

class CheckoutControllerTest extends TestCase
{
    protected $hotelMock;
    protected $bookingMock;
    protected $roomMock;
    protected $userMock;
    protected $bookingDetailMock;
    protected $checkoutController;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->hotelMock = m::mock(HotelRepositoryInterface::class);
        $this->bookingMock = m::mock(BookingRepositoryInterface::class);
        $this->roomMock = m::mock(RoomRepositoryInterface::class);
        $this->userMock = m::mock(UserRepositoryInterface::class);
        $this->bookingDetailMock = m::mock(BookingDetailRepositoryInterface::class);
        $this->checkoutController = new CheckoutController(
            $this->hotelMock,
            $this->bookingMock,
            $this->roomMock,
            $this->userMock,
            $this->bookingDetailMock
        );
    }

    public function testGetInfoWithEmptyCart()
    {
        $hotelId = 1;
        $hotel = $this->hotelMock->shouldReceive('findOrFail')->with($hotelId);
        $carts = session()->get('carts');
        $result = $this->checkoutController->getInfo($hotelId);
        $data = $result->getData();
        $this->assertIsArray($data);
        $this->assertEquals('customer.pages.info', $result->getName());
    }

    public function testGetInfoWithCart()
    {
        $hotelId = 1;
        $hotel = $this->hotelMock->shouldReceive('findOrFail')->with($hotelId);
        $carts = [
            $hotelId =>[
                1 => [
                    'name' => 'Sun Asterisk',
                    'price' => 200,
                    'checkIn' => Carbon::now(),
                    'checkOut' => Carbon::now()->addDay(),
                    'qty' => 1,
                ]
            ]
        ];
        $this->withSession(['carts' => $carts]);
        $this->roomMock->shouldReceive('getFirstNameHotel');
        $result = $this->checkoutController->getInfo($hotelId);
        $data = $result->getData();
        $this->assertIsArray($data);
        $this->assertEquals('customer.pages.info', $result->getName());
    }

    public function testCheckOut()
    {
        $request = new InfoRequest();
        $hotelId = 1;
        $booking = Booking::factory()->make();
        $room = Room::factory()->make();
        $hotel = Hotel::factory()->make();
        $carts = [
            1 =>[
                1 => [
                    'name' => 'Sun Asterisk',
                    'price' => 200,
                    'checkIn' => Carbon::now(),
                    'checkOut' => Carbon::now()->addDay(),
                    'qty' => 1,
                ]
            ]
        ];
        $this->withSession(['carts' => $carts]);
        $this->userMock->shouldReceive('update');
        $this->bookingMock->shouldReceive('create')->andReturn($booking);
        $this->roomMock->shouldReceive('updateRoom');
        $this->roomMock->shouldReceive('findOrFail')->andReturn($room);
        $this->roomMock->shouldReceive('update');
        $this->hotelMock->shouldReceive('findOrFail')->andReturn($hotel);
        $this->bookingDetailMock->shouldReceive('insert');
        $this->userMock->shouldReceive('findOrFail');
        $this->userMock->shouldReceive('notifyForPartner');
        $result = $this->checkoutController->checkOut($request, $hotelId);
        $this->assertEquals(route('booking.index'), $result->getTargetUrl());
    }

    protected function tearDown(): void
    {
        m::close();
        unset($this->hotelMock);
        unset($this->bookingMock);
        unset($this->roomMock);
        unset($this->userMock);
        unset($this->bookingDetailMock);
        parent::tearDown(); // TODO: Change the autogenerated stub
    }
}