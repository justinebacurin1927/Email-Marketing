<?php

use App\Http\Controllers\Api\ApiContactController;
use Illuminate\Support\Facades\Route;

// Contacts API routes
Route::get('contacts', [ApiContactController::class, 'index']); // For testing or fetching via API
Route::post('contacts', [ApiContactController::class, 'store']); // Create new contact

