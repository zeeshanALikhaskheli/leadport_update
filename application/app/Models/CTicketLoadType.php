<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CTicketLoadType extends Model
{
    use HasFactory;

    protected $table = "ticket_load_type";

    protected $fillable = ['name'];


}
