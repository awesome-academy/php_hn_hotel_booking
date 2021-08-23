<?php
namespace App\Repositories\Eloquents;

use App\Models\Room;
use App\Repositories\Contracts\RoomRepositoryInterface;

class RoomRepository extends BaseRepository implements RoomRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return Room::class;
    }

    public function getFirstNameHotel($key)
    {
        $this->model->whereIn('id', $key)->first()->hotel->name;
    }
}
