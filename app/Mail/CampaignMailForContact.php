<?php

namespace App\Mail;

use App\Models\MessageTemplate;
use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CampaignMailForContact extends Mailable
{
    use Queueable, SerializesModels;

    public MessageTemplate $template;
    public Contact $contact;

    public function __construct(MessageTemplate $template, Contact $contact)
    {
        $this->template = $template;
        $this->contact = $contact;
    }

    public function build()
    {
        return $this
            ->subject($this->template->subject ?? 'Automated Email')
            ->html($this->template->body ?? '');
    }
}
