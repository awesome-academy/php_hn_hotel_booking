<?php

namespace Tests\Unit\Model;

use App\Models\Province;
use Tests\ModelTestCase;

class ProvinceTest extends ModelTestCase
{
    protected $province;

    public function setUp(): void
    {
        parent::setUp();
        $this->province = new Province();
    }

    public function tearDown(): void
    {
        $this->province = null;
        parent::tearDown();
    }

    public function testFillable()
    {
        $fillable = [
            'name',
            'code',
        ];
        $this->assertEquals($fillable, $this->province->getFillable());
    }

    public function testHotelsRelation()
    {
        $relation = $this->province->hotels();
        $this->assertHasManyRelation($relation, $this->province);
    }
}
