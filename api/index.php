<?php

/**
 * Laravel on Vercel — Serverless entry point.
 * Vercel routes all requests through this single file.
 */

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Suppress PHP 8.5 deprecation notices (they break vercel-php output capture)
error_reporting(E_ALL & ~E_DEPRECATED);

// Autoload
require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Handle the request
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
);

// Send response headers
$response->sendHeaders();

// Output content (vercel-php captures stdout)
echo $response->getContent();

// Terminate
$kernel->terminate($request, $response);
