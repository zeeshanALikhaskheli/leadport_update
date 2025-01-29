<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $fillable = [
        'uid', 'subject', 'from', 'body', 'logistics_data', 'received_at','request_type',
    'quantity',
    'shipping_date',
    'shipping_time',
    'shipper_name',
    'shipper_country',
    'shipper_city',
    'shipper_address',
    'pickup_remarks',
    'shipping_carrier',
    'transport_mode',
    'container_type',
    'cargo_weight_kg',
    'cargo_type',
    'origin',
    'destination',
    'delivery_date',
    'delivery_time',
    'consignee_name',
    'consignee_country',
    'consignee_city',
    'consignee_address',
    'delivery_remarks',
    'carrier_for_delivery',
    'temperature_sensitive',
    'temperature_range',
    'adr',
    'email_to',
    'un_code',
    'fragile',
    'notes',
    'chargeable_weight',
    'ticket_user_id',
    ];

    protected $casts = [
        'logistics_data' => 'array',
        'received_at' => 'datetime',
    ];
}