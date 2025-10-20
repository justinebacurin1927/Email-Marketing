<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['source_id', 'body'];

    // Relation: a message belongs to a source
    public function source()
    {
        return $this->belongsTo(Source::class);
    }
}
