<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingInfo extends Model
{
    use HasFactory;
    protected $table = 'booking_info';

    protected $fillable = [
        'user_id',
        'house_id',
        'start_date',
        'end_date',
        'number_of_guests',
        'number_of_days',
        'number_of_hours',
        'total_price',
        'paid',
        'mpesa_message',
        'bank_message',
        'booking_phone',
        'pay_id',
    ];
}
