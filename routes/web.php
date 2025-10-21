<?php

use Illuminate\Support\Facades\Route;

Route::get('/db-test', function() {
    return DB::select('SHOW TABLES');
});

Route::get('/', function () {
    return view('dashboard.index');
});

Route::get('/campaigns', function () {
    return view('campaigns');
});

Route::get('/automation', function () {
    return view('automation');
});

Route::get('/audience', function () {
    return view('audience');
});

Route::get('audience/inbox', function () {
    return view('inbox');
});

Route::get('/inbox-settings', function () {
    return view('inbox-settings');
});

Route::get('/message-temp', function() {
    return view('message-temp');
});

Route::get('/template-form', function() {
    return view('template-form');
});

use App\Http\Controllers\MessageTemplateController;

// Existing routes
Route::get('/message-temp', [MessageTemplateController::class, 'index'])->name('templates.index');
Route::get('/template-form', [MessageTemplateController::class, 'create'])->name('templates.create');
Route::post('/template-form', [MessageTemplateController::class, 'store'])->name('templates.store');

// Add these routes
Route::get('/template-form/{id}/edit', [MessageTemplateController::class, 'edit'])->name('templates.edit');
Route::put('/template-form/{id}', [MessageTemplateController::class, 'update'])->name('templates.update');
Route::delete('/template-form/{id}', [MessageTemplateController::class, 'destroy'])->name('templates.destroy');

use App\Http\Controllers\SourceController;

Route::get('/add-source', [SourceController::class, 'index'])->name('sources.index');
Route::post('/add-source', [SourceController::class, 'store'])->name('sources.add');
Route::delete('/delete-source/{id}', [SourceController::class, 'destroy'])->name('sources.delete');
Route::get('/inbox', [InboxController::class, 'sidebar'])->name('inbox');
Route::post('/sources/add', [SourceController::class, 'store'])->name('sources.add');

use App\Http\Controllers\ContactController;

Route::get('/audience', [ContactController::class, 'index'])->name('contacts.index');
Route::get('/add-contact', [ContactController::class, 'create'])->name('contacts.create');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
Route::delete('/contacts/delete-selected', [ContactController::class, 'deleteSelected'])->name('contacts.deleteSelected');

use App\Http\Controllers\AudienceController;

Route::get('/audience', [AudienceController::class, 'index']);
