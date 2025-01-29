<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CTicketCarriageType extends Model
{
    use HasFactory;

    protected $table = "ticket_carriage_types";

    protected $fillable = ['name'];
}
