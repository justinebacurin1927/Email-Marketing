<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'permission',
        'first_name',
        'last_name',
        'company',
        'phone',
        'birthday',
        'street',
        'address2',
        'city',
        'region',
        'postal',
        'country',
    ];
}
