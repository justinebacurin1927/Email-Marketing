<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'source_id',
        'sender_name',
        'sender_email',
        'subject',
        'body',
        'contact_id',
        'is_read',
        'is_trashed',
        'source_type',
    ];

    public function source()
    {
        return $this->belongsTo(Source::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
