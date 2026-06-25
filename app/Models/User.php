<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // add this

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; // include HasApiTokens

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    public function getAvatarUrlAttribute(): string
    {
        return $this->avatar
            ? asset('storage/avatars/' . $this->avatar)
            : '';
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [  // change from function to property
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
