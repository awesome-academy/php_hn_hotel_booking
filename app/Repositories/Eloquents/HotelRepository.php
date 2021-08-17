<?php
namespace App\Repositories\Eloquents;

use App\Models\Hotel;
use App\Repositories\Contracts\HotelRepositoryInterface;

class HotelRepository extends BaseRepository implements HotelRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return Hotel::class;
    }
}
