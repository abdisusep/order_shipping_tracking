<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'tracking_id',
        'waybill_id',
        'shipper_contact_name',
        'origin_contact_name',
        'origin_contact_phone',
        'origin_address',
        'origin_postal_code',
        'destination_contact_name',
        'destination_contact_phone',
        'destination_contact_email',
        'destination_address',
        'destination_postal_code',
        'courier_company',
        'items',
        'status'
    ];

    protected $casts = [
        'items' => 'array',
    ];
}
