<?php

define('LARAVEL_START', microtime(true));
error_reporting(E_ALL & ~E_DEPRECATED);

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

// Vercel has a read-only filesystem — redirect writable paths to /tmp
$storagePath = env('APP_STORAGE_PATH', '/tmp/storage');
$app->useStoragePath($storagePath);

// Ensure required directories exist for compiled Blade views
$dirs = [
    "$storagePath/logs",
    "$storagePath/framework/views",
    "$storagePath/framework/cache",
];
foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0777, true);
    }
}

$app->handleRequest(Illuminate\Http\Request::capture());
