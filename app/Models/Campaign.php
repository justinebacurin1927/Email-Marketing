<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'name',
        'type',
        'status',
        'send_date',
        'template_id',
        'contact_id',
        'created_by',
    ];

    public function template()
    {
        return $this->belongsTo(MessageTemplate::class, 'template_id');
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }

    public function contacts()
    {
        return $this->belongsToMany(Contact::class, 'campaign_contact')
            ->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'campaign_tag')
            ->withTimestamps();
    }

    public function allRecipients()
    {
        $contacts = $this->contacts;

        foreach ($this->tags as $tag) {
            $contacts = $contacts->merge($tag->contacts);
        }

        return $contacts->unique('id');
    }
}
