<?php

namespace Tests\Unit\Model;

use App\Models\Permission;
use App\Models\User;
use Tests\ModelTestCase;

class PermissionTest extends ModelTestCase
{
    protected $permission;

    public function setUp(): void
    {
        parent::setUp();
        $this->permission = new Permission();
    }

    public function tearDown(): void
    {
        $this->permission = null;
        parent::tearDown();
    }

    public function testFillable()
    {
        $fillable = [
            'name',
            'description',
            'role_id',
        ];
        $this->assertEquals($fillable, $this->permission->getFillable());
    }

    public function testUsersRelation()
    {
        $relation = $this->permission->users();
        $this->assertBelongsToManyRelation($relation, new Permission(), new User());
    }
}
