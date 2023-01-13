<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DineUser extends Model
{
    use HasFactory;
    protected $table = 'dineusers';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'user_type',
        'password',
        'image',
        'host_id',
    ];
}
