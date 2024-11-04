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
    ];

    public function EventPartision(){
        return $this->HasMany(EventParticipants::class, 'id_event', 'id');
    }
}
