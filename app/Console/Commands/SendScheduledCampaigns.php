<?php

namespace App\Console\Commands;

use App\Jobs\SendCampaignJob;
use App\Models\Campaign;
use Illuminate\Console\Command;

class SendScheduledCampaigns extends Command
{
    protected $signature = 'campaigns:send-scheduled';
    protected $description = 'Send all scheduled campaigns whose send_date has arrived';

    public function handle()
    {
        $campaigns = Campaign::where('status', 'scheduled')
            ->where('send_date', '<=', now()->format('Y-m-d'))
            ->get();

        foreach ($campaigns as $campaign) {
            SendCampaignJob::dispatch($campaign);
            $this->info("Dispatched campaign: {$campaign->name}");
        }

        $this->info("Done. Dispatched {$campaigns->count()} campaign(s).");
    }
}
