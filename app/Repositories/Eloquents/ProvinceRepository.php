<?php
namespace App\Repositories\Eloquents;

use App\Models\Province;
use App\Repositories\Contracts\ProvinceRepositoryInterface;

class ProvinceRepository extends BaseRepository implements ProvinceRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return Province::class;
    }
}
