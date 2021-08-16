<?php

namespace Tests\Unit\Model;

use App\Models\Type;
use Tests\ModelTestCase;

class TypeTest extends ModelTestCase
{
    protected $type;

    public function setUp(): void
    {
        parent::setUp();
        $this->type = new Type();
    }

    public function tearDown(): void
    {
        $this->type = null;
        parent::tearDown();
    }

    public function testFillable()
    {
        $fillable = [
            'name',
            'description',
            'number_of_bed',
            'number_of_guest',
        ];
        $this->assertEquals($fillable, $this->type->getFillable());
    }

    public function testRoomsRelation()
    {
        $relation = $this->type->rooms();
        $this->assertHasManyRelation($relation, $this->type);
    }
}
