<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class delivered_messages extends Model
{
    use HasFactory;
    protected $fillable = [
        'message_id',
        'receiver_id',
        'read_at',
         
    ];

}
