<?php

namespace App\Http\Controllers;

use App\Models\Automation;
use App\Models\AutomationStep;
use App\Models\MessageTemplate;
use App\Models\Tag;
use Illuminate\Http\Request;

class AutomationController extends Controller
{
    public function index()
    {
        $automations = Automation::with('steps')->orderBy('created_at', 'desc')->get();
        return view('automations.index', compact('automations'));
    }

    public function create()
    {
        $templates = MessageTemplate::all();
        $tags = Tag::all();
        return view('automations.create', compact('templates', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'trigger_type' => 'required|in:contact_created,tag_added,birthday,date_based',
            'trigger_config' => 'nullable|array',
            'steps' => 'required|array|min:1',
            'steps.*.delay_days' => 'required|integer|min:0',
            'steps.*.action_type' => 'required|in:send_email,add_tag,remove_tag',
            'steps.*.template_id' => 'required_if:steps.*.action_type,send_email|exists:message_templates,id|nullable',
            'steps.*.tag_id' => 'required_if:steps.*.action_type,add_tag,remove_tag|exists:tags,id|nullable',
        ]);

        $automation = Automation::create([
            'name' => $request->name,
            'description' => $request->description,
            'trigger_type' => $request->trigger_type,
            'trigger_config' => $request->trigger_config,
            'status' => 'active',
        ]);

        foreach ($request->steps as $i => $step) {
            $config = [];
            if ($step['action_type'] === 'send_email' && !empty($step['template_id'])) {
                $config['template_id'] = $step['template_id'];
            }
            if (in_array($step['action_type'], ['add_tag', 'remove_tag']) && !empty($step['tag_id'])) {
                $config['tag_id'] = $step['tag_id'];
            }

            $automation->steps()->create([
                'order' => $i,
                'delay_days' => $step['delay_days'],
                'action_type' => $step['action_type'],
                'action_config' => $config,
            ]);
        }

        return redirect()->route('automations.index')
            ->with('success', 'Automation created!');
    }

    public function edit(Automation $automation)
    {
        $automation->load('steps');
        $templates = MessageTemplate::all();
        $tags = Tag::all();
        return view('automations.edit', compact('automation', 'templates', 'tags'));
    }

    public function update(Request $request, Automation $automation)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'trigger_type' => 'required|in:contact_created,tag_added,birthday,date_based',
            'status' => 'required|in:active,paused',
            'trigger_config' => 'nullable|array',
            'steps' => 'required|array|min:1',
            'steps.*.delay_days' => 'required|integer|min:0',
            'steps.*.action_type' => 'required|in:send_email,add_tag,remove_tag',
            'steps.*.template_id' => 'required_if:steps.*.action_type,send_email|exists:message_templates,id|nullable',
            'steps.*.tag_id' => 'required_if:steps.*.action_type,add_tag,remove_tag|exists:tags,id|nullable',
        ]);

        $automation->update([
            'name' => $request->name,
            'description' => $request->description,
            'trigger_type' => $request->trigger_type,
            'trigger_config' => $request->trigger_config,
            'status' => $request->status,
        ]);

        $automation->steps()->delete();

        foreach ($request->steps as $i => $step) {
            $config = [];
            if ($step['action_type'] === 'send_email' && !empty($step['template_id'])) {
                $config['template_id'] = $step['template_id'];
            }
            if (in_array($step['action_type'], ['add_tag', 'remove_tag']) && !empty($step['tag_id'])) {
                $config['tag_id'] = $step['tag_id'];
            }

            $automation->steps()->create([
                'order' => $i,
                'delay_days' => $step['delay_days'],
                'action_type' => $step['action_type'],
                'action_config' => $config,
            ]);
        }

        return redirect()->route('automations.index')
            ->with('success', 'Automation updated!');
    }

    public function destroy(Automation $automation)
    {
        $automation->delete();
        return redirect()->route('automations.index')
            ->with('success', 'Automation deleted.');
    }

    public function toggle(Automation $automation)
    {
        $automation->update([
            'status' => $automation->status === 'active' ? 'paused' : 'active',
        ]);
        return back()->with('success', 'Automation ' . $automation->status . '.');
    }
}
