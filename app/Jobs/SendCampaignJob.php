<?php

namespace App\Jobs;

use App\Mail\CampaignMail;
use App\Models\Campaign;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendCampaignJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public Campaign $campaign;

    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    public function handle(): void
    {
        $recipients = $this->campaign->allRecipients()->filter(function ($c) {
            return $c->email && $c->subscribed;
        });

        if ($recipients->isEmpty()) {
            return;
        }

        foreach ($recipients as $contact) {
            Mail::to($contact->email)->send(new CampaignMail($this->campaign));
        }

        $this->campaign->update([
            'status' => 'sent',
            'sent_at' => now(),
        ]);
    }
}
