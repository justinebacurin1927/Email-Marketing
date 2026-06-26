<?php

namespace App\Notifications;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class InboundMessageNotification extends Notification
{
    use Queueable;

    public function __construct(
        public Message $message
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message_id' => $this->message->id,
            'subject' => $this->message->subject,
            'sender' => $this->message->sender_name ?: $this->message->sender_email,
            'message' => "New message from {$this->message->sender_name ?: $this->message->sender_email}: \"{$this->message->subject}\"",
            'icon' => 'bi-envelope-open',
            'url' => route('inbox'),
        ];
    }
}
