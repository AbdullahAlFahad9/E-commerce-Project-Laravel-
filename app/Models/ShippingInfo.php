<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingInfo extends Model
{
    protected $fillable = [
        'user_id',
        'recipient_name',
        'phone_number',
        'city_name',
        'postal_code',
        'address',
    ];
}
