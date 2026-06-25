<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Contact;
use App\Models\MessageTemplate;
use App\Models\Tag;

class DashboardController extends Controller
{
    public function index()
    {
        $totalContacts = Contact::count();
        $totalSubscribers = Contact::where('subscribed', true)->count();
        $totalCampaigns = Campaign::count();
        $totalTemplates = MessageTemplate::count();

        $sentCampaigns = Campaign::where('status', 'sent')->count();
        $draftCampaigns = Campaign::where('status', 'draft')->count();
        $scheduledCampaigns = Campaign::where('status', 'scheduled')->count();

        $recentCampaigns = Campaign::with('contacts', 'tags.contacts', 'template')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $tags = Tag::withCount('contacts')->get();

        return response()->json([
            'stats' => [
                'total_contacts' => $totalContacts,
                'total_subscribers' => $totalSubscribers,
                'subscription_rate' => $totalContacts > 0
                    ? round(($totalSubscribers / $totalContacts) * 100, 1)
                    : 0,
                'total_campaigns' => $totalCampaigns,
                'sent_campaigns' => $sentCampaigns,
                'draft_campaigns' => $draftCampaigns,
                'scheduled_campaigns' => $scheduledCampaigns,
                'total_templates' => $totalTemplates,
            ],
            'recent_campaigns' => $recentCampaigns,
            'tags' => $tags,
        ]);
    }
}
