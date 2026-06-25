<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Contact;
use App\Models\Source;

class MailgunWebhookController extends Controller
{
    public function inbound(Request $request)
    {
        $senderEmail = $request->input('sender');
        $from = $request->input('from', $senderEmail);
        $subject = $request->input('subject', '(No subject)');
        $body = $request->input('stripped-text') ?? $request->input('body-plain', '(No body)');
        $recipient = $request->input('recipient');

        $senderName = $senderEmail;
        if ($from && preg_match('/^(.+?)\s*</', $from, $m)) {
            $senderName = trim($m[1]);
        }

        $source = null;
        if ($recipient) {
            $source = Source::where('email', $recipient)->first();
        }

        $contact = Contact::where('email', $senderEmail)->where('subscribed', true)->first();

        Message::create([
            'source_id' => $source?->id,
            'sender_name' => $senderName,
            'sender_email' => $senderEmail,
            'subject' => $subject,
            'body' => $body,
            'contact_id' => $contact?->id,
            'source_type' => 'email_marketing',
        ]);

        return response('OK', 200);
    }
}
