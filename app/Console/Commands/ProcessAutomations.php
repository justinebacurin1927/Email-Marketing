<?php

namespace App\Console\Commands;

use App\Mail\CampaignMailForContact;
use App\Models\Automation;
use App\Models\AutomationLog;
use App\Models\Contact;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ProcessAutomations extends Command
{
    protected $signature = 'automations:process';
    protected $description = 'Process all active automation triggers and execute pending steps';

    public function handle(): void
    {
        $this->processContactCreated();
        $this->processTagAdded();
        $this->processBirthday();

        $this->info('Automations processed.');
    }

    protected function processContactCreated(): void
    {
        $automations = Automation::byTrigger('contact_created')->with('steps')->get();

        foreach ($automations as $automation) {
            $contacts = Contact::where('created_at', '>=', now()->subDay())->get();

            foreach ($contacts as $contact) {
                foreach ($automation->steps as $step) {
                    $dueAt = now()->subDays($step->delay_days);
                    if ($contact->created_at > $dueAt) {
                        continue;
                    }

                    $existing = AutomationLog::where('step_id', $step->id)
                        ->where('contact_id', $contact->id)
                        ->exists();

                    if ($existing) {
                        continue;
                    }

                    $this->executeStep($step, $contact, $automation->id);
                }
            }
        }
    }

    protected function processTagAdded(): void
    {
        $automations = Automation::byTrigger('tag_added')->with('steps')->get();

        foreach ($automations as $automation) {
            $tagId = $automation->trigger_config['tag_id'] ?? null;
            if (!$tagId) {
                continue;
            }

            $contacts = Contact::whereHas('tags', function ($q) use ($tagId) {
                $q->where('tags.id', $tagId);
            })->get();

            foreach ($contacts as $contact) {
                foreach ($automation->steps as $step) {
                    $pivot = $contact->tags()->where('tags.id', $tagId)->first()?->pivot;
                    $taggedAt = $pivot?->created_at ?? $contact->created_at;
                    $dueAt = now()->subDays($step->delay_days);

                    if ($taggedAt > $dueAt) {
                        continue;
                    }

                    $existing = AutomationLog::where('step_id', $step->id)
                        ->where('contact_id', $contact->id)
                        ->exists();

                    if ($existing) {
                        continue;
                    }

                    $this->executeStep($step, $contact, $automation->id);
                }
            }
        }
    }

    protected function processBirthday(): void
    {
        $automations = Automation::byTrigger('birthday')->with('steps')->get();

        foreach ($automations as $automation) {
            $contacts = Contact::whereRaw('MONTH(birthday) = ? AND DAY(birthday) = ?', [now()->month, now()->day])
                ->get();

            foreach ($contacts as $contact) {
                foreach ($automation->steps as $step) {
                    $existing = AutomationLog::where('step_id', $step->id)
                        ->where('contact_id', $contact->id)
                        ->whereDate('created_at', today())
                        ->exists();

                    if ($existing) {
                        continue;
                    }

                    $this->executeStep($step, $contact, $automation->id);
                }
            }
        }
    }

    protected function executeStep($step, Contact $contact, int $automationId): void
    {
        $log = AutomationLog::create([
            'automation_id' => $automationId,
            'step_id' => $step->id,
            'contact_id' => $contact->id,
            'status' => 'pending',
        ]);

        try {
            match ($step->action_type) {
                'send_email' => $this->sendEmail($step, $contact),
                'add_tag' => $this->addTag($step, $contact),
                'remove_tag' => $this->removeTag($step, $contact),
                default => throw new \Exception("Unknown action: {$step->action_type}"),
            };

            $log->update(['status' => 'completed', 'processed_at' => now()]);
        } catch (\Throwable $e) {
            $log->update(['status' => 'failed', 'error' => $e->getMessage()]);
        }
    }

    protected function sendEmail($step, Contact $contact): void
    {
        $templateId = $step->action_config['template_id'] ?? null;
        if (!$templateId) {
            return;
        }

        $template = \App\Models\MessageTemplate::find($templateId);
        if (!$template || !$template->body) {
            return;
        }

        $mail = new CampaignMailForContact($template, $contact);
        Mail::to($contact->email)->send($mail);
    }

    protected function addTag($step, Contact $contact): void
    {
        $tagId = $step->action_config['tag_id'] ?? null;
        if ($tagId) {
            $contact->tags()->syncWithoutDetaching([$tagId]);
        }
    }

    protected function removeTag($step, Contact $contact): void
    {
        $tagId = $step->action_config['tag_id'] ?? null;
        if ($tagId) {
            $contact->tags()->detach($tagId);
        }
    }
}
