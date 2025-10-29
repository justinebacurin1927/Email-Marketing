<?php

use App\Http\Controllers\Api\ApiContactController;
use App\Http\Controllers\Api\ApiContactImportController;
use Illuminate\Support\Facades\Route;

Route::get('contacts', [ApiContactController::class, 'index']); // For testing
Route::post('contacts', [ApiContactController::class, 'store']);
Route::post('contacts/import', [ApiContactController::class, 'import']);



Route::post('/contacts/import', [ApiContactImportController::class, 'import']);
