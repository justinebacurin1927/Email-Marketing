<?php

namespace App\Notifications;

use App\Models\Campaign;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CampaignNotification extends Notification
{
    use Queueable;

    public string $status;

    public function __construct(
        public Campaign $campaign,
        string $status
    ) {
        $this->status = $status;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'campaign_id' => $this->campaign->id,
            'campaign_name' => $this->campaign->name,
            'status' => $this->status,
            'message' => $this->status === 'sent'
                ? "Campaign \"{$this->campaign->name}\" has been sent successfully."
                : "Campaign \"{$this->campaign->name}\" failed to send.",
            'icon' => $this->status === 'sent' ? 'bi-send-check' : 'bi-exclamation-circle',
            'url' => route('campaigns.index'),
        ];
    }
}
