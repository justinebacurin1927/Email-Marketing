<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\MessageTemplate;
use App\Models\Contact;
use App\Notifications\CampaignNotification;
use App\Models\Tag;
use App\Jobs\SendCampaignJob;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::with('contacts', 'tags.contacts', 'template', 'contact')
            ->orderBy('send_date', 'desc')
            ->get();
        return view('campaigns.campaigns', compact('campaigns'));
    }

    public function create()
    {
        $templates = MessageTemplate::all();
        $contacts = Contact::all();
        $tags = Tag::with('contacts')->get();
        return view('campaigns.create', compact('templates', 'contacts', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'template_id' => 'required|exists:message_templates,id',
            'status' => 'required|in:draft,scheduled',
            'send_date' => 'nullable|date',
            'contact_ids' => 'nullable|array',
            'contact_ids.*' => 'exists:contacts,id',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'exists:tags,id',
        ]);

        $campaign = Campaign::create($request->only([
            'name', 'template_id', 'status', 'send_date'
        ]) + ['contact_id' => null]);

        if ($request->filled('contact_ids')) {
            $campaign->contacts()->sync($request->contact_ids);
        }

        if ($request->filled('tag_ids')) {
            $campaign->tags()->sync($request->tag_ids);
        }

        return redirect()->route('campaigns.index')
            ->with('success', 'Campaign created!');
    }

    public function edit(Campaign $campaign)
    {
        $templates = MessageTemplate::all();
        $contacts = Contact::all();
        $tags = Tag::with('contacts')->get();
        $campaign->load('contacts', 'tags');
        return view('campaigns.edit', compact('campaign', 'templates', 'contacts', 'tags'));
    }

    public function update(Request $request, Campaign $campaign)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:regular,automation',
            'status' => 'required|in:draft,scheduled,sent',
            'send_date' => 'nullable|date',
            'template_id' => 'required|exists:message_templates,id',
            'contact_ids' => 'nullable|array',
            'contact_ids.*' => 'exists:contacts,id',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'exists:tags,id',
        ]);

        $campaign->update($request->only([
            'name', 'type', 'status', 'send_date', 'template_id'
        ]));

        $campaign->contacts()->sync($request->contact_ids ?? []);
        $campaign->tags()->sync($request->tag_ids ?? []);

        return redirect()->route('campaigns.index')
            ->with('success', 'Campaign updated!');
    }

    public function destroy(Campaign $campaign)
    {
        $campaign->delete();

        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('campaigns.index')
            ->with('success', 'Campaign deleted successfully.');
    }

    public function duplicate(Campaign $campaign)
    {
        try {
            $campaign->load('contacts', 'tags');
            $newCampaign = $campaign->replicate();
            $newCampaign->name = $campaign->name . ' (Copy)';
            $newCampaign->status = 'draft';
            $newCampaign->contact_id = null;
            $newCampaign->created_by = auth()->user()->name ?? 'Admin';
            $newCampaign->save();

            $newCampaign->contacts()->sync($campaign->contacts->pluck('id')->toArray());
            $newCampaign->tags()->sync($campaign->tags->pluck('id')->toArray());

            return response()->json([
                'success' => true,
                'message' => 'Campaign duplicated successfully.',
                'campaign' => $newCampaign
            ]);
        } catch (\Exception $e) {
            \Log::error('Duplicate error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function viewEmail(Campaign $campaign)
    {
        $template = $campaign->template;
        return view('campaigns.view-email', compact('campaign', 'template'));
    }

    public function preview(Campaign $campaign)
    {
        $recipients = $campaign->allRecipients();
        return view('campaigns.preview', compact('campaign', 'recipients'));
    }

    public function send(Campaign $campaign)
    {
        if ($campaign->status === 'sent') {
            return back()->with('error', 'Campaign has already been sent.');
        }

        $recipients = $campaign->allRecipients();

        if ($recipients->isEmpty()) {
            return back()->with('error', 'Campaign has no recipients.');
        }

        if (!$campaign->template) {
            return back()->with('error', 'Campaign has no template assigned.');
        }

        SendCampaignJob::dispatchSync($campaign);

        auth()->user()->notify(new CampaignNotification($campaign, 'sent'));

        return redirect()->route('campaigns.index')
            ->with('success', 'Campaign sent to ' . $recipients->count() . ' recipient(s)!');
    }
}
