<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AutomationStep extends Model
{
    protected $fillable = [
        'automation_id',
        'order',
        'delay_days',
        'action_type',
        'action_config',
    ];

    protected $casts = [
        'action_config' => 'array',
    ];

    public function automation()
    {
        return $this->belongsTo(Automation::class);
    }

    public function logs()
    {
        return $this->hasMany(AutomationLog::class, 'step_id');
    }

    public function dueAt()
    {
        return $this->delay_days > 0 ? now()->subDays($this->delay_days) : now();
    }
}
