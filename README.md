# SendFlow — Email Marketing Platform

An original email marketing application built with Laravel, featuring campaign management, audience segmentation, automation workflows, and real email delivery via SMTP.

## Features

### Dashboard
- Live-updating date/time clock in the top bar
- Dynamic greeting with authenticated user's name
- Stat cards (Contacts, Subscribers, Campaigns, Templates) with live database counts and dark gradient backgrounds
- Bar chart + doughnut chart analytics (Sent vs Draft vs Scheduled campaigns)
- Quick action icon tiles with hover effects
- Recent campaigns list with status badges

### Campaigns
- Full CRUD with create, edit, duplicate, and delete
- Multi-recipient support via **pivot tables** — select individual contacts and/or tag groups
- Email preview (renders template in an iframe with recipient list sidebar)
- Send Now dispatches immediately via `SendCampaignJob`
- Scheduled sending via `campaigns:send-scheduled` Artisan command
- Tracks `sent_at` timestamp

### Audience
- Contact management with tags, labels, and source tracking
- Multi-tag assignment per contact
- Import/export contacts via CSV
- Subscriber status tracking

### Automation Workflows
- **Trigger types:** Contact Created, Tag Added, Birthday, Date Based
- **Step actions:** Send Email, Add Tag, Remove Tag
- Configurable delay (days) between steps
- Multi-step sequences (e.g., Wait 1d → Send Welcome, Wait 3d → Send Follow-up)
- Processed every minute via `automations:process` scheduler
- Full audit log (`automation_logs`) with success/failure tracking
- Pause/activate toggles on each workflow

### Email Sending
- **Gmail SMTP** integration with App Password authentication
- Mailable classes for campaign and automation emails
- Queueable job dispatching
- Uses template body as email content with custom subject lines

### Design
- **Color palette:** Navy (`#1a1a2e`, `#16213e`), Coral (`#e94560`, `#c23152`), Purple (`#533483`), Deep Blue (`#0f3460`)
- Fully responsive sidebar with SendFlow branding
- All Mailchimp-copy UI removed (collapsible menus, fake analytics, upsells, etc.)

## Database Schema

### Core Tables
| Table | Purpose |
|---|---|
| `contacts` | Audience members with email, name, subscription status |
| `tags` | Tag labels for segmentation |
| `labels` | Categorization labels |
| `sources` | Contact source/origin tracking |
| `message_templates` | Email templates with name, subject, HTML body |
| `campaigns` | Campaigns with status (draft/scheduled/sent), type, template |
| `messages` | Message/Inbox records |

### Pivot Tables
| Table | Purpose |
|---|---|
| `contact_tag` | Many-to-many contacts ↔ tags |
| `campaign_contact` | Many-to-many campaigns ↔ contacts |
| `campaign_tag` | Many-to-many campaigns ↔ tags |

### Automation Tables
| Table | Purpose |
|---|---|
| `automations` | Workflow definitions (trigger type, status) |
| `automation_steps` | Ordered steps per workflow (delay, action) |
| `automation_logs` | Execution logs per step + contact |

### Other
| Table | Purpose |
|---|---|
| `campaigns` (columns) | `send_date`, `sent_at`, `template_id`, `created_by` |
| `message_templates` (columns) | `subject`, `body`, `name` |

## Setup

```bash
cp .env.example .env
# Configure database credentials in .env
# Configure MAIL_* for SMTP delivery

php artisan migrate
php artisan db:seed --class=SampleDataSeeder
php artisan serve --port=8001
```

### SMTP (Gmail)
1. Enable **2-factor authentication** on your Google account
2. Generate an **App Password** at https://myaccount.google.com/apppasswords
3. Set in `.env`:
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME="your.email@gmail.com"
MAIL_PASSWORD="your-16-char-app-password"
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your.email@gmail.com"
```

### Scheduler (Required for Automations + Scheduled Campaigns)
```bash
php artisan schedule:work
```

Or add to crontab:
```
* * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
```

## Seeded Sample Data

Running `php artisan db:seed --class=SampleDataSeeder` creates:
- **7 tags** (Newsletter, VIP, New Lead, Returning Customer, Test, Trial User, Premium)
- **4 labels** (Important, Follow Up, Archive, Spam)
- **1 source** (marketing@example.com)
- **5 contacts** (Alice, Bob, Carol, Dave, Eve) with various tags
- **3 templates** (Welcome Email, Monthly Newsletter, Promotional Offer)
- **3 campaigns** (Welcome Campaign - sent, March Newsletter - draft with tag targeting, Summer Sale - scheduled)

## Artisan Commands

| Command | Schedule | Purpose |
|---|---|---|
| `campaigns:send-scheduled` | Every minute | Sends campaigns with `scheduled` status whose `send_date` has passed |
| `automations:process` | Every minute | Processes active automation triggers and executes pending steps |

## Key Files

| File | Purpose |
|---|---|
| `app/Mail/CampaignMail.php` | Mailable for single-contact campaign sends |
| `app/Mail/CampaignMailForContact.php` | Mailable for automation-triggered sends |
| `app/Jobs/SendCampaignJob.php` | Queueable job dispatching campaign emails |
| `app/Console/Commands/SendScheduledCampaigns.php` | Scheduled campaign sender |
| `app/Console/Commands/ProcessAutomations.php` | Automation workflow processor |
| `app/Http/Controllers/CampaignController.php` | Campaign CRUD + send + preview + duplicate |
| `app/Http/Controllers/AutomationController.php` | Automation CRUD with multi-step support |
| `app/Models/Automation.php` | Automation model with `allRecipients()` helper |
| `database/seeders/SampleDataSeeder.php` | Sample data for development |
| `resources/views/dashboard/index.blade.php` | Dashboard with charts, stats, quick actions |
| `resources/views/automations/` | Automation index, create, edit views |

## Routes

### Campaigns
- `GET /campaigns` — List all campaigns
- `GET /campaigns/create` — Create form
- `POST /campaigns` — Store
- `GET /campaigns/{id}/edit` — Edit form
- `PUT /campaigns/{id}` — Update
- `DELETE /campaigns/{id}` — Delete
- `POST /campaigns/{id}/send` — Send now
- `GET /campaigns/{id}/preview` — Email preview
- `POST /campaigns/{id}/duplicate` — Duplicate
- `GET /campaigns/{id}/view-email` — View rendered email

### Automations
- `GET /automations` — List all workflows
- `GET /automations/create` — Create form
- `POST /automations` — Store
- `GET /automations/{id}/edit` — Edit form
- `PUT /automations/{id}` — Update
- `DELETE /automations/{id}` — Delete
- `POST /automations/{id}/toggle` — Pause/activate

### Audience
- `GET /audience` — Contacts list
- `GET /add-contact` — Create contact
- `GET /import-contacts` — CSV import
- `GET /audience/dashboards` — Audience dashboard
- `GET /audience/audience-tags` — Tag management
- `GET /audience/inbox` — Inbox

### Templates
- `GET /message-temp` — List templates
- `GET /template-form` — Create/edit template
