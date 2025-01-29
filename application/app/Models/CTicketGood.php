<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CTicketGood extends Model
{
    use HasFactory;

    protected $table = "ticket_goods";

    protected $fillable = ['ticket_id','quantity','unit_type','description','weight','ldm','volume','length','width','height'];

}
