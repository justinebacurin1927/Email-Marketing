# Source Tree Analysis — SendFlow

```
sendflow/
├── app/                           # Application core
│   ├── Console/
│   │   └── Commands/
│   │       ├── ProcessAutomations.php      # automations:process — runs automation triggers every minute
│   │       └── SendScheduledCampaigns.php  # campaigns:send-scheduled — dispatches scheduled campaigns
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Api/                        # REST API controllers
│   │   │   │   └── ApiContactController.php
│   │   │   ├── AudienceController.php      # Audience dashboard
│   │   │   ├── AutomationController.php    # Automation CRUD + toggle
│   │   │   ├── CampaignController.php      # Campaign CRUD + send + preview + duplicate
│   │   │   ├── ContactController.php       # Contact CRUD + import/export
│   │   │   ├── InboxController.php         # Message inbox
│   │   │   ├── LabelController.php         # Label CRUD
│   │   │   ├── MessageTemplateController.php # Template CRUD
│   │   │   ├── ProfileController.php       # User profile + avatar
│   │   │   ├── SourceController.php        # Source CRUD
│   │   │   └── TagController.php           # Tag CRUD + bulk delete
│   │   └── Controller.php                  # Base controller
│   ├── Imports/
│   │   └── ContactsImport.php              # CSV import logic (maatwebsite/excel)
│   ├── Jobs/
│   │   └── SendCampaignJob.php             # Queued job — sends campaign emails to recipients
│   ├── Mail/
│   │   ├── CampaignMail.php                # Mailable for campaign sends
│   │   └── CampaignMailForContact.php      # Mailable for automation-triggered sends
│   ├── Models/
│   │   ├── ApiContact.php                  # API contacts model
│   │   ├── Automation.php                  # Automation workflows
│   │   ├── AutomationLog.php               # Execution audit log
│   │   ├── AutomationStep.php              # Workflow steps with delays
│   │   ├── Campaign.php                    # Campaigns with pivot-based recipients
│   │   ├── Contact.php                     # Audience contacts
│   │   ├── Label.php                       # Categorization labels
│   │   ├── Message.php                     # Inbox messages
│   │   ├── MessageTemplate.php             # Email templates
│   │   ├── Source.php                      # Contact sources
│   │   ├── Tag.php                         # Contact tags
│   │   └── User.php                        # Authenticated users
│   └── Providers/
│       ├── AppServiceProvider.php
│       ├── AuthServiceProvider.php
│       ├── EventServiceProvider.php
│       └── RouteServiceProvider.php
├── bootstrap/                     # Laravel bootstrap
├── config/                        # Application configuration (11 files)
├── database/
│   ├── database.sqlite            # SQLite database file
│   ├── factories/
│   ├── migrations/                # 26 migration files
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── SampleDataSeeder.php   # Sample contacts, tags, templates, campaigns
├── resources/
│   ├── css/                       # Tailwind CSS entry
│   ├── js/                        # Alpine.js + Axios
│   └── views/
│       ├── audience/              # Audience management views
│       ├── automations/           # Automation create/edit/index
│       ├── campaigns/             # Campaign CRUD + preview + view-email
│       ├── components/            # Shared Blade components
│       ├── dashboard/             # Dashboard with charts + stats
│       └── layouts/               # App layout (sidebar + topbar)
├── routes/
│   ├── api.php                    # API routes (/api/contacts)
│   ├── console.php                # Console command routes
│   └── web.php                    # All web routes (dashboard, CRUD, etc.)
├── storage/                       # Logs, cache, compiled views
├── tests/
│   ├── Feature/                   # Feature tests
│   ├── Unit/                      # Unit tests
│   └── TestCase.php               # Base test case
├── public/                        # Public assets (build output)
├── vendor/                        # Composer dependencies
├── node_modules/                  # NPM dependencies
├── composer.json
├── package.json
├── tailwind.config.js
├── vite.config.js
├── docker-compose.yml
└── Dockerfile
```

## Critical Folders

| Folder | Purpose | Entry Points |
|---|---|---|
| `app/Http/Controllers/` | All web + API controllers handling HTTP requests | CampaignController, AutomationController, ContactController |
| `app/Models/` | Eloquent ORM models with relationships | Campaign, Contact, Automation, MessageTemplate |
| `app/Jobs/` | Queueable job classes | SendCampaignJob |
| `app/Console/Commands/` | Artisan CLI commands | SendScheduledCampaigns, ProcessAutomations |
| `app/Mail/` | Mailable classes for email sending | CampaignMail, CampaignMailForContact |
| `resources/views/` | Blade template views | layouts/, campaigns/, automations/, dashboard/ |
| `routes/` | Route definitions | web.php (main), api.php (REST) |
| `database/migrations/` | Database schema migrations | 26 migration files |
