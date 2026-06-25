<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CampaignResource;
use App\Models\Campaign;
use App\Models\Contact;
use App\Models\MessageTemplate;
use App\Models\Tag;
use App\Jobs\SendCampaignJob;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        $query = Campaign::with('contacts', 'tags.contacts', 'template')
            ->orderBy('created_at', 'desc');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $perPage = min($request->integer('per_page', 15), 100);

        return CampaignResource::collection($query->paginate($perPage));
    }

    public function show(Campaign $campaign)
    {
        $campaign->load('contacts', 'tags.contacts', 'template');

        return new CampaignResource($campaign);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'template_id' => 'required|exists:message_templates,id',
            'status' => 'required|in:draft,scheduled',
            'send_date' => 'nullable|date',
            'contact_ids' => 'nullable|array',
            'contact_ids.*' => 'exists:contacts,id',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'exists:tags,id',
        ]);

        $campaign = Campaign::create([
            'name' => $validated['name'],
            'template_id' => $validated['template_id'],
            'status' => $validated['status'],
            'send_date' => $validated['send_date'] ?? null,
            'contact_id' => null,
        ]);

        if (!empty($validated['contact_ids'])) {
            $campaign->contacts()->sync($validated['contact_ids']);
        }

        if (!empty($validated['tag_ids'])) {
            $campaign->tags()->sync($validated['tag_ids']);
        }

        $campaign->load('contacts', 'tags.contacts', 'template');

        return new CampaignResource($campaign);
    }

    public function update(Request $request, Campaign $campaign)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'type' => 'sometimes|in:regular,automation',
            'status' => 'sometimes|in:draft,scheduled,sent',
            'send_date' => 'nullable|date',
            'template_id' => 'sometimes|exists:message_templates,id',
            'contact_ids' => 'nullable|array',
            'contact_ids.*' => 'exists:contacts,id',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'exists:tags,id',
        ]);

        $campaign->update($validated);

        if ($request->has('contact_ids')) {
            $campaign->contacts()->sync($validated['contact_ids'] ?? []);
        }

        if ($request->has('tag_ids')) {
            $campaign->tags()->sync($validated['tag_ids'] ?? []);
        }

        $campaign->load('contacts', 'tags.contacts', 'template');

        return new CampaignResource($campaign);
    }

    public function destroy(Campaign $campaign)
    {
        $campaign->delete();

        return response()->json(['message' => 'Campaign deleted successfully.']);
    }

    public function send(Campaign $campaign)
    {
        if ($campaign->status === 'sent') {
            return response()->json(['message' => 'Campaign has already been sent.'], 409);
        }

        $recipients = $campaign->allRecipients();

        if ($recipients->isEmpty()) {
            return response()->json(['message' => 'Campaign has no recipients.'], 422);
        }

        if (!$campaign->template) {
            return response()->json(['message' => 'Campaign has no template assigned.'], 422);
        }

        SendCampaignJob::dispatchSync($campaign);

        return response()->json([
            'message' => "Campaign sent to {$recipients->count()} recipient(s)!",
        ]);
    }

    public function recipients(Campaign $campaign)
    {
        $recipients = $campaign->allRecipients();

        return response()->json([
            'total' => $recipients->count(),
            'recipients' => $recipients->values(),
        ]);
    }
}
