<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Tag;
use App\Models\Audience;

class AudienceDashboardController extends Controller
{
    public function index()
    {
        $audienceName = 'Jaycee';
        $totalContacts = Contact::count();
        $totalSubscribers = Contact::where('subscribed', true)->count();

        // Fetch all tags with contact counts
        $tags = Tag::withCount('contacts')->get();

        return view('audience.dashboards', compact('audienceName', 'totalContacts', 'totalSubscribers', 'tags'));
    }

    public function showAudience($audienceId)
    {
        $audience = Audience::findOrFail($audienceId);

        // Fetch tags for this audience with contact counts
        $tags = Tag::where('audience_id', $audience->id)
                   ->withCount('contacts')
                   ->get();

        return view('audience.dashboard', [
            'audienceName' => $audience->name,
            'totalContacts' => $audience->contacts_count,
            'totalSubscribers' => $audience->subscribers_count,
            'tags' => $tags
        ]);
    }
}
