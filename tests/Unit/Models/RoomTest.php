<?php

namespace Tests\Unit\Model;

use App\Models\Hotel;
use App\Models\Room;
use App\Models\Type;
use Tests\ModelTestCase;

class RoomTest extends ModelTestCase
{
    protected $room;

    public function setUp(): void
    {
        parent::setUp();
        $this->room = new Room();
    }

    public function tearDown(): void
    {
        $this->room = null;
        parent::tearDown();
    }

    public function testFillable()
    {
        $fillable = [
            'hotel_id',
            'qty',
            'type_id',
            'remaining',
            'price',
            'user_id',
        ];
        $this->assertEquals($fillable, $this->room->getFillable());
    }

    public function testHotelRelation()
    {
        $relation = $this->room->hotel();
        $this->assertBelongsToRelation($relation, new Hotel());
    }

    public function testTypeRelation()
    {
        $relation = $this->room->type();
        $this->assertBelongsToRelation($relation, new Type());
    }

    public function testRoomMorphManyImage()
    {
        $relation = $this->room->images();
        $this->assertMorphManyRelation($relation, 'imageable');
    }
}
