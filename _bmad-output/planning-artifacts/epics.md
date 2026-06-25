---
stepsCompleted: ["step-01-validate-prerequisites"]
inputDocuments:
  - _bmad-output/planning-artifacts/prds/prd-SendFlow-2025-06-25/prd.md
  - _bmad-output/planning-artifacts/architecture/architecture-SendFlow-2025-06-25/ARCHITECTURE-SPINE.md
  - _bmad-output/planning-artifacts/ux-designs/ux-SendFlow-2025-06-25/DESIGN.md
  - _bmad-output/planning-artifacts/ux-designs/ux-SendFlow-2025-06-25/EXPERIENCE.md
---

# SendFlow — Epic Breakdown

## Overview

This document provides the complete epic and story breakdown for the SendFlow email marketing platform, decomposing the requirements from the PRD, UX Design, and Architecture into implementable stories for future iteration planning.

## Requirements Inventory

### Functional Requirements

FR1: Display live dashboard stats (contacts, subscribers, campaigns, templates counts)
FR2: Render campaign analytics charts (bar chart + doughnut chart)
FR3: Show recent campaigns list with status badges
FR4: Create campaign with recipient targeting (contacts + tag groups)
FR5: Send campaign to all resolved recipients (deduplicated, subscribed only)
FR6: Schedule campaign for future delivery with one-minute cron cycle
FR7: Duplicate campaign including pivot assignments
FR8: Preview campaign email in iframe with recipient sidebar
FR9: Manage contacts with CRUD (email, name, subscription, attributes)
FR10: Import/export contacts via CSV
FR11: Manage tags with assignment to contacts and campaigns
FR12: Create automation workflow with multi-step sequences and delays
FR13: Process automation triggers (contact_created, tag_added, birthday)
FR14: Toggle automation status (active/paused)
FR15: Manage email templates (name, subject, HTML body)
FR16: Send campaign emails via SMTP to subscribed contacts
FR17: Send automation-triggered emails via SMTP
FR18: Manage user profile with avatar upload/remove and password change

### Non-Functional Requirements

NFR1: Scheduled commands must complete within 60 seconds
NFR2: Failed email sends must not cause entire campaign to fail
NFR3: All automation step executions must be logged with status and errors
NFR4: Campaign send status and sent_at must be atomic

### Additional Requirements (Architecture)

- All database access through Eloquent ORM — no raw queries
- Pivot-based many-to-many for campaign-contact and campaign-tag relationships
- Database queue driver for async job processing
- Direct SMTP mailer per individual recipient
- Database-polled scheduler on one-minute cycle
- Automation state tracked in dedicated automation_logs table
- Single status column as state machine (draft→scheduled→sent, active↔paused)
- SQLite as the database

### UX Design Requirements

UX-DR1: Maintain consistent navy/coral color palette across all surfaces
UX-DR2: Use status badges (pill-shaped) with green/yellow/blue for sent/draft/scheduled
UX-DR3: Fixed 260px sidebar with responsive collapse behavior
UX-DR4: Dark gradient card backgrounds for stat cards
UX-DR5: Form validation errors displayed inline with red input borders
UX-DR6: Flash messages for success (green) and error (red) after CRUD operations
UX-DR7: Empty states for campaigns, automations, contacts with CTAs
UX-DR8: Confirmation only for destructive actions (delete), not for toggles/duplicates

### FR Coverage Map

| FR | Epic(s) | Story(ies) |
|---|---|---|
| FR1 | Epic 1 | Story 1.1 |
| FR2 | Epic 1 | Story 1.2 |
| FR3 | Epic 1 | Story 1.3 |
| FR4 | Epic 2 | Story 2.1 |
| FR5, FR16 | Epic 2 | Story 2.2 |
| FR6 | Epic 2 | Story 2.3 |
| FR7 | Epic 2 | Story 2.4 |
| FR8 | Epic 2 | Story 2.5 |
| FR9 | Epic 3 | Story 3.1 |
| FR10 | Epic 3 | Story 3.3 |
| FR11 | Epic 3 | Story 3.2 |
| FR12, FR13, FR14 | Epic 4 | Stories 4.1, 4.2 |
| FR15 | Epic 5 | Story 5.1 |
| FR17 | Epic 4 | Story 4.2 |
| FR18 | Epic 6 | Story 6.1 |

## Epic List

### Epic 1: Dashboard & Analytics

**Goal:** Provide operators with real-time visibility into key metrics, campaign performance, and quick access to common actions.

### Epic 2: Campaign Management

**Goal:** Enable marketers to create, target, send, schedule, and manage email campaigns with flexible recipient selection.

### Epic 3: Audience & Segmentation

**Goal:** Provide complete contact management with tag-based segmentation, CSV import/export, and subscriber tracking.

### Epic 4: Automation Workflows

**Goal:** Empower users to create multi-step automated email sequences triggered by contact events and schedule-based actions.

### Epic 5: Email Templates

**Goal:** Allow users to create and manage HTML email templates for use in campaigns and automations.

### Epic 6: User Profile & Settings

**Goal:** Enable users to manage their profile, avatar, and password.

---

## Epic 1: Dashboard & Analytics

**Goal:** Provide operators with real-time visibility into key metrics, campaign performance, and quick access to common actions.

### Story 1.1: Display live dashboard statistics

As a marketing operator,
I want to see live counts of contacts, subscribers, campaigns, and templates on the dashboard,
So that I can quickly assess the state of my marketing platform.

**Acceptance Criteria:**

**Given** I am logged into SendFlow
**When** I navigate to the dashboard
**Then** I see four stat cards showing: total contacts, subscribed contacts, total campaigns, and total templates
**And** each stat card displays the real-time database count with a label

**Given** I have added a new contact
**When** I refresh the dashboard
**Then** the contacts stat card reflects the updated count

### Story 1.2: Render campaign analytics charts

As a marketing operator,
I want to see a bar chart comparing sent vs draft vs scheduled campaigns and a doughnut chart of campaign status distribution,
So that I can understand campaign activity at a glance.

**Acceptance Criteria:**

**Given** campaigns exist with various statuses
**When** the dashboard loads
**Then** a bar chart displays the count of sent, draft, and scheduled campaigns
**And** a doughnut chart displays the proportional breakdown of campaign statuses
**And** both charts render using Alpine.js-powered components

### Story 1.3: Display quick action tiles and recent campaigns

As a marketing operator,
I want to see quick action tiles and a list of recent campaigns on the dashboard,
So that I can quickly navigate to common tasks and see the latest campaign activity.

**Acceptance Criteria:**

**Given** I am on the dashboard
**When** the page loads
**Then** I see quick action icon tiles with hover effects linking to: Create Campaign, Add Contact, Import Contacts, View Automations
**And** I see a list of recent campaigns ordered by send_date descending with name, status badge, and date

---

## Epic 2: Campaign Management

**Goal:** Enable marketers to create, target, send, schedule, and manage email campaigns with flexible recipient selection.

### Story 2.1: Create campaign with recipient targeting

As a marketing operator,
I want to create a campaign with a name, template, status, optional send date, and recipient selection via contacts and/or tag groups,
So that I can tailor who receives my message.

**Acceptance Criteria:**

**Given** I am on the campaign creation form
**When** I fill in the required fields and select recipients via contacts and/or tags
**Then** the campaign is saved with all provided data
**And** campaign_contact and campaign_tag pivot records are created accordingly
**And** I am redirected to the campaign list with a success message

**Given** I submit the form without a name or template
**When** validation runs
**Then** I see inline field errors and the form is not submitted

### Story 2.2: Send campaign to recipients

As a marketing operator,
I want to send a campaign immediately to all selected recipients,
So that my message reaches my audience.

**Acceptance Criteria:**

**Given** a campaign exists with draft status and has recipients assigned
**When** I click "Send" on the campaign
**Then** the SendCampaignJob is dispatched
**And** the campaign status updates to "sent" with a sent_at timestamp

**Given** a campaign is already sent
**When** I attempt to send it again
**Then** I receive an error: "Campaign has already been sent"

**Given** a campaign has no recipients
**When** I attempt to send it
**Then** I receive an error: "Campaign has no recipients"

### Story 2.3: Schedule campaign for future delivery

As a marketing operator,
I want to set a campaign status to "scheduled" with a future send date,
So that the campaign sends automatically when the date arrives.

**Acceptance Criteria:**

**Given** a campaign has status "scheduled" and a send_date
**When** the send_date has passed
**Then** the campaigns:send-scheduled command dispatches the campaign via SendCampaignJob

**Given** a scheduled campaign's send_date is in the future
**When** the campaigns:send-scheduled command runs
**Then** the campaign is skipped

### Story 2.4: Duplicate campaign

As a marketing operator,
I want to duplicate an existing campaign including its recipient assignments,
So that I can reuse campaign settings for similar sends.

**Acceptance Criteria:**

**Given** a campaign exists with contacts and tags assigned
**When** I click "Duplicate"
**Then** a new campaign is created with status "draft" and name appended with " (Copy)"
**And** all campaign_contact and campaign_tag pivot records are replicated
**And** I receive a success message with the new campaign data

### Story 2.5: Preview campaign email

As a marketing operator,
I want to preview the rendered campaign email before sending,
So that I can verify the content and recipient list.

**Acceptance Criteria:**

**Given** a campaign exists with a template assigned
**When** I click "Preview"
**Then** I see the rendered template content in an iframe
**And** a sidebar lists all resolved recipients

---

## Epic 3: Audience & Segmentation

**Goal:** Provide complete contact management with tag-based segmentation, CSV import/export, and subscriber tracking.

### Story 3.1: Manage contacts with full CRUD

As a marketing operator,
I want to create, view, update, and delete contacts with full profile information,
So that I can maintain my audience database.

**Acceptance Criteria:**

**Given** I am on the contacts page
**When** I add a new contact with email, name, company, phone, and subscription status
**Then** the contact is saved and displayed in the contact list

**Given** I update an existing contact's details
**When** I save the changes
**Then** the contact record is updated with the new information

**Given** I delete a contact
**When** I confirm the deletion
**Then** the contact is removed and pivot records (contact_tag) are cascade-deleted

### Story 3.2: Manage tags with contact assignment

As a marketing operator,
I want to create, rename, delete, and bulk-delete tags, and assign them to contacts,
So that I can segment my audience for targeted campaigns.

**Acceptance Criteria:**

**Given** I am on the tag management page
**When** I create a new tag
**Then** the tag appears in the tag list

**Given** a tag exists
**When** I assign it to a contact
**Then** a contact_tag pivot record is created
**And** the tag appears on the contact's profile

**Given** a tag is used as a campaign recipient target
**When** I delete the tag
**Then** the tag is removed and campaign_tag pivot records cascade-delete

### Story 3.3: Import and export contacts via CSV

As a marketing operator,
I want to import contacts from a CSV file and export my contact list to CSV,
So that I can bulk-manage my audience.

**Acceptance Criteria:**

**Given** I have a CSV file with contact data
**When** I upload it on the import page
**Then** new contact records are created from the CSV data
**And** I see a success message with the count of imported contacts

**Given** I click "Export"
**When** the export processes
**Then** I download a CSV file containing all contact data

---

## Epic 4: Automation Workflows

**Goal:** Empower users to create multi-step automated email sequences triggered by contact events.

### Story 4.1: Create automation workflow with multi-step sequence

As a marketing operator,
I want to create an automation workflow with a trigger type and multiple ordered steps with delays,
So that I can set up automated email sequences.

**Acceptance Criteria:**

**Given** I am on the automation creation form
**When** I fill in the name, description, trigger type, and add at least one step
**Then** the automation is saved with status "active"
**And** all steps are created with correct order, delay_days, and action_type
**And** I am redirected to the automation list

**Given** I try to create an automation without steps
**When** validation runs
**Then** I see an error that at least one step is required

**Given** I select "send_email" as the action type
**When** I don't select a template
**Then** validation requires a template_id

### Story 4.2: Process automation triggers and execute steps

As a marketing operator,
I want automation triggers to fire automatically when events occur,
So that contacts receive messages without manual intervention.

**Acceptance Criteria:**

**Given** an active automation with trigger "contact_created"
**When** a new contact is created
**Then** the automations:process command detects the contact and executes eligible steps

**Given** an automation step has delay_days set to 3
**When** the contact was created 2 days ago
**Then** the step is not yet executed
**When** the contact was created 4 days ago
**Then** the step is executed

**Given** a step has already been executed for a contact
**When** the automations:process command runs again
**Then** the step is not re-executed (idempotent via automation_logs check)

### Story 4.3: Toggle automation status

As a marketing operator,
I want to pause and activate automation workflows,
So that I can control which automations are currently processing.

**Acceptance Criteria:**

**Given** an automation with status "active"
**When** I toggle it
**Then** status changes to "paused"
**And** the automation is skipped during processing

**Given** an automation with status "paused"
**When** I toggle it
**Then** status changes back to "active"

---

## Epic 5: Email Templates

**Goal:** Allow users to create and manage HTML email templates for use in campaigns and automations.

### Story 5.1: Manage email templates

As a marketing operator,
I want to create, edit, view, and delete HTML email templates with subject lines,
So that I can reuse email designs across campaigns.

**Acceptance Criteria:**

**Given** I am on the template management page
**When** I create a new template with name, subject, and HTML body
**Then** the template is saved and appears in the template list

**Given** I edit an existing template
**When** I update the subject or body
**Then** the template is updated

**Given** a template is associated with a campaign
**When** I attempt to delete it
**Then** the delete is blocked due to foreign key constraint (or handled gracefully)

---

## Epic 6: User Profile & Settings

**Goal:** Enable users to manage their profile, avatar, and password.

### Story 6.1: Manage user profile with avatar

As an authenticated user,
I want to update my profile, change my password, and upload/remove an avatar,
So that I can personalize my account.

**Acceptance Criteria:**

**Given** I am on the profile page
**When** I update my name and email
**Then** the changes are saved to the users table

**Given** I want to change my password
**When** I enter my current password and a new password
**Then** the password is updated (requires current password confirmation)

**Given** I upload an avatar image
**When** the upload completes
**Then** the avatar is saved and displayed on my profile

**Given** I remove my avatar
**When** I confirm
**Then** the avatar field is cleared
