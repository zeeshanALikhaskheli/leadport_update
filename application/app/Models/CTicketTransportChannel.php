<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CTicketTransportChannel extends Model
{
    use HasFactory;

    protected $table = "tickets_transport_channel";
    protected $fillable = ['name'];
}
