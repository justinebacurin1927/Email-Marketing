<?php

/**
 * Laravel on Vercel — Serverless entry point.
 * Vercel routes all requests through this single file.
 */

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Autoload
require __DIR__ . '/../vendor/autoload.php';

// Bootstrap and handle the request
$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->handleRequest(Request::capture());
