<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'email_verification_expired_at',
        'password',
        'role',
        'profile_pict'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'email_verified_at',
        'email_verification_expired_at',
    ];


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function eventParticipants()
    {
        return $this->hasMany(EventParticipants::class, 'id_user', 'id');
    }

    public function events()
    {
        return $this->hasMany(Events::class, 'id_master', 'id');
    }

    public function UserPartision()
    {
        return $this->HasMany(EventParticipants::class, 'id_user', 'id');
    }
}
