<?php

namespace Tests\Unit\Model;

use App\Models\Booking;
use App\Models\Hotel;
use App\Models\User;
use Tests\ModelTestCase;

class BookingTest extends ModelTestCase
{
    protected $booking;

    public function setUp(): void
    {
        parent::setUp();
        $this->booking = new Booking();
    }

    public function tearDown(): void
    {
        $this->booking = null;
        parent::tearDown();
    }

    public function testFillable()
    {
        $fillable = [
            'rate',
            'hotel_id',
            'user_id',
            'total',
            'status',
        ];
        $this->assertEquals($fillable, $this->booking->getFillable());
    }

    public function testDetailsRelation()
    {
        $relation = $this->booking->bookingDetails();
        $this->assertHasManyRelation($relation, $this->booking);
    }

    public function testHotelRelation()
    {
        $relation = $this->booking->hotel();
        $this->assertBelongsToRelation($relation, new Hotel());
    }

    public function testUserRelation()
    {
        $relation = $this->booking->user();
        $this->assertBelongsToRelation($relation, new User());
    }
}
