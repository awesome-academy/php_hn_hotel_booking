<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'province_id',
        'user_id',
        'rate',
        'status',
        'avg_price',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'bookings');
    }

    public function partner()
    {
        return $this->belongsTo(User::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
