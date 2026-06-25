<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\MessageTemplateController;
use App\Http\Controllers\LabelController;

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\MailgunWebhookController;
use App\Http\Controllers\ProfileController;

// DASHBOARD & PAGES
Route::get('/', fn() => view('dashboard.index'));
Route::get('/automation', fn() => redirect()->route('automations.index'));
Route::get('/automations', [App\Http\Controllers\AutomationController::class, 'index'])->name('automations.index');
Route::get('/automations/create', [App\Http\Controllers\AutomationController::class, 'create'])->name('automations.create');
Route::post('/automations', [App\Http\Controllers\AutomationController::class, 'store'])->name('automations.store');
Route::get('/automations/{automation}/edit', [App\Http\Controllers\AutomationController::class, 'edit'])->name('automations.edit');
Route::put('/automations/{automation}', [App\Http\Controllers\AutomationController::class, 'update'])->name('automations.update');
Route::delete('/automations/{automation}', [App\Http\Controllers\AutomationController::class, 'destroy'])->name('automations.destroy');
Route::post('/automations/{automation}/toggle', [App\Http\Controllers\AutomationController::class, 'toggle'])->name('automations.toggle');

// CAMPAIGNS
Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaigns.index');
Route::get('/campaigns/create', [CampaignController::class, 'create'])->name('campaigns.create');
Route::post('/campaigns', [CampaignController::class, 'store'])->name('campaigns.store');
Route::get('/campaigns/{campaign}/edit', [CampaignController::class, 'edit'])->name('campaigns.edit');
Route::put('/campaigns/{campaign}', [CampaignController::class, 'update'])->name('campaigns.update');
Route::delete('/campaigns/{campaign}', [CampaignController::class, 'destroy'])->name('campaigns.destroy');
Route::post('/campaigns/{campaign}/duplicate', [CampaignController::class, 'duplicate'])->name('campaigns.duplicate');
Route::get('/campaigns/{campaign}/view-email', [CampaignController::class, 'viewEmail'])->name('campaigns.view-email');
Route::post('/campaigns/{campaign}/send', [CampaignController::class, 'send'])->name('campaigns.send');
Route::get('/campaigns/{campaign}/preview', [CampaignController::class, 'preview'])->name('campaigns.send-preview');

// MESSAGE TEMPLATES
Route::get('/message-temp', [MessageTemplateController::class, 'index'])->name('templates.index');
Route::get('/template-form', [MessageTemplateController::class, 'create'])->name('templates.create');
Route::post('/template-form', [MessageTemplateController::class, 'store'])->name('templates.store');
Route::get('/template-form/{id}/edit', [MessageTemplateController::class, 'edit'])->name('templates.edit');
Route::put('/template-form/{id}', [MessageTemplateController::class, 'update'])->name('templates.update');
Route::delete('/template-form/{id}', [MessageTemplateController::class, 'destroy'])->name('templates.destroy');

// AUDIENCE - DASHBOARDS (redirected to main dashboard)
Route::get('/audience/dashboards', fn() => redirect('/'))->name('audience.dashboards');

// AUDIENCE - CONTACTS
Route::get('/audience', [ContactController::class, 'index'])->name('contacts.index');
Route::get('/add-contact', [ContactController::class, 'create'])->name('contacts.create');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
Route::delete('/contacts/delete-selected', [ContactController::class, 'deleteSelected'])->name('contacts.deleteSelected');
Route::put('/contacts/{id}', [ContactController::class, 'update'])->name('contacts.update');
Route::get('/import-contacts', [ContactController::class, 'showImportForm'])->name('contacts.import.form');
Route::post('/import-contacts', [ContactController::class, 'import'])->name('contacts.import');
Route::get('/contacts/export', [ContactController::class, 'export'])->name('contacts.export');

// AUDIENCE - INBOX
Route::get('/audience/inbox', [InboxController::class, 'index'])->name('inbox');
Route::get('/inbox-settings', [InboxController::class, 'settings'])->name('inbox.settings');
Route::post('/inbox/{message}/read', [InboxController::class, 'markRead'])->name('inbox.mark-read');
Route::post('/inbox/{message}/trash', [InboxController::class, 'trash'])->name('inbox.trash');
Route::delete('/inbox/{message}', [InboxController::class, 'destroy'])->name('inbox.destroy');

// AUDIENCE - LABELS
Route::get('audience/add-labels', [LabelController::class, 'index'])->name('labels.index');
Route::post('audience/add-labels', [LabelController::class, 'store'])->name('labels.add');
Route::delete('audience/delete-label/{id}', [LabelController::class, 'destroy'])->name('labels.delete');
Route::put('audience/rename-label/{id}', [LabelController::class, 'update'])->name('labels.update');

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
Route::get('/tags', [TagController::class, 'index'])->name('tags.index');

// PROFILE
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::put('/profile/password', [ProfileController::class, 'password'])->name('profile.password');
Route::post('/profile/avatar', [ProfileController::class, 'uploadAvatar'])->name('profile.avatar.upload');
Route::delete('/profile/avatar', [ProfileController::class, 'removeAvatar'])->name('profile.avatar.remove');

// WEBHOOKS
Route::post('/webhooks/mailgun/inbound', [MailgunWebhookController::class, 'inbound'])->name('webhooks.mailgun.inbound');

// TEST — simulate receiving an email (remove later)
Route::get('/inbox/test', function () {
    return view('audience.inbox-test');
});
Route::post('/inbox/test', function (\Illuminate\Http\Request $request) {
    \App\Models\Message::create([
        'sender_name' => $request->name,
        'sender_email' => $request->email,
        'subject' => $request->subject,
        'body' => $request->body,
        'source_type' => 'email_marketing',
    ]);
    return redirect('/audience/inbox');
});
