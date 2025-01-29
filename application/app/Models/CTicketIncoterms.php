<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CTicketIncoterms extends Model
{
    use HasFactory;

    protected $table = "ticket_incoterms";

    protected $fillable = ['name'];

}
