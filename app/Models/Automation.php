<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Automation extends Model
{
    protected $fillable = [
        'name',
        'description',
        'trigger_type',
        'trigger_config',
        'status',
    ];

    protected $casts = [
        'trigger_config' => 'array',
    ];

    public function steps()
    {
        return $this->hasMany(AutomationStep::class)->orderBy('order');
    }

    public function logs()
    {
        return $this->hasMany(AutomationLog::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByTrigger($query, $type)
    {
        return $query->where('trigger_type', $type)->active();
    }
}
