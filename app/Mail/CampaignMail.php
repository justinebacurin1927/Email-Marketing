<?php

namespace App\Mail;

use App\Models\Campaign;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CampaignMail extends Mailable
{
    use Queueable, SerializesModels;

    public Campaign $campaign;

    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    public function build()
    {
        $template = $this->campaign->template;

        return $this
            ->subject($template?->subject ?? $this->campaign->name)
            ->html($template?->body ?? '');
    }
}
