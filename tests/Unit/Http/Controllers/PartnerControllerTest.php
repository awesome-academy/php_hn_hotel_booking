<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\PartnerController;
use App\Http\Requests\PartnerRequest;
use App\Models\Booking;
use App\Models\Hotel;
use App\Repositories\Contracts\BookingDetailRepositoryInterface;
use App\Repositories\Contracts\BookingRepositoryInterface;
use App\Repositories\Contracts\HotelRepositoryInterface;
use App\Repositories\Contracts\ImageRepositoryInterface;
use App\Repositories\Contracts\ProvinceRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Tests\TestCase;
use Mockery as m;
use Illuminate\Foundation\Testing\WithFaker;

class PartnerControllerTest extends TestCase
{
    use WithFaker;
    protected $userMock;
    protected $provinceMock;
    protected $hotelMock;
    protected $imageMock;
    protected $bookingMock;
    protected $bookingDetailMock;
    protected $partnerController;

    public function setUp(): void
    {
        parent::setUp();
        $this->userMock = m::mock(UserRepositoryInterface::class);
        $this->provinceMock = m::mock(ProvinceRepositoryInterface::class);
        $this->hotelMock = m::mock(HotelRepositoryInterface::class);
        $this->imageMock = m::mock(ImageRepositoryInterface::class);
        $this->bookingMock = m::mock(BookingRepositoryInterface::class);
        $this->bookingDetailMock = m::mock(BookingDetailRepositoryInterface::class);

        $this->partnerController = new PartnerController(
            $this->userMock,
            $this->provinceMock,
            $this->hotelMock,
            $this->imageMock,
            $this->bookingMock,
            $this->bookingDetailMock,
        );
    }

    public function testIndex()
    {
        $this->userMock->shouldReceive('getHotelForPartner');
        $result = $this->partnerController->index();
        $data = $result->getData();
        $this->assertIsArray($data);
        $this->assertEquals('cms.pages.partner.index', $result->getName());
        $this->assertArrayHasKey('hotels', $data);
    }

    public function testCreate()
    {
        $this->provinceMock->shouldReceive('getAll');
        $result = $this->partnerController->create();
        $data = $result->getData();
        $this->assertIsArray($data);
        $this->assertEquals('cms.pages.partner.create', $result->getName());
        $this->assertArrayHasKey('provinces', $data);
    }

    public function testStore()
    {
        $attr = new PartnerRequest();
        $hotel = Hotel::factory()->make();
        $attr->name = $hotel->name;
        $attr->description = $hotel->description;
        $attr->province = $hotel->province_id;
        $attr->rate = $hotel->rate;
        $attr->status = $hotel->status;
        $attr->avg_price = $hotel->avg_price;
        $attr->user_id = 1;
        $this->hotelMock->shouldReceive('create')->andReturn($hotel);
        $imageFake = $this->faker->image;
        $attr->images = [$imageFake, $imageFake];
        $this->imageMock->shouldReceive('insert');
        $result = $this->partnerController->store($attr);
        $this->assertEquals(route('partners.hotels.index'), $result->getTargetUrl());
    }

    public function testDenyFailed()
    {
        $request = new Request();
        $request->status = 2;
        $order = Booking::factory()->make();
        $this->bookingMock->shouldReceive('update');
        $this->bookingDetailMock->shouldReceive('handelRoomForPartner')->with($order, $request->status);
        $result = $this->partnerController->deny($request, $id=2);
        $this->assertEquals(route('partners.order'), $result->getTargetUrl());
    }

    public function testUpload()
    {
        $request = new Request();
        $request->status = config('user.approved_number');
        $this->bookingMock->shouldReceive('update');
        $result = $this->partnerController->upload($request, $id=1);
        $this->assertEquals(route('partners.order'), $result->getTargetUrl());
    }

    public function testDeny()
    {
        $request = new Request();
        $request->status = config('user.denied_number');
        $attrs = [
            'status' => $request->status,
        ];
        $order = Booking::factory()->make();
        $this->bookingMock->shouldReceive('update')->with($id=1, $attrs)->andReturn($order);
        $this->bookingDetailMock->shouldReceive('handelRoomForPartner')->with($order, $request->status);
        $result = $this->partnerController->deny($request, $id=1);
        $this->assertEquals(route('partners.order'), $result->getTargetUrl());
    }

    public function testCheckout()
    {
        $request = new Request();
        $request->status = config('user.paid_number');
        $attrs = [
            'status' => $request->status,
        ];
        $order = Booking::factory()->make();
        $this->bookingMock->shouldReceive('update')->with($id=1, $attrs)->andReturn($order);
        $this->bookingDetailMock->shouldReceive('handelRoomForPartner')->with($order, $request->status);
        $result = $this->partnerController->checkOut($request, $id=1);
        $this->assertEquals(route('partners.order'), $result->getTargetUrl());
    }

    public function tearDown(): void
    {
        m::close();
        unset($this->userMock);
        unset($this->provinceMock);
        unset($this->hotelMock);
        unset($this->imageMock);
        unset($this->bookingMock);
        unset($this->bookingDetailMock);
        parent::tearDown();
    }
}
