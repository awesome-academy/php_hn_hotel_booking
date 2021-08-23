<?php
namespace App\Repositories\Eloquents;

use App\Models\Type;
use App\Repositories\Contracts\TypeRepositoryInterface;

class TypeRepository extends BaseRepository implements TypeRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return Type::class;
    }
}
