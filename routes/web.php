<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AudienceController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\MessageTemplateController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\AudienceDashboardController;
use App\Http\Controllers\Api\ApiContactImportController;
use App\Http\Controllers\CampaignController;

// DATABASE TEST
Route::get('/db-test', fn() => DB::select('SHOW TABLES'));

// DASHBOARD & PAGES
Route::get('/', fn() => view('dashboard.index'));
Route::get('/automation', fn() => view('automation'));


// CAMPAIGN PAGE

Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaigns.index');
Route::get('/campaigns/create', [CampaignController::class, 'create'])->name('campaigns.create');
Route::post('/campaigns', [CampaignController::class, 'store'])->name('campaigns.store');
Route::get('/campaigns/{campaign}/edit', [CampaignController::class, 'edit'])->name('campaigns.edit');
Route::put('/campaigns/{campaign}', [CampaignController::class, 'update'])->name('campaigns.update');
Route::delete('/campaigns/{campaign}', [CampaignController::class, 'destroy'])->name('campaigns.destroy');
Route::post('/campaigns/{campaign}/duplicate', [CampaignController::class, 'duplicate'])->name('campaigns.duplicate');
Route::get('/campaigns/{campaign}/view-email', [CampaignController::class, 'viewEmail'])->name('campaigns.view-email');


// MESSAGE TEMPLATES
Route::get('/message-temp', [MessageTemplateController::class, 'index'])->name('templates.index');
Route::get('/template-form', [MessageTemplateController::class, 'create'])->name('templates.create');
Route::post('/template-form', [MessageTemplateController::class, 'store'])->name('templates.store');
Route::get('/template-form/{id}/edit', [MessageTemplateController::class, 'edit'])->name('templates.edit');
Route::put('/template-form/{id}', [MessageTemplateController::class, 'update'])->name('templates.update');
Route::delete('/template-form/{id}', [MessageTemplateController::class, 'destroy'])->name('templates.destroy');

//TEMPLATE ADDING 
Route::get('/audience/template-form', [MessageTemplateController::class, 'create'])->name('templates.create');

// AUDIENCE - DASHBOARDS
Route::get('/audience/dashboards', [AudienceDashboardController::class, 'dashboards'])->name('audience.dashboards');


// AUDIENCE - CONTACTS
Route::get('/audience', [ContactController::class, 'index'])->name('contacts.index');
Route::get('/add-contact', [ContactController::class, 'create'])->name('contacts.create');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
Route::delete('/contacts/delete-selected', [ContactController::class, 'deleteSelected'])->name('contacts.deleteSelected');
Route::put('/contacts/{id}', [ContactController::class, 'update'])->name('contacts.update');
Route::get('/import-contacts', [ContactController::class, 'showImportForm'])->name('contacts.import.form');
Route::post('/import-contacts', [ContactController::class, 'import'])->name('contacts.import');
Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
Route::get('/contacts/export', [ContactController::class, 'export'])->name('contacts.export');
Route::post('/import-contacts', [ApiContactImportController::class, 'import'])
     ->name('contacts.import');


// AUDIENCE - INBOX
Route::get('/audience/inbox', [InboxController::class, 'index'])->name('inbox');
Route::get('/inbox-settings', [InboxController::class, 'settings'])->name('inbox.settings');

// AUDIENCE - LABELS
Route::get('audience/add-labels', [LabelController::class, 'index'])->name('labels.index');       // show the labels page
Route::post('audience/add-labels', [LabelController::class, 'store'])->name('labels.add');         // add a new label
Route::delete('audience/delete-label/{id}', [LabelController::class, 'destroy'])->name('labels.delete'); // delete a label

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
Route::get('/audience/dashboards', [AudienceDashboardController::class, 'index'])->name('dashboard.index');
