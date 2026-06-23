<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AutomationLog extends Model
{
    protected $fillable = [
        'automation_id',
        'step_id',
        'contact_id',
        'processed_at',
        'status',
        'error',
    ];

    protected $casts = [
        'processed_at' => 'datetime',
    ];

    public function automation()
    {
        return $this->belongsTo(Automation::class);
    }

    public function step()
    {
        return $this->belongsTo(AutomationStep::class, 'step_id');
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
