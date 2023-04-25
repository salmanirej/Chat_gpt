<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; 
class messages extends Model
{
    use HasFactory;
    protected $fillable = [
        'message',        
        'sender_id',
        'room_id'
    ];
 
    public function usersender()
    {
        return $this->hasMany(User::class,  'sender_id',"id");
        
    }
    public function room()
    {
        return $this->hasMany(User::class, 'room_id',"id");
        
    }

}
