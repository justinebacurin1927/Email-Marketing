<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    // Allow mass assignment for these fields
    protected $fillable = [
        'name',
        'type',
        'status',
        'send_date',
        'template_id',
        'contact_id',
    ];

    // Relationships
    public function template()
    {
        return $this->belongsTo(MessageTemplate::class, 'template_id');
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }

}
