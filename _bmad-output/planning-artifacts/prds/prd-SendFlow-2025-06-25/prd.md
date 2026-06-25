---
title: SendFlow Email Marketing Platform
created: 2025-06-25
updated: 2025-06-25
status: draft
---

# PRD: SendFlow Email Marketing Platform

## 0. Document Purpose

This PRD documents the existing SendFlow email marketing application for downstream workflow owners (UX, architecture, epics/stories, sprint planning). It captures the current feature set, data model, architecture, and identifies improvement opportunities. The project is fully built (brownfield); this PRD serves as the canonical reference for future iteration planning.

Supporting documentation is in `docs/`: [Project Overview](../../docs/project-overview.md), [Architecture](../../docs/architecture.md), [Source Tree Analysis](../../docs/source-tree-analysis.md), [Data Models](../../docs/data-models.md), [API Contracts](../../docs/api-contracts.md).

## 1. Vision

SendFlow is an email marketing platform that empowers businesses to manage their audience, create campaigns, and automate email workflows — all from a single application. It provides campaign management with multi-recipient targeting (individual contacts and tag groups), a drag-free automation engine with multi-step sequences, and real SMTP-based email delivery. The dashboard gives operators real-time visibility into campaign performance, audience growth, and sending activity.

## 2. Target User

### 2.1 Jobs To Be Done

- As a **marketing operator**, I want to create and send email campaigns to segmented audiences so I can reach the right people with the right message.
- As a **growth manager**, I want to set up automated email sequences triggered by user actions so I can nurture leads without manual work.
- As an **admin**, I want to import/export my contact list, manage tags and labels, and see campaign performance at a glance.
- As a **business owner**, I want to track which campaigns have been sent, when, and to whom so I can measure marketing ROI.

### 2.2 Key User Journeys

- **UJ-1. Maria launches a promotional campaign.**
  - **Persona + context:** Maria, a marketing manager at an e-commerce store, needs to send a "Summer Sale" promotion to her VIP customers.
  - **Entry state:** Logged into SendFlow dashboard.
  - **Path:** Clicks Campaigns → Create → Names campaign "Summer Sale" → Selects "Summer Sale" template → Selects "VIP" tag as recipient group → Sets status to "Scheduled" with a send date → Clicks Save.
  - **Climax:** Campaign appears in the list with "scheduled" status and the scheduled date visible.
  - **Resolution:** On the scheduled date, the campaign sends automatically. Maria returns to see "sent" status with timestamp.

- **UJ-2. Carlos automates a welcome sequence.**
  - **Persona + context:** Carlos manages onboarding for a SaaS product. New signups should receive a welcome email, then a feature highlight 3 days later.
  - **Entry state:** Logged into SendFlow, on the Automations page.
  - **Path:** Clicks Create Automation → Names it "New User Welcome" → Selects trigger "Contact Created" → Adds Step 1: Send Email (Welcome template, delay 0 days) → Adds Step 2: Send Email (Feature Highlight template, delay 3 days) → Saves → Status is "Active".
  - **Climax:** Automation appears in the list with "active" status and 2 steps visible.
  - **Resolution:** New contacts automatically receive the sequence. Carlos can view the automation log to verify execution.

- **UJ-3. Priya monitors campaign performance.**
  - **Persona + context:** Priya is a business owner who wants to see at a glance how her marketing is performing.
  - **Entry state:** Logged into SendFlow, lands on the Dashboard.
  - **Path:** Sees stat cards (Contacts: 1,250, Subscribers: 980, Campaigns: 12, Templates: 5) → Reviews bar chart of sent vs draft vs scheduled → Checks doughnut chart for campaign status breakdown → Scans the recent campaigns list.
  - **Climax:** Priya identifies that 3 campaigns are still in draft and needs to follow up with the team.
  - **Resolution:** Clicks into Campaigns to take action on the drafts.

## 3. Glossary

- **Campaign** — A named email send targeting a set of recipients via contacts and/or tag groups. Statuses: draft, scheduled, sent.
- **Contact** — An individual in the audience with email, name, subscription status, and optional attributes (company, phone, birthday, address).
- **Tag** — A label assigned to contacts for segmentation (e.g., VIP, Newsletter). Many-to-many with contacts and campaigns.
- **Label** — A categorization label for organizational purposes (Important, Follow Up, Archive, Spam).
- **Source** — The origin/origin tracking for contacts (e.g., marketing@example.com).
- **Message Template** — An HTML email template with name, subject, and body content. Associated with campaigns.
- **Automation** — A workflow definition with a trigger type and ordered steps. Trigger types: contact_created, tag_added, birthday, date_based.
- **Automation Step** — A single action within a workflow with a delay (in days). Action types: send_email, add_tag, remove_tag.
- **Automation Log** — An audit record of step execution per contact, with status (pending/completed/failed) and error tracking.
- **Dashboard** — The main landing page with real-time stats, campaign analytics charts, quick actions, and recent campaigns list.

## 4. Features

### 4.1 Dashboard & Analytics

**Description:** The dashboard serves as the primary landing page, providing operators with real-time visibility into key metrics. It features a live clock, a dynamic greeting with the authenticated user's name, stat cards with live database counts and dark gradient backgrounds, a bar chart comparing sent vs draft vs scheduled campaigns, a doughnut chart showing campaign status distribution, quick action icon tiles with hover effects, and a recent campaigns list with status badges. Realizes UJ-3.

**Functional Requirements:**

#### FR-1: Display live dashboard stats

The system displays count-based stat cards (Contacts, Subscribers, Campaigns, Templates) sourced from live database queries. Realizes UJ-3.

**Consequences (testable):**
- Each stat card shows the correct count from the database.
- Counts update on page refresh to reflect latest database state.

#### FR-2: Render campaign analytics charts

The system renders a bar chart (Sent vs Draft vs Scheduled campaigns) and a doughnut chart (campaign status breakdown). Realizes UJ-3.

**Consequences (testable):**
- Bar chart accurately reflects campaign counts by status.
- Doughnut chart sums to total campaigns.

#### FR-3: Show recent campaigns list

The dashboard displays the most recent campaigns with name, status badge, and date. Realizes UJ-3.

**Consequences (testable):**
- List is ordered by send_date descending.
- Each campaign shows correct status badge color.

### 4.2 Campaign Management

**Description:** Full CRUD for email campaigns with multi-recipient support via pivot tables (individual contacts and/or tag groups). Campaigns can be created, edited, duplicated, deleted, previewed, and sent. Sending dispatches immediately via a queued job (`SendCampaignJob`). Scheduled sending is handled by the `campaigns:send-scheduled` Artisan command running every minute. Tracks `sent_at` timestamp. Realizes UJ-1.

**Functional Requirements:**

#### FR-4: Create campaign with recipient targeting

The operator can create a campaign with a name, template selection, status (draft/scheduled), optional send date, and recipient selection via individual contacts and/or tag groups. Realizes UJ-1.

**Consequences (testable):**
- Campaign is stored with all provided fields.
- If contact_ids are provided, campaign_contact pivot records are created.
- If tag_ids are provided, campaign_tag pivot records are created.
- Validation errors returned for missing required fields.

#### FR-5: Send campaign to recipients

The operator can trigger immediate sending of a draft/scheduled campaign. The system dispatches `SendCampaignJob` which iterates all resolved recipients (contacts + tag group members, deduplicated), filters to subscribed contacts with emails, and sends via SMTP. Realizes UJ-1.

**Consequences (testable):**
- Campaign status updates to `sent` after successful dispatch.
- `sent_at` timestamp is recorded.
- Re-sending a sent campaign returns an error.
- Sending a campaign with no recipients returns an error.
- Sending a campaign with no template returns an error.

#### FR-6: Schedule campaign for future delivery

The operator can set a campaign status to "scheduled" with a `send_date`. The `campaigns:send-scheduled` command runs every minute and dispatches campaigns whose `send_date` has passed. Realizes UJ-1.

**Consequences (testable):**
- Scheduled campaigns with past send_date are dispatched by the command.
- Scheduled campaigns with future send_date are skipped.
- Command logs dispatched campaign names.

#### FR-7: Duplicate campaign

The operator can duplicate an existing campaign including its recipient assignments (contacts and tags). The copy receives status "draft" and "(Copy)" appended to its name. Realizes UJ-1.

**Consequences (testable):**
- Duplicated campaign has status=draft regardless of original.
- All pivot records (campaign_contact, campaign_tag) are replicated.

#### FR-8: Preview campaign email

The operator can preview the rendered email template in an iframe with a recipient list sidebar. Realizes UJ-1.

**Consequences (testable):**
- Preview page loads with rendered template content.
- Recipient sidebar shows all resolved recipients.

### 4.3 Audience Management

**Description:** Contact management with multi-tag assignment via pivot tables. Supports import/export via CSV, subscriber status tracking, and tag/label/source management. Realizes UJ-1, UJ-3.

**Functional Requirements:**

#### FR-9: Manage contacts with CRUD

The operator can create, read, update, and delete contacts with fields: email, name, company, phone, birthday, address, subscription status. Realizes UJ-1.

**Consequences (testable):**
- Contact is stored with all provided fields.
- Email is unique across contacts.
- Deleted contacts cascade-remove pivot records.

#### FR-10: Import/export contacts via CSV

The operator can import contacts from a CSV file (via maatwebsite/excel) and export contacts to CSV. Realizes UJ-1.

**Consequences (testable):**
- CSV import creates new contact records from file data.
- CSV export produces a downloadable CSV with contact data.

#### FR-11: Manage tags with assignment

The operator can create, rename, delete, and bulk-delete tags. Tags can be assigned to contacts via the contact_tag pivot table. Tags can also be used as campaign recipient targets. Realizes UJ-1.

**Consequences (testable):**
- Tag CRUD operations work correctly.
- Contact-tag assignments are stored in pivot table.
- Deleting a tag cascades to pivot records.

### 4.4 Automation Workflows

**Description:** Multi-step automation workflows triggered by contact events. Trigger types: Contact Created, Tag Added, Birthday, Date Based. Step actions: Send Email, Add Tag, Remove Tag. Configurable delay (in days) between steps. Processed every minute via `automations:process` scheduler. Full audit log (`automation_logs`) with success/failure tracking. Pause/activate toggle on each workflow. Realizes UJ-2.

**Functional Requirements:**

#### FR-12: Create automation with multi-step sequence

The operator can create an automation workflow with a name, description, trigger type (contact_created, tag_added, birthday, date_based), optional trigger config, and one or more ordered steps with delay and action. Realizes UJ-2.

**Consequences (testable):**
- Automation is stored with all provided fields.
- Steps are created in the specified order with correct delay_days.
- Validation: at least one step required.
- Validation: step action types limited to send_email, add_tag, remove_tag.
- Conditional validation: template_id required for send_email, tag_id required for add_tag/remove_tag.

#### FR-13: Process automation triggers

The `automations:process` command processes active automations every minute. For each trigger type:
- **contact_created**: Identifies contacts created in the last 24h and executes pending steps.
- **tag_added**: Identifies contacts with the configured trigger tag and executes pending steps.
- **birthday**: Identifies contacts whose birthday matches today and executes steps (once per day).
Realizes UJ-2.

**Consequences (testable):**
- Each step is executed at most once per contact (deduplicated via automation_logs).
- Delayed steps only execute after the configured delay_days has passed.
- Executed steps record a log entry with status "completed".
- Failed steps record a log entry with status "failed" and error message.

#### FR-14: Toggle automation status

The operator can pause or activate an automation workflow. Paused automations are skipped during processing. Realizes UJ-2.

**Consequences (testable):**
- Toggling an active automation sets status to "paused".
- Toggling a paused automation sets status to "active".
- Paused automations are excluded from `byTrigger` scope.

### 4.5 Email Templates

**Description:** HTML email templates with name, subject, and body. Associated with campaigns and automation steps. Rendered inline for preview and SMTP delivery.

**Functional Requirements:**

#### FR-15: Manage email templates

The operator can create, read, update, and delete email templates with name, subject, and HTML body.

**Consequences (testable):**
- Template CRUD operations work correctly.
- Template body is stored as HTML text.
- Deleting a template used by a campaign returns a foreign key constraint error (or is prevented).

### 4.6 Email Delivery

**Description:** Email delivery via Gmail SMTP with App Password authentication. Uses Symfony Mailer. Mailable classes for campaign and automation emails. Queueable job dispatching.

**Functional Requirements:**

#### FR-16: Send campaign emails via SMTP

The system sends campaign emails to each recipient via SMTP using the template's subject and body content. Filters to subscribed contacts only.

**Consequences (testable):**
- Each recipient receives an email with the correct template subject and body.
- Unsubscribed contacts are excluded from delivery.
- Non-subscribed contacts (subscribed=false) are filtered out.

#### FR-17: Send automation emails via SMTP

The system sends automation-triggered emails to individual contacts via SMTP using the specified template.

**Consequences (testable):**
- Automation step with send_email action sends an email to the contact.
- Missing template_id in step config silently skips sending (no error thrown).

### 4.7 Profile & Settings

**Description:** User profile management with avatar upload/remove and password change.

**Functional Requirements:**

#### FR-18: Manage user profile

The authenticated user can update their profile name and email, change password, and upload/remove an avatar image.

**Consequences (testable):**
- Profile updates persist to the users table.
- Password changes require current password confirmation.
- Avatar upload saves the image file.
- Avatar removal clears the avatar field.

## 5. Non-Goals (Explicit)

- SendFlow is not a full CRM — it does not manage deals, pipelines, or sales stages.
- SendFlow is not an email delivery service — it does not provide its own SMTP infrastructure.
- SendFlow does not support A/B testing of campaign content.
- SendFlow does not provide advanced analytics (opens, clicks, bounces) — it only tracks send status and timestamps.
- SendFlow does not support multi-tenant or team collaboration features.
- SendFlow does not provide a public API beyond basic contact CRUD.

## 6. MVP Scope

### 6.1 In Scope (Existing)

- Dashboard with live stats and campaign analytics
- Campaign CRUD with multi-recipient targeting (contacts and tags)
- Campaign send (immediate and scheduled) via queued jobs
- Campaign duplicate, preview, and email rendering
- Audience management with contact CRUD and CSV import/export
- Tag, label, and source management
- Email template CRUD
- Automation workflows with 4 trigger types and 3 action types
- Multi-step automation sequences with configurable delays
- Automation audit logging
- SMTP email delivery (Gmail)
- User profile and avatar management
- Minimal REST API for contacts

### 6.2 Out of Scope for MVP (Future)

- Email open/click/bounce tracking and analytics
- A/B testing of campaigns
- Multi-tenant/team support
- Advanced segmentation (AND/OR tag combinations)
- Drag-and-drop email editor
- Template variables/personalization tags
- Webhook integrations
- Reporting and exportable campaign reports
- RSS/email feed-to-campaign functionality
- Social media integration

## 7. Success Metrics

**Primary**

- **SM-1**: Campaign delivery — 100% of sent campaigns successfully dispatch emails to all subscribed recipients. Validates FR-5.
- **SM-2**: Automation reliability — automations process all eligible contacts within the scheduled processing window (1-minute cron cycle). Validates FR-13.

**Secondary**

- **SM-3**: System stability — no unhandled exceptions in campaign sending or automation processing paths, as measured by error logs. Validates FR-5, FR-13, FR-16, FR-17.

## 8. Cross-Cutting NFRs

- **NFR-1 (Performance)**: The `campaigns:send-scheduled` and `automations:process` commands must complete within 60 seconds for the expected dataset size.
- **NFR-2 (Reliability)**: Failed email sends must not cause the entire campaign to fail — each recipient is sent independently.
- **NFR-3 (Observability)**: All automation step executions must be logged in `automation_logs` with status and error details.
- **NFR-4 (Data Integrity)**: Campaign send status and `sent_at` must be atomic — a campaign is either fully sent or not sent; partial sends must be identifiable.

## 9. Open Questions

1. What is the expected contact volume target (hundreds, thousands, or millions)?
2. Is there a need for email open/click tracking via webhook integration?
3. Should the system support multiple SMTP providers (SendGrid, Mailgun, etc.)?
4. Is multi-user role-based access control needed for team environments?

## 10. Assumptions Index

- Status transitions (draft → scheduled → sent) are one-directional and irreversible.
- Contact subscription status is the only gate for email delivery.
- Automation step delay is measured in calendar days (not business days).
- The database queue driver is sufficient for the expected email volume.
- A single authenticated user operates the system (no team/role model).
