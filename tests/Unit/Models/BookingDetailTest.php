<?php

namespace Tests\Unit\Model;

use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\Room;
use Tests\ModelTestCase;

class BookingDetailTest extends ModelTestCase
{
    protected $bookingDetail;

    public function setUp(): void
    {
        parent::setUp();
        $this->bookingDetail = new BookingDetail();
    }

    public function tearDown(): void
    {
        $this->bookingDetail = null;
        parent::tearDown();
    }

    public function testFillable()
    {
        $fillable = [
            'room_id',
            'booking_id',
            'qty',
            'price',
            'checkIn',
            'checkout',
            'status',
        ];
        $this->assertEquals($fillable, $this->bookingDetail->getFillable());
    }

    public function testBookingRelation()
    {
        $relation = $this->bookingDetail->booking();
        $this->assertBelongsToRelation($relation, new Booking());
    }

    public function testRoomRelation()
    {
        $relation = $this->bookingDetail->room();
        $this->assertBelongsToRelation($relation, new Room());
    }
}
