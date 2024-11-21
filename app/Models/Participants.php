<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participants extends Model
{
    protected $fillable = [
        'id_event',
        'name',
        'email',
        'no_telp',
        'alamat'
    ];

    public function eventParticipants(){
        return $this->belongsTo(EventParticipants::class, 'id_event', 'id');
    }
}
