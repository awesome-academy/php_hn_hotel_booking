<?php

namespace Tests\Unit\Model;

use App\Models\Hotel;
use App\Models\Image;
use App\Models\Room;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Tests\ModelTestCase;
use Illuminate\Foundation\Testing\WithFaker;

class ImageTest extends ModelTestCase
{
    use WithFaker;
    protected $image;

    public function setUp(): void
    {
        parent::setUp();
        $this->image = new Image();
    }

    public function tearDown(): void
    {
        $this->image = null;
        parent::tearDown();
    }

    public function testFillable()
    {
        $fillable = [
            'image',
            'imageable_id',
            'imageable_type',
        ];
        $this->assertEquals($fillable, $this->image->getFillable());
    }

    public function testImageableWithRoom()
    {
        $relation = $this->image->imageable();
        $this->assertMorphToRelation($relation, 'imageable');
    }
}
