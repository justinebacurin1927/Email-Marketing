<?php

/**
 * Vercel Cron — Processes queued jobs (e.g. SendCampaignJob).
 * With QUEUE_CONNECTION=sync (recommended), this is a no-op safety net.
 * If queue is set to 'database', this picks up one pending job per invocation.
 */

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

require __DIR__ . '/../../vendor/autoload.php';

$app = require_once __DIR__ . '/../../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

// Process one queued job if using database queue; safe no-op if sync
$status = $kernel->call('queue:work', ['--once' => true, '--stop-when-empty' => true]);

http_response_code(200);
header('Content-Type: application/json');
echo json_encode(['status' => 'ok', 'exit_code' => $status]);
