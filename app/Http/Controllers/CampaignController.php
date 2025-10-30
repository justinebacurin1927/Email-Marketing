<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\MessageTemplate;
use App\Models\Contact;


class CampaignController extends Controller
{
    // List all campaigns
    public function index()
{
    $campaigns = Campaign::with('contact')->orderBy('send_date', 'desc')->get();
    return view('campaigns.campaigns', compact('campaigns'));
}


        // Show create form
    public function create()
    {
        // Fetch all templates and contacts from the database
        $templates = MessageTemplate::all();
        $contacts =  Contact::all();

        // Pass them to the Blade view
        return view('campaigns.create', compact('templates', 'contacts'));
    }


    // Store campaign
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'template_id' => 'required|exists:message_templates,id',
            'contact_id' => 'required|exists:contacts,id',
            'status' => 'required|in:draft,scheduled',
            'send_date' => 'nullable|date',
        ]);

        \App\Models\Campaign::create($request->all());

        return redirect()->route('campaigns.index')->with('success', 'Campaign created!');
    }


    // Show edit form
    public function edit(Campaign $campaign)
    {
        return view('campaigns.edit', compact('campaign'));
    }

    // Update campaign
    public function update(Request $request, Campaign $campaign)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:regular,automation',
            'status' => 'required|in:draft,sent',
            'send_date' => 'nullable|date',
        ]);

        $campaign->update($request->all());
        return redirect()->route('campaigns.index')->with('success', 'Campaign updated!');
    }

    // Delete campaign
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();
        return redirect()->route('campaigns.index')->with('success', 'Campaign deleted!');
    }
}
