<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'userid',
        'shipping_recipient_name',
        'shipping_phone_number',
        'shipping_city_name',
        'shipping_postal_code',
        'shipping_address',
        'product_image',
        'product_name',
        'product_quentity',
    ];
}
