<?php

namespace Tests\Unit\Model;

use App\Models\Image;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Tests\ModelTestCase;

class ImageTest extends ModelTestCase
{
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
}
