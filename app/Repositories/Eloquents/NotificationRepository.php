<?php
namespace App\Repositories\Eloquents;

use App\Models\Notification;
use App\Repositories\Contracts\NotificationRepositoryInterface;

class NotificationRepository extends BaseRepository implements NotificationRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return Notification::class;
    }
}
