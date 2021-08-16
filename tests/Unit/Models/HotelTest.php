<?php

namespace Tests\Unit\Model;

use App\Models\Hotel;
use App\Models\Province;
use App\Models\User;
use Tests\ModelTestCase;

class HotelTest extends ModelTestCase
{
    protected $hotel;

    public function setUp(): void
    {
        parent::setUp();
        $this->hotel = new Hotel();
    }

    public function tearDown(): void
    {
        $this->hotel = null;
        parent::tearDown();
    }

    public function testFillable()
    {
        $fillable = [
            'name',
            'description',
            'province_id',
            'user_id',
            'rate',
            'status',
            'avg_price',
        ];
        $this->assertEquals($fillable, $this->hotel->getFillable());
    }

    public function testUsersRelation()
    {
        $relation = $this->hotel->users();
        $this->assertBelongsToManyRelation($relation, $this->hotel, new User());
    }

    public function testPartnerRelation()
    {
        $relation = $this->hotel->partner();
        $this->assertBelongsToRelation($relation, new User(), 'partner_id');
    }

    public function testProvinceRelation()
    {
        $relation = $this->hotel->province();
        $this->assertBelongsToRelation($relation, new Province());
    }

    public function testRoomsRelation()
    {
        $relation = $this->hotel->rooms();
        $this->assertHasManyRelation($relation, $this->hotel);
    }

    public function testRoomMorphManyImage()
    {
        $relation = $this->hotel->images();
        $this->assertMorphManyRelation($relation, 'imageable');
    }
}
