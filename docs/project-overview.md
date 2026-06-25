# SendFlow — Email Marketing Platform

## Executive Summary

SendFlow is a full-featured email marketing application built with Laravel 12. It provides campaign management, audience segmentation via tags, automation workflows with multi-step sequences, email template management, and real email delivery via SMTP. The application features a modern dashboard with real-time analytics, charts, and quick-action tiles.

## Tech Stack Summary

| Category | Technology | Version | Purpose |
|---|---|---|---|
| Framework | Laravel | 12.x | PHP web framework |
| Language | PHP | ^8.2 | Backend runtime |
| Database | SQLite | - | Primary data store |
| Frontend | Blade + Tailwind CSS | 4.x | Server-rendered UI |
| Build Tool | Vite | 7.x | Asset bundling |
| JS Libraries | Alpine.js, Axios | - | Interactive UI, HTTP client |
| Queue | Laravel Queues (database) | - | Async job processing |
| Authentication | Laravel Sanctum | 4.x | API tokens & session auth |
| Testing | PHPUnit | 11.x | Unit & feature tests |
| CSV Import | maatwebsite/excel | 3.1 | Bulk contact import |
| Email | Symfony Mailer (SMTP) | 7.4 | Email delivery via Gmail SMTP |

## Architecture Type

Monolithic Laravel MVC application with service-layer patterns for automations and campaign dispatching.

## Repository Structure

Single cohesive codebase (monolith). All application code lives under `app/` with Blade views in `resources/views/`.

## Key Features

- **Dashboard**: Live clock, stats cards, campaign analytics charts (bar + doughnut), quick action tiles, recent campaigns list
- **Campaigns**: Full CRUD with duplicate, draft/scheduled/sent statuses, multi-recipient via contacts and tag groups, email preview (iframe), send-now via queued job
- **Audience**: Contact management with multi-tag assignment, CSV import/export, subscriber tracking, inbox/message records
- **Tags & Labels**: Many-to-many contact tagging, categorization labels, source tracking
- **Templates**: HTML email templates with name, subject, body
- **Automation Workflows**: Trigger types (contact_created, tag_added, birthday, date_based), multi-step sequences with delays, action types (send_email, add_tag, remove_tag), audit logging, pause/activate toggle
- **API**: Minimal REST API for contact CRUD
