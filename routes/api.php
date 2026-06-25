<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\V1\CampaignController;
use App\Http\Controllers\Api\V1\ContactController;
use App\Http\Controllers\Api\V1\DashboardController;
use Illuminate\Support\Facades\Route;

// Public auth routes
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// Authenticated API v1 routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth/user', [AuthController::class, 'user']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::apiResource('contacts', ContactController::class)
        ->parameters(['contacts' => 'contact']);

    Route::get('/campaigns/{campaign}/recipients', [CampaignController::class, 'recipients']);
    Route::post('/campaigns/{campaign}/send', [CampaignController::class, 'send']);
    Route::apiResource('campaigns', CampaignController::class)
        ->parameters(['campaigns' => 'campaign']);
});
