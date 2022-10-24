<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
            'user_id',
            'total_price',
            'fname',
            'lname',
            'email',
            'address1',
            'address2',
            'city',
            'province',
            'country',
            'streetcode',
            'status',
            'message',
            'tracking_no',


    ];
}
