<?php

use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\SendScheduledCampaigns;
use App\Console\Commands\ProcessAutomations;

Schedule::command('campaigns:send-scheduled')->everyMinute();
Schedule::command('automations:process')->everyMinute();
