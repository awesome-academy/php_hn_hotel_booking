<?php

namespace Tests\Unit\Model;

use App\Models\Notification;
use Tests\ModelTestCase;

class NotificationTest extends ModelTestCase
{
    protected $notify;

    public function setUp(): void
    {
        parent::setUp();
        $this->notify = new Notification();
    }

    public function tearDown(): void
    {
        $this->notify = null;
        parent::tearDown();
    }

    public function testFillable()
    {
        $fillable = [
            'read_at',
        ];
        $this->assertEquals($fillable, $this->notify->getFillable());
    }
}
