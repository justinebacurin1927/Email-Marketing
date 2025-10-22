<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AudienceController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\MessageTemplateController;

// DATABASE TEST
Route::get('/db-test', fn() => DB::select('SHOW TABLES'));

// DASHBOARD & PAGES
Route::get('/', fn() => view('dashboard.index'));
Route::get('/campaigns', fn() => view('campaigns'));
Route::get('/automation', fn() => view('automation'));

// MESSAGE TEMPLATES
Route::get('/message-temp', [MessageTemplateController::class, 'index'])->name('templates.index');
Route::get('/template-form', [MessageTemplateController::class, 'create'])->name('templates.create');
Route::post('/template-form', [MessageTemplateController::class, 'store'])->name('templates.store');
Route::get('/template-form/{id}/edit', [MessageTemplateController::class, 'edit'])->name('templates.edit');
Route::put('/template-form/{id}', [MessageTemplateController::class, 'update'])->name('templates.update');
Route::delete('/template-form/{id}', [MessageTemplateController::class, 'destroy'])->name('templates.destroy');

//TEMPLATE ADDING 
Route::get('/audience/template-form', [MessageTemplateController::class, 'create'])->name('templates.create');

// AUDIENCE - CONTACTS
Route::get('/audience', [ContactController::class, 'index'])->name('contacts.index');
Route::get('/add-contact', [ContactController::class, 'create'])->name('contacts.create');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
Route::delete('/contacts/delete-selected', [ContactController::class, 'deleteSelected'])->name('contacts.deleteSelected');

// AUDIENCE - INBOX
Route::get('/audience/inbox', [InboxController::class, 'index'])->name('inbox');
Route::get('/inbox-settings', [InboxController::class, 'settings'])->name('inbox.settings');

// AUDIENCE - SOURCES
Route::get('/add-source', [SourceController::class, 'index'])->name('sources.index');
Route::post('/add-source', [SourceController::class, 'store'])->name('sources.add');
Route::delete('/delete-source/{id}', [SourceController::class, 'destroy'])->name('sources.delete');

// AUDIENCE - TAGS
Route::get('audience/audience-tags', [TagController::class, 'index'])->name('audience-tags');
Route::post('/tags', [TagController::class, 'store'])->name('tags.store');
Route::put('/tags/{tag}', [TagController::class, 'update'])->name('tags.update');
Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');
Route::post('/tags/bulk-delete', [TagController::class, 'bulkDestroy'])->name('tags.bulk-destroy');

// OPTIONAL AUDIENCE CONTROLLER DASHBOARD
Route::get('/audience-dashboard', [AudienceController::class, 'index'])->name('audience.dashboard');
