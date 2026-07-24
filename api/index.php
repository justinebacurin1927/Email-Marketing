<?php

/**
 * Laravel on Vercel — Serverless entry point.
 * Vercel routes all requests through this single file.
 */

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Autoload
require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Handle the request via the HTTP kernel
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
);

// Send headers
foreach ($response->headers->all() as $name => $values) {
    foreach ($values as $value) {
        header("$name: $value", false);
    }
}

http_response_code($response->getStatusCode());

// Output content (vercel-php captures this)
echo $response->getContent();

// Terminate
$kernel->terminate($request, $response);
