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

### Inbox (Inbound Email)
- Real-time inbox at `/audience/inbox` — messages loaded from the database (no hardcoded mock data)
- **Tabs:** To Do (unread), Done (read), Trash, All
- **Filtering:** By source type (Email Marketing / Contact Form) and labels
- **Search:** Client-side filtering by sender name, subject, or body
- **Message detail panel:** Shows sender, subject, body, and source badge
- **Actions:** Trash (soft), Delete (permanent), Reply (opens email client)
- **Mailgun webhook integration:** Inbound route at `/webhooks/mailgun/inbound` (CSRF-exempt) parses incoming replies, links them to subscribed contacts, and saves to the database
- **Subscriber-only filtering:** Only emails from subscribed contacts are saved; non-subscribers are silently dropped

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
| `messages` | Message/Inbox records — sender name/email, subject, body, linked contact, read/trash status, source type |

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
```

### Run Development Server

```bash
composer dev
```

Starts the Laravel dev server (port 8000), queue worker, log tailing, and Vite HMR (port 5173).

### Inbox & Inbound Email (Mailgun)

1. Create a **Mailgun** account (free tier includes 1 inbound route)
2. Add and verify a **custom domain** in Mailgun (or use the sandbox domain for testing)
3. Set up an **inbound route** in Mailgun:
   - Expression: `catch_all` (or `match_recipient(".*@yourdomain.com")`)
   - Action: `Forward`
   - Destination: `https://your-tunnel-url.ngrok-free.dev/webhooks/mailgun/inbound`
4. Make your app publicly accessible (for local development):
   ```bash
   ngrok http 8088
   ```
5. The webhook endpoint is CSRF-exempt and responds with `200 OK` to all Mailgun requests
6. Only emails from **subscribed contacts** are saved to the inbox; others are silently dropped

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
| `app/Http/Controllers/MailgunWebhookController.php` | Mailgun inbound webhook handler — parses sender/subject/body, links to contact, saves |
| `app/Http/Controllers/InboxController.php` | Inbox view, mark-read, trash, delete actions |
| `resources/views/audience/inbox.blade.php` | Inbox page with tabs, search, filters, message detail, actions |
| `resources/views/audience/inbox-test.php` | Test form to simulate incoming emails |
| `database/migrations/2026_06_25_062338_add_inbound_fields_to_messages_table.php` | Added sender fields, contact_id, read/trash status, source_type to messages |

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
- `GET /audience/inbox` — Inbox (real messages from DB)
- `POST /inbox/{id}/read` — Mark message as read
- `POST /inbox/{id}/trash` — Move message to trash
- `DELETE /inbox/{id}` — Permanently delete message

### Webhooks
- `POST /webhooks/mailgun/inbound` — Mailgun inbound email receiver (CSRF-exempt)

### Testing
- `GET /inbox/test` — Simulate an incoming email (fill form to create a test message in inbox)

### Templates
- `GET /message-temp` — List templates
- `GET /template-form` — Create/edit template
