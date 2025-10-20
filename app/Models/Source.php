<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Source extends Model
{
    use HasFactory;

    protected $fillable = ['email'];

    // Relation: a source has many messages
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
