<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'rate',
        'hotel_id',
        'user_id',
        'total',
        'status',
    ];

    public function bookingDetails()
    {
        return $this->hasMany(BookingDetail::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
