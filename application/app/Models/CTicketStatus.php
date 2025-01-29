<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CTicketStatus extends Model
{
    use HasFactory;

    protected $table = "ctickets_status";

    protected $fillable = ['name'];

}
