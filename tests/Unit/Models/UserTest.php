<?php

namespace Tests\Unit\Model;

use App\Models\Hotel;
use App\Models\Permission;
use Tests\ModelTestCase;
use App\Models\User;

class UserTest extends ModelTestCase
{
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = new User();
    }

    public function tearDown(): void
    {
        $this->user = null;
        parent::tearDown();
    }

    public function testFillable()
    {
        $fillable = [
            'name',
            'email',
            'password',
        ];
        $this->assertEquals($fillable, $this->user->getFillable());
    }

    public function testHidden()
    {
        $hidden = [
            'password',
            'remember_token',
        ];
        $this->assertEquals($hidden, $this->user->getHidden());
    }
    public function testCast()
    {
        $casts = [
            'email_verified_at' => 'datetime',
            'id' => 'int',
        ];
        $this->assertEquals($casts, $this->user->getCasts());
    }

    public function testPartnerHotelsRelation()
    {
        $relation = $this->user->partnerHotels();
        $this->assertHasManyRelation($relation, $this->user);
    }

    public function testPermissionsRelation()
    {
        $relation = $this->user->permissions();
        $this->assertBelongsToManyRelation($relation, $this->user, new Permission());
    }

    public function testHotelsRelation()
    {
        $relation = $this->user->hotels();
        $this->assertBelongsToManyRelation($relation, $this->user, new Hotel());
    }
}
