<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class InboxController extends Controller
{
    public function index()
    {
        $messages = Message::with('contact')
            ->where('is_trashed', false)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('audience.inbox', compact('messages'));
    }

    public function settings()
    {
        return view('audience.inbox-settings');
    }

    public function markRead(Message $message)
    {
        $message->update(['is_read' => true]);
        return back();
    }

    public function trash(Message $message)
    {
        $message->update(['is_trashed' => true]);
        return back();
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return back();
    }
}
