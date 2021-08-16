<?php
namespace App\Repositories\Eloquents;

use App\Models\Image;
use App\Repositories\Contracts\ImageRepositoryInterface;

class ImageRepository extends BaseRepository implements ImageRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return Image::class;
    }
}
