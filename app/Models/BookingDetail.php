<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'booking_id',
        'qty',
        'price',
        'checkIn',
        'checkout',
        'status',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
