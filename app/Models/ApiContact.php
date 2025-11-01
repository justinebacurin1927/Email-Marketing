<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
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
        'tags',
        'permission',
        'subscribed'
    ];

    public function tags()
{
    return $this->belongsToMany(Tag::class, 'contact_tag', 'contact_id', 'tag_id');
}

}
