<?php
namespace App\Repositories\Contracts;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * get info User
     * @param array $number
     * @return mixed
     */
    public function getUser();

    /**
     * get hotel for Partner view
     * @param null
     * @return mixed
     */
    public function getHotelForPartner();

    /**
     * get createUser
     * @param null
     * @return mixed
     */
    public function createUserCms($request);

    /**
     * get createUser
     * @param null
     * @return mixed
     */
    public function createUser($request);
}
