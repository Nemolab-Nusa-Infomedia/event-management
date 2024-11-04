<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventParticipants extends Model
{
    protected $fillable = [
        'id_user',
        'id_event',
        'status',
    ];

    public function User(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
    
    public function Event(){
        return $this->belongsTo(Events::class, 'id_event', 'id');
    }
}
