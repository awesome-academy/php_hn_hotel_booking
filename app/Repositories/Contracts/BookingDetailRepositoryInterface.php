<?php
namespace App\Repositories\Contracts;

interface BookingDetailRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Handel room for partner when checkOut, deny
     * @param $order, $status
     * @return mixed
     */
    public function handelRoomForPartner($order, $status);
}
