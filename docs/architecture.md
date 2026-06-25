# Architecture — SendFlow

## Executive Summary

SendFlow follows the standard Laravel MVC architecture with queue-based async processing for email delivery and automation workflows. The application uses SQLite as its database, Tailwind CSS for styling, and Vite for asset bundling. Email delivery uses Gmail SMTP via Symfony Mailer.

## Technology Stack

| Layer | Technology | Version |
|---|---|---|
| Backend | Laravel (PHP) | 12.x / ^8.2 |
| Database | SQLite | - |
| Frontend | Blade + Tailwind CSS + Alpine.js | Tailwind 4.x |
| Queue | Database queue driver | - |
| Email | Symfony Mailer (SMTP) | 7.4 |
| Auth | Laravel Sanctum | 4.x |
| Asset Bundler | Vite | 7.x |
| HTTP Client | Axios | 1.x |

## Architecture Pattern

MVC (Model-View-Controller) with service-layer patterns:

- **Models** — Eloquent ORM models with relationships, scopes, and accessors
- **Controllers** — Thin controllers handling request validation, authorization, and delegation
- **Views** — Blade templates with Tailwind CSS, organized by feature
- **Jobs** — Queueable jobs for async email delivery (database queue)
- **Commands** — Artisan CLI commands for scheduled tasks (campaign sending, automation processing)
- **Mailables** — Mailable classes for building and sending email content

## Data Architecture

### Core Tables

| Table | Purpose | Relationships |
|---|---|---|
| `contacts` | Audience contacts with subscription status | Many-to-many: tags, campaigns |
| `tags` | Contact tags for segmentation | Many-to-many: contacts, campaigns |
| `labels` | Categorization labels | Standalone |
| `sources` | Contact source/origin tracking | One-to-many: contacts |
| `message_templates` | Email templates (name, subject, HTML body) | One-to-many: campaigns |
| `campaigns` | Campaign definitions with status tracking | Many-to-many: contacts, tags; belongs-to: template |
| `messages` | Inbox/message records | Standalone |

### Pivot Tables

| Table | Purpose |
|---|---|
| `contact_tag` | Many-to-many contacts ↔ tags |
| `campaign_contact` | Many-to-many campaigns ↔ contacts |
| `campaign_tag` | Many-to-many campaigns ↔ tags |

### Automation Tables

| Table | Purpose |
|---|---|
| `automations` | Workflow definitions (trigger_type, status, trigger_config) |
| `automation_steps` | Ordered steps (delay_days, action_type, action_config) |
| `automation_logs` | Execution audit logs per step + contact (status, error, processed_at) |

## API Design

Minimal REST API surface under `/api/`:

| Method | Path | Purpose |
|---|---|---|
| GET | `/api/contacts` | List all contacts |
| POST | `/api/contacts` | Create a new contact |

Authentication: Laravel Sanctum token-based.

## Component Overview

### Web Controllers (11 controllers)
- **CampaignController** — Index, create, store, edit, update, destroy, duplicate, preview, viewEmail, send
- **AutomationController** — Index, create, store, edit, update, destroy, toggle
- **ContactController** — Index, create, store, update, deleteSelected, showImportForm, import, export
- **MessageTemplateController** — Index, create, store, edit, update, destroy
- **TagController** — Index, store, update, destroy, bulkDestroy
- **LabelController** — Index, store, destroy, update
- **SourceController** — Index, store, destroy
- **InboxController** — Index, settings
- **ProfileController** — Index, update, password, uploadAvatar, removeAvatar
- **AudienceController** — Dashboard view
- **ApiContactController** — API CRUD for contacts

### Queueable Jobs
- **SendCampaignJob** — Dispatched per campaign, iterates allRecipients() and sends CampaignMail via SMTP. Filters subscribed contacts only. Updates campaign to `sent` status with timestamp.

### Console Commands
- **campaigns:send-scheduled** — Runs every minute, finds scheduled campaigns past send_date, dispatches SendCampaignJob
- **automations:process** — Runs every minute, processes contact_created, tag_added, and birthday triggers, executes pending steps

### Mailables
- **CampaignMail** — Builds email from template subject + body for campaign sends
- **CampaignMailForContact** — Mailable for automation-triggered sends with contact context

## Source Tree

See [source-tree-analysis.md](./source-tree-analysis.md)

## Development Workflow

See [development-guide.md](./development-guide.md)

## Deployment Architecture

See [deployment-guide.md](./deployment-guide.md)

## Testing Strategy

PHPUnit tests split into Feature and Unit test directories. Run with `composer test` or `php artisan test`.
