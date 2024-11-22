<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventParticipants extends Model
{
    protected $fillable = [
        'id_user',
        'id_participant',
        'id_event',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function participant(){
        return $this->belongsTo(Participants::class, 'id_participant', 'id');
    }
    
    public function event(){
        return $this->belongsTo(Events::class, 'id_event', 'id');
    }
}