---
title: SendFlow UX Specifications
created: 2025-06-25
updated: 2025-06-25
status: draft
---

# SendFlow — EXPERIENCE.md

## Foundation

- **Form-factor:** Web application (desktop-first, responsive via Tailwind CSS)
- **UI System:** Tailwind CSS 4 with custom design tokens from DESIGN.md
- **Framework:** Laravel Blade server-rendered templates with Alpine.js for interactivity
- **Rendering:** Server-rendered HTML, no SPA framework

## Information Architecture

### Top-level Surfaces

| # | Surface | Route | Purpose |
|---|---|---|---|
| 1 | Dashboard | `/` | Live stats, campaign charts, quick actions, recent campaigns |
| 2 | Campaigns | `/campaigns` | Campaign list, create, edit, preview, send |
| 3 | Automations | `/automations` | Automation workflow list, create, edit, toggle |
| 4 | Audience | `/audience` | Contact list, add, import, export |
| 5 | Tags | `/audience/audience-tags` | Tag management |
| 6 | Templates | `/message-temp` | Email template list, create, edit |
| 7 | Inbox | `/audience/inbox` | Message inbox |
| 8 | Labels | `/audience/add-labels` | Label management |
| 9 | Sources | `/add-source` | Source management |
| 10 | Profile | `/profile` | User profile, avatar, password |

### Navigation Hierarchy

Dashboard → Campaigns → Automations → Audience (dropdown: Contacts, Tags, Inbox, Labels, Sources) → Templates → Profile

## Voice and Tone

- **Microcopy:** Professional and direct. Buttons use action verbs (Create Campaign, Send Now, Duplicate, Delete).
- **Feedback:** Success messages use green styling; error messages use red styling. Flash messages appear after CRUD operations.
- **Status labels:** "draft" (yellow), "scheduled" (blue), "sent" (green), "active"/"paused" (automations).

## Component Patterns

### Campaign List (Table)
- Columns: Name, Status (badge), Type, Send Date, Sent At, Actions
- Actions per row: Edit, Duplicate, Delete, Preview, Send (for non-sent campaigns)
- Status badges with color coding
- Empty state: "No campaigns yet" with CTA to create

### Campaign Create/Edit (Form)
- Fields: Name (text), Template (select), Status (radio/select), Send Date (date picker)
- Recipient selection: Dual multi-select for contacts and tags
- Validation errors shown inline

### Automation List (Cards/Table)
- Each automation shows: Name, Trigger Type, Step Count, Status (active/paused toggle)
- Toggle button for pause/activate without entering edit mode
- Delete with confirmation

### Automation Create/Edit (Multi-step Form)
- Top section: Name, Description, Trigger Type, Trigger Config
- Dynamic steps section: Add Step button, each step has delay_days, action_type, and action-specific config
- Steps are ordered and can be visually sequenced

### Dashboard (Grid Layout)
- Top row: Stat cards (4 columns) — Contacts, Subscribers, Campaigns, Templates
- Middle row: Bar chart (left, wider) + Doughnut chart (right, narrower)
- Bottom: Quick action tiles (icon grid) + Recent campaigns list
- Topbar: Live clock, user greeting

## State Patterns

### Loading
- Server-rendered pages load fully on request — no partial loading states
- Form submissions use standard POST/PUT with redirect

### Empty States
- Campaigns list: "No campaigns created yet. [Create Campaign]"
- Automations list: "No automation workflows. [Create Automation]"
- Contacts list: "No contacts. [Add Contact] or [Import CSV]"

### Error States
- Validation errors: Inline field errors with red border on inputs
- Send errors: Flash error message ("Campaign has already been sent", "Campaign has no recipients", "Campaign has no template assigned")
- Automation step failures: Logged in automation_logs with error message

### Edge Cases
- Campaign send with 0 recipients → blocked with error message
- Campaign send with already-sent status → blocked with error message
- Campaign send without template → blocked with error message
- Automation with 0 steps → blocked by validation (minimum 1)
- Deleted automation → cascade deletes steps and logs

## Interaction Primitives

- **Navigation:** Sidebar links, all server-side rendered
- **Forms:** Standard HTML forms with CSRF protection
- **AJAX:** Used for campaign duplicate, tag bulk delete, status toggles (automations)
- **Charts:** Alpine.js-powered bar and doughnut charts on dashboard
- **Date picker:** Native HTML date input
- **File upload:** CSV import via standard file input
- **Toggle:** Click-to-toggle pause/activate on automations (POST request, no page reload)

## Accessibility Floor

- Semantic HTML (Blade templates use proper heading hierarchy)
- Form labels associated with inputs
- Color-coded status badges use text labels in addition to color
- Focus states from Tailwind defaults
- Alt text on images and avatars

## Key Flows

### Flow 1: Create and Send Campaign (UJ-1 from PRD)
1. User clicks "Campaigns" in sidebar
2. Clicks "Create Campaign" button
3. Fills form: name, selects template, selects recipients (contacts + tags), sets status and optional send date
4. Clicks "Save" → redirects to campaign list with success message
5. Optionally clicks "Send" on the campaign row → dispatches immediately

### Flow 2: Create Automation Sequence (UJ-2 from PRD)
1. User clicks "Automations" in sidebar
2. Clicks "Create Automation"
3. Fills: name, description, selects trigger type + config
4. Adds steps: each step has delay (days), action type, and action config
5. Clicks "Save" → automation active immediately
6. Can toggle pause/activate from list view

### Flow 3: Monitor Dashboard (UJ-3 from PRD)
1. User lands on `/` (Dashboard)
2. Sees stat cards with live counts
3. Reviews campaign analytics charts
4. Scans recent campaigns for action items
5. Clicks quick action tiles to navigate to specific areas

## Inspiration & Anti-patterns

- **Reference:** Mailchimp-like navigation structure (sidebar + content area) but stripped of Mailchimp's collapsible menus, fake analytics, upsells, and spam warnings.
- **Anti-pattern:** Avoid cluttered dashboards — stat cards should show only the 4 most important metrics, not every possible count.
- **Anti-pattern:** Avoid confirmation dialogs for every action — destructive actions (delete) should confirm; status toggles and duplicates should not.

## Responsive & Platform

- Desktop-first design via Tailwind CSS
- Sidebar collapses on smaller screens (standard responsive behavior via Tailwind)
- Tables scroll horizontally on narrow viewports
- Stat cards stack vertically on mobile
