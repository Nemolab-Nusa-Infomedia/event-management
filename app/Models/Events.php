<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $fillable = [
        'id_master',
        'name',
        'event_date',
        'event_start',
        'event_end',
        'location',
        'user_id',
        'thumbnail_img'
    ];

    public function eventParticipants(){
        return $this->hasMany(EventParticipants::class, 'id_event', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}