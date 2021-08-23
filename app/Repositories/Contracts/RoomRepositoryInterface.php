<?php
namespace App\Repositories\Contracts;

interface RoomRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function getFirstNameHotel($key);
}
