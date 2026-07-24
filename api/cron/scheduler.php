<?php

/**
 * Vercel Cron — Runs artisan schedule:run every minute.
 * Handles scheduled campaigns + automation processing.
 */

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

require __DIR__ . '/../../vendor/autoload.php';

$app = require_once __DIR__ . '/../../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

// Run the scheduler (fires commands due at this minute)
$status = $kernel->call('schedule:run');

http_response_code(200);
header('Content-Type: application/json');
echo json_encode(['status' => 'ok', 'exit_code' => $status]);
