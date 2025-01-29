<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketForm extends Model
{
    use HasFactory;

    protected $fillable = ['share_id', 'expiry_date'];
}
