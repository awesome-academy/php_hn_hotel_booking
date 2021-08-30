<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\Partner\RoomController;
use App\Http\Requests\RoomRequest;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\User;
use App\Repositories\Contracts\BookingRepositoryInterface;
use App\Repositories\Contracts\HotelRepositoryInterface;
use App\Repositories\Contracts\ImageRepositoryInterface;
use App\Repositories\Contracts\RoomRepositoryInterface;
use App\Repositories\Contracts\TypeRepositoryInterface;
use Tests\TestCase;
use Mockery as m;
use Illuminate\Foundation\Testing\WithFaker;

class RoomControllerTest extends TestCase
{
    use WithFaker;

    protected $roomMock;
    protected $hotelMock;
    protected $typeMock;
    protected $imageMock;
    protected $bookingMock;
    protected $roomController;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->roomMock = m::mock(RoomRepositoryInterface::class);
        $this->hotelMock = m::mock(HotelRepositoryInterface::class);
        $this->typeMock = m::mock(TypeRepositoryInterface::class);
        $this->imageMock = m::mock(ImageRepositoryInterface::class);
        $this->bookingMock = m::mock(BookingRepositoryInterface::class);
        $this->roomController = new RoomController(
            $this->roomMock,
            $this->hotelMock,
            $this->typeMock,
            $this->imageMock,
            $this->bookingMock,
        );
    }

    public function testStatisticForPartner()
    {
        $user = User::factory()->make();
        $user->id = 1;
        $this->be($user);
        $hotel = Hotel::factory()->make();
        $booking = Booking::factory()->make();
        $booking['month'] = 1;
        $orders = [$booking];
        $this->bookingMock->shouldReceive('getTotalRevenue');
        $this->hotelMock->shouldReceive('getAllWithCondition')->andReturn($hotel);
        $this->bookingMock->shouldReceive('getTotalOrders');
        $this->bookingMock->shouldReceive('statisticOrderPerMonth')->andReturn($orders);
        $this->bookingMock->shouldReceive('statisticRevenuePerMonth')->andReturn($orders);

        $result = $this->roomController->statisticForPartner();
        $this->assertIsArray($result->getData());
        $this->assertEquals('cms.pages.partner.dashboard', $result->getName());
    }

    public function testIndex()
    {
        $user = User::factory()->make();
        $user->id = 1;
        $this->be($user);
        $this->roomMock->shouldReceive('getAllWithCondition');

        $result = $this->roomController->index();
        $this->assertIsArray($result->getData());
        $this->assertEquals('cms.pages.partner.room.index', $result->getName());
    }

    public function testCreate()
    {
        $user = User::factory()->make();
        $user->id = 1;
        $this->be($user);
        $this->hotelMock->shouldReceive('getAllWithCondition');
        $this->typeMock->shouldReceive('getAllWithCondition');

        $result = $this->roomController->create();
        $this->assertIsArray($result->getData());
        $this->assertEquals('cms.pages.partner.room.create', $result->getName());
    }

    public function testStore()
    {
        $user = User::factory()->make();
        $user->id = 1;
        $this->be($user);
        $room = Room::factory()->make();
        $request = new RoomRequest();
        $this->roomMock->shouldReceive('create')->andReturn($room);
        $imageFake = $this->faker->image;
        $request->images = [$imageFake, $imageFake];
        $this->imageMock->shouldReceive('insert');

        $result = $this->roomController->store($request);
        $this->assertEquals(route('partners.rooms.index'), $result->getTargetUrl());
    }

    protected function tearDown(): void
    {
        m::close();
        unset($this->hotelMock);
        unset($this->bookingMock);
        unset($this->typeMock);
        unset($this->roomMock);
        unset($this->imageMock);
        parent::tearDown(); // TODO: Change the autogenerated stub
    }
}